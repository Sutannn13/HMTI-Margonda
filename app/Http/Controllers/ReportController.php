<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Generate PDF certificate for an event participant.
     */
    public function certificate(Event $event, User $user)
    {
        $registration = EventRegistration::where('event_id', $event->id)
            ->where('user_id', $user->id)
            ->where('attendance_status', 'attended')
            ->firstOrFail();

        $data = [
            'user' => $user,
            'event' => $event,
            'registration' => $registration,
            'date' => now()->format('d F Y'),
        ];

        // Mark certificate as generated
        $registration->update(['certificate_generated' => true]);

        $pdf = Pdf::loadView('reports.certificate', $data)
            ->setPaper('a4', 'landscape');

        $filename = 'sertifikat-' . str_replace(' ', '-', strtolower($user->name)) . '-' . $event->slug . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Generate monthly activity report.
     */
    public function monthlyReport(Request $request)
    {
        $monthNum = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        $period = \Carbon\Carbon::createFromDate($year, $monthNum, 1)->translatedFormat('F Y');

        $events = Event::whereYear('start_date', $year)
            ->whereMonth('start_date', $monthNum)
            ->withCount('registrations')
            ->with('creator')
            ->get();

        $newMembers = User::whereYear('joined_at', $year)
            ->whereMonth('joined_at', $monthNum)
            ->get();

        $announcements = \App\Models\Announcement::whereYear('created_at', $year)
            ->whereMonth('created_at', $monthNum)
            ->count();

        $stats = [
            'total_members' => User::count(),
            'new_members'   => $newMembers->count(),
            'events_held'   => $events->count(),
            'announcements' => $announcements,
        ];

        $data = compact('period', 'stats', 'events', 'newMembers');

        $pdf = Pdf::loadView('reports.monthly', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download("laporan-bulanan-{$year}-{$monthNum}.pdf");
    }

    /**
     * Bulk generate certificates for all attendees of an event.
     */
    public function bulkCertificates(Event $event)
    {
        $attendees = EventRegistration::where('event_id', $event->id)
            ->where('attendance_status', 'attended')
            ->with('user')
            ->get();

        if ($attendees->isEmpty()) {
            return back()->with('error', 'Tidak ada peserta yang hadir untuk event ini.');
        }

        $data = [
            'event'     => $event,
            'attendees' => $attendees,
        ];

        // Mark all as generated
        EventRegistration::where('event_id', $event->id)
            ->where('attendance_status', 'attended')
            ->update(['certificate_generated' => true]);

        $pdf = Pdf::loadView('reports.bulk-certificates', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->download("sertifikat-{$event->slug}.pdf");
    }

    public function reportsPage()
    {
        $completedEvents = Event::where('status', 'completed')
            ->orderByDesc('start_date')
            ->with('registrations')
            ->get();

        return view('reports.index', compact('completedEvents'));
    }
}
