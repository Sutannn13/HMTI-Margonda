<?php

namespace App\Http\Controllers;

use App\Events\AnnouncementPosted;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('author')
            ->orderByDesc('is_pinned')
            ->orderByRaw("FIELD(priority, 'urgent', 'high', 'normal', 'low')")
            ->latest()
            ->paginate(15);

        return view('announcements.index', compact('announcements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'priority' => ['required', Rule::in(['low', 'normal', 'high', 'urgent'])],
            'is_pinned' => ['boolean'],
        ]);

        $validated['user_id'] = Auth::id();
        $validated['is_pinned'] = $request->boolean('is_pinned');

        $announcement = Announcement::create($validated);
        $announcement->load('author');

        broadcast(new AnnouncementPosted($announcement))->toOthers();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'announcement' => $announcement,
            ]);
        }

        return back()->with('success', 'Pengumuman berhasil dikirim.');
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'priority' => ['required', Rule::in(['low', 'normal', 'high', 'urgent'])],
            'is_pinned' => ['boolean'],
        ]);

        $validated['is_pinned'] = $request->boolean('is_pinned');
        $announcement->update($validated);

        return back()->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
