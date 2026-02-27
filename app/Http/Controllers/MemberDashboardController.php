<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MemberDashboardController extends Controller
{
    /**
     * Member home dashboard — personal stats + highlights.
     */
    public function dashboard()
    {
        $user = Auth::user();

        $stats = [
            'registered_events'   => EventRegistration::where('user_id', $user->id)->count(),
            'attended_events'     => EventRegistration::where('user_id', $user->id)->where('attendance_status', 'attended')->count(),
            'certificates'        => EventRegistration::where('user_id', $user->id)->where('certificate_generated', true)->count(),
            'upcoming_registered' => EventRegistration::where('user_id', $user->id)
                ->whereHas('event', fn ($q) => $q->whereIn('status', ['upcoming', 'ongoing']))
                ->count(),
        ];

        // Upcoming events the member hasn't registered for yet
        $registeredEventIds = EventRegistration::where('user_id', $user->id)->pluck('event_id');

        $upcomingEvents = Event::whereIn('status', ['upcoming', 'ongoing'])
            ->whereNotIn('id', $registeredEventIds)
            ->latest('start_date')
            ->take(4)
            ->get();

        // Latest announcements
        $announcements = Announcement::with('author')
            ->latest()
            ->take(5)
            ->get();

        // User's most recent registrations
        $myEvents = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->take(4)
            ->get();

        // Active projects (just for display)
        $activeProjects = Project::with('lead')
            ->whereIn('status', ['planning', 'in_progress'])
            ->latest()
            ->take(3)
            ->get();

        return view('member.dashboard', compact('user', 'stats', 'upcomingEvents', 'announcements', 'myEvents', 'activeProjects'));
    }

    /**
     * Browse all events (upcoming, ongoing, completed).
     */
    public function events(Request $request)
    {
        $user = Auth::user();

        $query = Event::with('creator')->withCount('registrations')->latest('start_date');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(9)->withQueryString();

        // Get user's registered event IDs for UI state
        $myRegisteredIds = EventRegistration::where('user_id', $user->id)->pluck('event_id');

        return view('member.events', compact('events', 'myRegisteredIds'));
    }

    /**
     * My registered events with status.
     */
    public function myEvents()
    {
        $user = Auth::user();

        $registrations = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('member.my-events', compact('registrations'));
    }

    /**
     * Edit own profile.
     */
    public function profile()
    {
        return view('member.profile', ['user' => Auth::user()]);
    }

    /**
     * Update own profile.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'division' => 'nullable|in:chairman,secretary,treasury,education,research,public_relations,creative_media',
            'avatar'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
