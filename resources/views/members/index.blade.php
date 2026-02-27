@extends('layouts.app')
@section('title', 'Anggota')
@section('page-title', 'Manajemen Anggota')

@section('content')
<div class="space-y-4">
    {{-- Toolbar --}}
    <div class="card !p-4">
        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center justify-between">
            <form method="GET" class="flex flex-wrap gap-2 items-center flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, NIM, email..."
                       class="input w-48">
                <select name="role" class="input w-auto">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="coordinator" {{ request('role') === 'coordinator' ? 'selected' : '' }}>Koordinator</option>
                    <option value="member" {{ request('role') === 'member' ? 'selected' : '' }}>Anggota</option>
                </select>
                <select name="status" class="input w-auto">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    <option value="alumni" {{ request('status') === 'alumni' ? 'selected' : '' }}>Alumni</option>
                </select>
                <button type="submit" class="btn-primary">Filter</button>
                @if(request()->hasAny(['search', 'role', 'status', 'division', 'generation']))
                    <a href="{{ route('members.index') }}" class="text-sm text-hmti-gray hover:text-hmti-red">Reset</a>
                @endif
            </form>

            @if(auth()->user()->hasElevatedAccess())
                <a href="{{ route('members.create') }}" class="btn-secondary whitespace-nowrap">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Anggota
                </a>
            @endif
        </div>
    </div>

    {{-- Table --}}
    <div class="card !p-0 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="table-header">Anggota</th>
                        <th class="table-header">NIM</th>
                        <th class="table-header">Divisi</th>
                        <th class="table-header">Angkatan</th>
                        <th class="table-header">Role</th>
                        <th class="table-header">Status</th>
                        @if(auth()->user()->hasElevatedAccess())
                            <th class="table-header text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($members as $member)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="table-cell">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $member->avatar_url }}" class="w-8 h-8 rounded-full object-cover" alt="">
                                    <div>
                                        <a href="{{ route('members.show', $member) }}" class="font-medium text-hmti-dark hover:text-hmti-blue">
                                            {{ $member->name }}
                                        </a>
                                        <p class="text-xs text-hmti-gray">{{ $member->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="table-cell font-mono text-xs">{{ $member->nim }}</td>
                            <td class="table-cell">
                                @if($member->division)
                                    <span class="badge-blue capitalize">{{ str_replace('_', ' ', $member->division) }}</span>
                                @else
                                    <span class="text-xs text-hmti-gray">-</span>
                                @endif
                            </td>
                            <td class="table-cell">{{ $member->generation ?? '-' }}</td>
                            <td class="table-cell">
                                <span class="badge {{ $member->role === 'admin' ? 'badge-red' : ($member->role === 'coordinator' ? 'badge-yellow' : 'badge-blue') }} capitalize">
                                    {{ $member->role }}
                                </span>
                            </td>
                            <td class="table-cell">
                                <span class="badge {{ $member->status === 'active' ? 'badge-green' : ($member->status === 'alumni' ? 'badge-blue' : 'badge-red') }} capitalize">
                                    {{ $member->status }}
                                </span>
                            </td>
                            @if(auth()->user()->hasElevatedAccess())
                                <td class="table-cell text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('members.edit', $member) }}" class="p-1.5 rounded text-hmti-gray hover:text-hmti-blue hover:bg-hmti-blue/5" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('members.destroy', $member) }}"
                                              x-data @submit.prevent="if(confirm('Hapus anggota ini?')) $el.submit()">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded text-hmti-gray hover:text-hmti-red hover:bg-hmti-red/5" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="table-cell text-center py-8 text-hmti-gray">
                                Tidak ada anggota ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex justify-center">
        {{ $members->links() }}
    </div>
</div>
@endsection
