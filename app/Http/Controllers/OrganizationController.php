<?php

namespace App\Http\Controllers;

use App\Models\OrganizationMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class OrganizationController extends Controller
{
    /**
     * Admin: list all organization members.
     */
    public function index(Request $request)
    {
        $query = OrganizationMember::query();

        if ($search = $request->get('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($division = $request->get('division')) {
            $query->where('division', $division);
        }

        $members = $query->orderBy('division')
            ->orderBy('sort_order')
            ->orderBy('position')
            ->paginate(20)
            ->withQueryString();

        return view('admin.organization.index', compact('members'));
    }

    /**
     * Admin: create form.
     */
    public function create()
    {
        return view('admin.organization.create');
    }

    /**
     * Admin: store new member.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'division' => ['required', Rule::in(array_keys(OrganizationMember::DIVISIONS))],
            'position' => ['required', Rule::in(array_keys(OrganizationMember::POSITIONS))],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('org-avatars', 'public');
        }

        OrganizationMember::create($validated);

        return redirect()->route('admin.organization.index')
            ->with('success', 'Anggota organisasi berhasil ditambahkan.');
    }

    /**
     * Admin: edit form.
     */
    public function edit(OrganizationMember $member)
    {
        return view('admin.organization.edit', compact('member'));
    }

    /**
     * Admin: update member.
     */
    public function update(Request $request, OrganizationMember $member)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'division' => ['required', Rule::in(array_keys(OrganizationMember::DIVISIONS))],
            'position' => ['required', Rule::in(array_keys(OrganizationMember::POSITIONS))],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            if ($member->avatar) {
                Storage::disk('public')->delete($member->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('org-avatars', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.organization.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Admin: delete member.
     */
    public function destroy(OrganizationMember $member)
    {
        if ($member->avatar) {
            Storage::disk('public')->delete($member->avatar);
        }

        $member->delete();

        return redirect()->route('admin.organization.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
