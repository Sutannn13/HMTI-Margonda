<?php

namespace App\Http\Controllers;

use App\Models\KasPayment;
use App\Models\KasSummary;
use App\Models\OrganizationMember;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Organization stats
        $totalMembers = OrganizationMember::where('status', 'active')->count();
        $divisions = OrganizationMember::where('status', 'active')
            ->selectRaw('division, count(*) as count')
            ->groupBy('division')
            ->pluck('count', 'division');

        // Kas stats for current month
        $kasThisMonth = KasPayment::where('month', $currentMonth)
            ->where('year', $currentYear)
            ->get();

        $kasPaid = $kasThisMonth->where('is_paid', true)->count();
        $kasUnpaid = $kasThisMonth->where('is_paid', false)->count();
        $kasLate = $kasThisMonth->where('is_late', true)->where('is_paid', false)->count();
        $totalCollected = $kasThisMonth->where('is_paid', true)->sum('total_amount');
        $totalOutstanding = $kasThisMonth->where('is_paid', false)->sum('total_amount');

        // Members with sanctions (unpaid + late)
        $sanctionedMembers = OrganizationMember::where('status', 'active')
            ->whereHas('kasPayments', function ($q) {
                $q->where('is_paid', false)->where('is_late', true);
            })
            ->with(['kasPayments' => function ($q) {
                $q->where('is_paid', false)->where('is_late', true);
            }])
            ->get();

        // Recent payments
        $recentPayments = KasPayment::with('member')
            ->where('is_paid', true)
            ->latest('paid_at')
            ->take(10)
            ->get();

        // Yearly kas overview (for chart)
        $yearlyKas = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthPayments = KasPayment::where('month', $m)
                ->where('year', $currentYear)
                ->get();
            $yearlyKas[] = [
                'month' => KasPayment::MONTH_NAMES[$m],
                'collected' => $monthPayments->where('is_paid', true)->sum('total_amount'),
                'expected' => $monthPayments->count() * KasPayment::MONTHLY_AMOUNT,
            ];
        }

        return view('admin.dashboard', compact(
            'totalMembers',
            'divisions',
            'kasPaid',
            'kasUnpaid',
            'kasLate',
            'totalCollected',
            'totalOutstanding',
            'sanctionedMembers',
            'recentPayments',
            'yearlyKas',
            'currentMonth',
            'currentYear'
        ));
    }
}
