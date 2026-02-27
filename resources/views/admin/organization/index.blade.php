@extends('layouts.admin')
@section('title', 'Struktur Organisasi')
@section('page-title', 'Kelola Struktur Organisasi')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm text-hmti-gray">Kelola data anggota struktur organisasi HMTI Margonda.</p>
        </div>
        <a href="{{ route('admin.organization.create') }}" class="btn-primary">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Anggota
        </a>
    </div>

    {{-- Filters --}}
    <div class="card">
        <form method="GET" action="{{ route('admin.organization.index') }}" class="flex flex-wrap gap-3">
            <input type="text" name="search" class="input w-64" placeholder="Cari nama..." value="{{ request('search') }}">
            <select name="division" class="input w-40">
                <option value="">Semua Divisi</option>
                @foreach(\App\Models\OrganizationMember::DIVISIONS as $key => $label)
                    <option value="{{ $key }}" {{ request('division') === $key ? 'selected' : '' }}>{{ explode(' ', $label)[0] }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary">Filter</button>
            @if(request('search') || request('division'))
                <a href="{{ route('admin.organization.index') }}" class="btn-outline">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="card overflow-hidden !p-0">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">#</th>
                        <th class="table-header">Nama</th>
                        <th class="table-header">Divisi</th>
                        <th class="table-header">Jabatan</th>
                        <th class="table-header">NIM</th>
                        <th class="table-header">Status</th>
                        <th class="table-header text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($members as $i => $member)
                    <tr class="hover:bg-gray-50">
                        <td class="table-cell text-hmti-gray">{{ $members->firstItem() + $i }}</td>
                        <td class="table-cell">
                            <div class="flex items-center gap-3">
                                <img src="{{ $member->avatar_url }}" alt="" class="w-9 h-9 rounded-full object-cover">
                                <div>
                                    <p class="font-medium text-hmti-dark">{{ $member->name }}</p>
                                    @if($member->phone)
                                        <p class="text-[10px] text-hmti-gray">{{ $member->phone }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="table-cell">
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                                {{ $member->division === 'kwsb' ? 'bg-blue-100 text-blue-700' :
                                   ($member->division === 'kominfo' ? 'bg-yellow-100 text-yellow-700' :
                                   ($member->division === 'litbang' ? 'bg-green-100 text-green-700' :
                                   'bg-purple-100 text-purple-700')) }}">
                                {{ strtoupper($member->division) }}
                            </span>
                        </td>
                        <td class="table-cell">{{ $member->position_label }}</td>
                        <td class="table-cell text-hmti-gray">{{ $member->nim ?? '-' }}</td>
                        <td class="table-cell">
                            @if($member->status === 'active')
                                <span class="badge-green">Aktif</span>
                            @else
                                <span class="badge-red">Nonaktif</span>
                            @endif
                        </td>
                        <td class="table-cell text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.organization.edit', $member) }}"
                                   class="p-1.5 rounded-lg text-hmti-blue hover:bg-hmti-blue/10 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.organization.destroy', $member) }}"
                                      onsubmit="return confirm('Hapus {{ $member->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-red-500 hover:bg-red-50 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="table-cell text-center py-12 text-hmti-gray">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                            </svg>
                            Belum ada data anggota. <a href="{{ route('admin.organization.create') }}" class="text-hmti-blue hover:underline">Tambah sekarang</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($members->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $members->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
