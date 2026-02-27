<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\ChatMessage;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect plain members to their own portal
        if (!auth()->user()->hasElevatedAccess()) {
            return redirect()->route('member.dashboard');
        }

        $stats = [
            'total_members' => User::count(),
            'active_members' => User::where('status', 'active')->count(),
            'total_events' => Event::count(),
            'upcoming_events' => Event::where('status', 'upcoming')->count(),
            'active_projects' => Project::whereIn('status', ['planning', 'in_progress'])->count(),
            'announcements' => Announcement::count(),
        ];

        $recentEvents = Event::with('creator')
            ->latest()
            ->take(5)
            ->get();

        $recentAnnouncements = Announcement::with('author')
            ->latest()
            ->take(5)
            ->get();

        $activeProjects = Project::with('lead')
            ->whereIn('status', ['planning', 'in_progress'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentEvents', 'recentAnnouncements', 'activeProjects'));
    }

    public function chartData(Request $request): JsonResponse
    {
        $type = $request->get('type', 'member_growth');

        return match ($type) {
            'member_growth' => $this->memberGrowthData(),
            'event_attendance' => $this->eventAttendanceData(),
            'division_distribution' => $this->divisionDistributionData(),
            'project_status' => $this->projectStatusData(),
            default => response()->json([]),
        };
    }

    private function memberGrowthData(): JsonResponse
    {
        $data = User::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count")
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return response()->json([
            'labels' => $data->pluck('month'),
            'datasets' => [[
                'label' => 'Anggota Baru',
                'data' => $data->pluck('count'),
                'borderColor' => '#1a3a6b',
                'backgroundColor' => 'rgba(26, 58, 107, 0.1)',
                'fill' => true,
                'tension' => 0.4,
            ]],
        ]);
    }

    private function eventAttendanceData(): JsonResponse
    {
        $events = Event::where('status', 'completed')
            ->latest('start_date')
            ->take(8)
            ->get();

        $labels = $events->pluck('title')->map(fn ($t) => mb_strimwidth($t, 0, 20, '...'));

        $registered = $events->map(fn ($e) => $e->registrations()->count());
        $attended = $events->map(fn ($e) => $e->registrations()->where('attendance_status', 'attended')->count());

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Terdaftar',
                    'data' => $registered,
                    'backgroundColor' => '#1a3a6b',
                ],
                [
                    'label' => 'Hadir',
                    'data' => $attended,
                    'backgroundColor' => '#f5c518',
                ],
            ],
        ]);
    }

    private function divisionDistributionData(): JsonResponse
    {
        $data = User::where('status', 'active')
            ->whereNotNull('division')
            ->selectRaw('division, COUNT(*) as count')
            ->groupBy('division')
            ->get();

        $divisionLabels = [
            'chairman' => 'Ketua',
            'secretary' => 'Sekretaris',
            'treasury' => 'Bendahara',
            'education' => 'Pendidikan',
            'research' => 'Penelitian',
            'public_relations' => 'Humas',
            'creative_media' => 'Media Kreatif',
        ];

        return response()->json([
            'labels' => $data->pluck('division')->map(fn ($d) => $divisionLabels[$d] ?? $d),
            'datasets' => [[
                'data' => $data->pluck('count'),
                'backgroundColor' => [
                    '#1a3a6b', '#2a5298', '#f5c518', '#fad54b',
                    '#c0392b', '#e74c3c', '#64748b',
                ],
            ]],
        ]);
    }

    private function projectStatusData(): JsonResponse
    {
        $data = Project::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $statusLabels = [
            'planning' => 'Perencanaan',
            'in_progress' => 'Berjalan',
            'completed' => 'Selesai',
            'on_hold' => 'Ditunda',
        ];

        $colors = [
            'planning' => '#2a5298',
            'in_progress' => '#f5c518',
            'completed' => '#27ae60',
            'on_hold' => '#c0392b',
        ];

        return response()->json([
            'labels' => $data->pluck('status')->map(fn ($s) => $statusLabels[$s] ?? $s),
            'datasets' => [[
                'data' => $data->pluck('count'),
                'backgroundColor' => $data->pluck('status')->map(fn ($s) => $colors[$s] ?? '#64748b'),
            ]],
        ]);
    }
}
