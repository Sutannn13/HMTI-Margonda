<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($role = $request->get('role')) {
            $query->where('role', $role);
        }

        if ($division = $request->get('division')) {
            $query->where('division', $division);
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        if ($generation = $request->get('generation')) {
            $query->where('generation', $generation);
        }

        $members = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nim' => ['required', 'string', 'unique:users,nim'],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', Rule::in(['admin', 'coordinator', 'member'])],
            'division' => ['nullable', Rule::in(['chairman', 'secretary', 'treasury', 'education', 'research', 'public_relations', 'creative_media'])],
            'generation' => ['nullable', 'string', 'max:4'],
            'status' => ['required', Rule::in(['active', 'inactive', 'alumni'])],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['joined_at'] = now();

        User::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(User $member)
    {
        $member->load(['registeredEvents', 'announcements', 'ledProjects']);
        return view('members.show', compact('member'));
    }

    public function edit(User $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($member->id)],
            'nim' => ['required', 'string', Rule::unique('users')->ignore($member->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'role' => ['required', Rule::in(['admin', 'coordinator', 'member'])],
            'division' => ['nullable', Rule::in(['chairman', 'secretary', 'treasury', 'education', 'research', 'public_relations', 'creative_media'])],
            'generation' => ['nullable', 'string', 'max:4'],
            'status' => ['required', Rule::in(['active', 'inactive', 'alumni'])],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($member->avatar) {
                Storage::disk('public')->delete($member->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $member->update($validated);

        return redirect()->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(User $member)
    {
        if ($member->avatar) {
            Storage::disk('public')->delete($member->avatar);
        }
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
