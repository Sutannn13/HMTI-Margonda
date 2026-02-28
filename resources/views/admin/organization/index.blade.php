@extends('layouts.admin')
@section('title', 'Struktur Organisasi')
@section('page-title', 'Kelola Struktur Organisasi')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm text-blue-300/60">Kelola data anggota struktur organisasi HMTI Margonda.</p>
        </div>
        <a href="{{ route('admin.organization.create') }}" class="btn-primary btn-shiny">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Anggota
        </a>
    </div>

    {{-- Filters --}}
    <div class="relative rounded-2xl p-4 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <form method="GET" action="{{ route('admin.organization.index') }}" class="flex flex-wrap gap-3">
            <input type="text" name="search" class="input w-64" placeholder="Cari nama..." value="{{ request('search') }}" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
            <select name="division" class="input w-40" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                <option value="">Semua Divisi</option>
                @foreach(\App\Models\OrganizationMember::DIVISIONS as $key => $label)
                    <option value="{{ $key }}" {{ request('division') === $key ? 'selected' : '' }}>{{ explode(' ', $label)[0] }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary btn-shiny">Filter</button>
            @if(request('search') || request('division'))
                <a href="{{ route('admin.organization.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white/70 bg-white/10 border border-white/15 hover:bg-white/20 transition-colors">Reset</a>
            @endif
        </form>
    </div>

    {{-- Table --}}
    <div class="relative rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">#</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Nama</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Divisi</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Jabatan</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">NIM</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 text-center text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $i => $member)
                    <tr class="transition-colors hover:bg-white/[0.03]" style="border-bottom: 1px solid rgba(255,255,255,0.04);">
                        <td class="py-3 px-4 text-blue-300/50">{{ $members->firstItem() + $i }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $member->avatar_url }}" alt="" class="w-9 h-9 rounded-full object-cover ring-1 ring-white/10">
                                <div>
                                    <p class="font-medium text-white">{{ $member->name }}</p>
                                    @if($member->phone)
                                        <p class="text-[10px] text-blue-300/40">{{ $member->phone }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $divColors = [
                                    'kwsb'    => ['59,130,246', 'text-blue-400'],
                                    'kominfo' => ['245,197,24', 'text-yellow-400'],
                                    'litbang' => ['34,197,94', 'text-green-400'],
                                    'psdm'    => ['168,85,247', 'text-purple-400'],
                                ];
                                $dc = $divColors[$member->division] ?? ['148,163,184', 'text-gray-400'];
                            @endphp
                            <span class="text-xs font-medium px-2.5 py-1 rounded-full {{ $dc[1] }}" style="background: rgba({{ $dc[0] }},0.1); border: 1px solid rgba({{ $dc[0] }},0.2);">
                                {{ strtoupper($member->division) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-200/70">{{ $member->position_label }}</td>
                        <td class="py-3 px-4 text-blue-300/50">{{ $member->nim ?? '-' }}</td>
                        <td class="py-3 px-4">
                            @if($member->status === 'active')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-green-400 bg-green-400/10 border border-green-400/20">Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-red-400 bg-red-400/10 border border-red-400/20">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.organization.edit', $member) }}"
                                   class="p-1.5 rounded-lg text-blue-400 hover:bg-blue-400/10 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.organization.destroy', $member) }}"
                                      onsubmit="event.preventDefault(); confirmAction({title:'Hapus {{ $member->name }}?',text:'Data anggota ini akan dihapus permanen.',icon:'warning',confirmText:'Ya, hapus!'}).then(r => { if(r.isConfirmed) this.submit(); });">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-red-400 hover:bg-red-400/10 transition-colors" title="Hapus">
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
                        <td colspan="7" class="py-12 text-center">
                            <svg class="w-12 h-12 mx-auto text-blue-300/20 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                            </svg>
                            <p class="text-blue-300/50 text-sm">Belum ada data anggota. <a href="{{ route('admin.organization.create') }}" class="text-hmti-yellow hover:underline">Tambah sekarang</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($members->hasPages())
        <div class="p-4" style="border-top: 1px solid rgba(255,255,255,0.06);">
            {{ $members->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
