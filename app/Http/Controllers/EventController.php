<?php

namespace App\Http\Controllers;

use App\Events\EventUpdated;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('creator')->withCount('registrations');

        if ($search = $request->get('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $events = $query->latest('start_date')->paginate(12)->withQueryString();

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', Rule::in(['seminar', 'workshop', 'meeting', 'competition', 'social'])],
            'location' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'poster' => ['nullable', 'image', 'max:5120'],
        ]);

        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(5);
        $validated['created_by'] = Auth::id();
        $validated['status'] = 'upcoming';

        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('events/posters', 'public');
        }

        unset($validated['poster']);
        $event = Event::create($validated);

        broadcast(new EventUpdated($event, 'created'))->toOthers();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dibuat.');
    }

    public function show(Event $event)
    {
        $event->load(['creator', 'participants']);
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', Rule::in(['seminar', 'workshop', 'meeting', 'competition', 'social'])],
            'location' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after:start_date'],
            'max_participants' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', Rule::in(['upcoming', 'ongoing', 'completed', 'cancelled'])],
            'poster' => ['nullable', 'image', 'max:5120'],
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('events/posters', 'public');
        }

        unset($validated['poster']);
        $event->update($validated);

        broadcast(new EventUpdated($event, 'updated'))->toOthers();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        broadcast(new EventUpdated($event, 'deleted'))->toOthers();
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event berhasil dihapus.');
    }

    public function register(Event $event)
    {
        $user = Auth::user();

        if ($event->isFull()) {
            return back()->with('error', 'Event sudah penuh.');
        }

        if ($event->participants()->where('user_id', $user->id)->exists()) {
            return back()->with('error', 'Anda sudah terdaftar di event ini.');
        }

        EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'attendance_status' => 'registered',
            'registered_at' => now(),
        ]);

        return back()->with('success', 'Berhasil mendaftar ke event.');
    }

    public function updateAttendance(Request $request, Event $event)
    {
        $validated = $request->validate([
            'attendees' => ['required', 'array'],
            'attendees.*' => ['required', Rule::in(['registered', 'attended', 'absent'])],
        ]);

        foreach ($validated['attendees'] as $userId => $status) {
            EventRegistration::where('event_id', $event->id)
                ->where('user_id', $userId)
                ->update(['attendance_status' => $status]);
        }

        return back()->with('success', 'Kehadiran berhasil diperbarui.');
    }
}
