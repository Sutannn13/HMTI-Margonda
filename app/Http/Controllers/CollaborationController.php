<?php

namespace App\Http\Controllers;

use App\Models\CollaborationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaborationController extends Controller
{
    /**
     * Show the public collaboration / partnership form.
     */
    public function create()
    {
        return view('collaboration.create');
    }

    /**
     * Store a new collaboration request (public + member).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'organization'  => 'nullable|string|max:255',
            'email'         => 'required|email|max:255',
            'phone'         => 'nullable|string|max:20',
            'proposal_type' => 'required|in:event_sponsor,workshop,recruitment,research,social_project,other',
            'message'       => 'required|string|min:30|max:3000',
        ]);

        CollaborationRequest::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Permintaan kolaborasi berhasil dikirim! Tim HMTI akan menghubungi Anda segera.');
    }

    /**
     * Admin: list all collaboration requests.
     */
    public function index(Request $request)
    {
        $query = CollaborationRequest::with('handler')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('organization', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        $counts = [
            'pending'   => CollaborationRequest::where('status', 'pending')->count(),
            'reviewing' => CollaborationRequest::where('status', 'reviewing')->count(),
            'approved'  => CollaborationRequest::where('status', 'approved')->count(),
            'rejected'  => CollaborationRequest::where('status', 'rejected')->count(),
        ];

        return view('admin.collaboration.index', compact('requests', 'counts'));
    }

    /**
     * Admin: update collaboration request status.
     */
    public function update(Request $request, CollaborationRequest $collaboration)
    {
        $validated = $request->validate([
            'status'      => 'required|in:pending,reviewing,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $collaboration->update([
            ...$validated,
            'handled_by' => Auth::id(),
            'handled_at' => now(),
        ]);

        return back()->with('success', 'Status permintaan berhasil diperbarui.');
    }

    /**
     * Admin: destroy / delete request.
     */
    public function destroy(CollaborationRequest $collaboration)
    {
        $collaboration->delete();
        return back()->with('success', 'Permintaan berhasil dihapus.');
    }
}
