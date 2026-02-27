<?php

namespace App\Http\Controllers;

use App\Models\KasPayment;
use App\Models\KasSummary;
use App\Models\OrganizationMember;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KasController extends Controller
{
    /**
     * Display kas payment list with filters.
     */
    public function index(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        // Auto-generate kas entries for all active members if not exist
        $this->generateMonthlyKas($month, $year);

        // Apply late fines
        $this->applyLateFines($month, $year);

        $payments = KasPayment::with('member', 'markedByUser')
            ->where('month', $month)
            ->where('year', $year)
            ->join('organization_members', 'kas_payments.organization_member_id', '=', 'organization_members.id')
            ->orderBy('organization_members.division')
            ->orderBy('organization_members.name')
            ->select('kas_payments.*')
            ->paginate(30)
            ->withQueryString();

        // Summary stats
        $allPayments = KasPayment::where('month', $month)->where('year', $year)->get();
        $stats = [
            'total_members' => $allPayments->count(),
            'paid' => $allPayments->where('is_paid', true)->count(),
            'unpaid' => $allPayments->where('is_paid', false)->count(),
            'late' => $allPayments->where('is_late', true)->where('is_paid', false)->count(),
            'total_collected' => $allPayments->where('is_paid', true)->sum('total_amount'),
            'total_outstanding' => $allPayments->where('is_paid', false)->sum('total_amount'),
            'total_fines' => $allPayments->where('is_late', true)->sum('fine_amount'),
        ];

        $summary = KasSummary::where('month', $month)->where('year', $year)->first();

        return view('admin.kas.index', compact('payments', 'stats', 'summary', 'month', 'year'));
    }

    /**
     * Mark a payment as paid.
     */
    public function markPaid(KasPayment $payment)
    {
        $payment->update([
            'is_paid' => true,
            'paid_at' => now(),
            'marked_by' => auth()->id(),
        ]);

        KasSummary::recalculate($payment->month, $payment->year);

        return back()->with('success', $payment->member->name . ' berhasil ditandai LUNAS untuk ' . $payment->period_label);
    }

    /**
     * Mark a payment as unpaid (undo).
     */
    public function markUnpaid(KasPayment $payment)
    {
        $payment->update([
            'is_paid' => false,
            'paid_at' => null,
            'marked_by' => null,
        ]);

        KasSummary::recalculate($payment->month, $payment->year);

        return back()->with('success', $payment->member->name . ' ditandai BELUM BAYAR untuk ' . $payment->period_label);
    }

    /**
     * Update notes for a payment.
     */
    public function updateNotes(Request $request, KasPayment $payment)
    {
        $request->validate(['notes' => 'nullable|string|max:500']);
        $payment->update(['notes' => $request->notes]);

        return back()->with('success', 'Catatan berhasil diperbarui.');
    }

    /**
     * Update disposition of monthly summary.
     */
    public function updateDisposition(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2024',
            'disposition' => 'required|in:pending,returned,planning',
            'notes' => 'nullable|string|max:1000',
        ]);

        $summary = KasSummary::recalculate($request->month, $request->year);
        $summary->update([
            'disposition' => $request->disposition,
            'notes' => $request->notes,
        ]);

        return back()->with('success', 'Disposisi kas bulan ini berhasil diperbarui.');
    }

    /**
     * Report view - yearly overview.
     */
    public function report(Request $request)
    {
        $year = $request->get('year', now()->year);

        $monthlyData = [];
        for ($m = 1; $m <= 12; $m++) {
            $payments = KasPayment::where('month', $m)->where('year', $year)->get();
            $summary = KasSummary::where('month', $m)->where('year', $year)->first();

            $monthlyData[$m] = [
                'month_name' => KasPayment::MONTH_NAMES[$m],
                'total_members' => $payments->count(),
                'paid' => $payments->where('is_paid', true)->count(),
                'unpaid' => $payments->where('is_paid', false)->count(),
                'collected' => $payments->where('is_paid', true)->sum('total_amount'),
                'outstanding' => $payments->where('is_paid', false)->sum('total_amount'),
                'fines' => $payments->sum('fine_amount'),
                'disposition' => $summary?->disposition_label ?? 'Belum Ditentukan',
            ];
        }

        // Outstanding members (never paid or have multiple fines)
        $outstandingMembers = OrganizationMember::where('status', 'active')
            ->withCount(['kasPayments as unpaid_count' => function ($q) use ($year) {
                $q->where('year', $year)->where('is_paid', false);
            }])
            ->withCount(['kasPayments as late_count' => function ($q) use ($year) {
                $q->where('year', $year)->where('is_late', true)->where('is_paid', false);
            }])
            ->having('unpaid_count', '>', 0)
            ->orderByDesc('late_count')
            ->get();

        $totalCollectedYear = KasPayment::where('year', $year)->where('is_paid', true)->sum('total_amount');
        $totalOutstandingYear = KasPayment::where('year', $year)->where('is_paid', false)->sum('total_amount');
        $totalFinesYear = KasPayment::where('year', $year)->where('is_late', true)->sum('fine_amount');

        return view('admin.kas.report', compact(
            'monthlyData',
            'outstandingMembers',
            'totalCollectedYear',
            'totalOutstandingYear',
            'totalFinesYear',
            'year'
        ));
    }

    /**
     * Generate kas entries for all active members in a given month/year.
     */
    private function generateMonthlyKas(int $month, int $year): void
    {
        $activeMembers = OrganizationMember::where('status', 'active')->get();

        foreach ($activeMembers as $member) {
            KasPayment::firstOrCreate(
                [
                    'organization_member_id' => $member->id,
                    'month' => $month,
                    'year' => $year,
                ],
                [
                    'amount' => KasPayment::MONTHLY_AMOUNT,
                    'total_amount' => KasPayment::MONTHLY_AMOUNT,
                    'is_paid' => false,
                    'is_late' => false,
                    'fine_amount' => 0,
                ]
            );
        }
    }

    /**
     * Apply late fines to unpaid entries past their month.
     */
    private function applyLateFines(int $month, int $year): void
    {
        $now = now();
        $paymentDeadline = Carbon::create($year, $month, 1)->endOfMonth();

        // Only apply fines if we're past the payment month
        if ($now->gt($paymentDeadline)) {
            KasPayment::where('month', $month)
                ->where('year', $year)
                ->where('is_paid', false)
                ->where('is_late', false)
                ->update([
                    'is_late' => true,
                    'fine_amount' => KasPayment::LATE_FINE,
                    'total_amount' => \DB::raw('amount + ' . KasPayment::LATE_FINE),
                ]);
        }
    }
}
