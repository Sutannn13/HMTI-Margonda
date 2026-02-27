@extends('layouts.app')
@section('title', 'Permintaan Kerja Sama')
@section('page-title', 'Permintaan Kerja Sama')

@section('content')
<div class="space-y-5">

    {{-- Status counts --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        @foreach([
            ['label' => 'Pending', 'key' => 'pending', 'color' => 'bg-orange-100 text-orange-700'],
            ['label' => 'Ditinjau', 'key' => 'reviewing', 'color' => 'bg-blue-100 text-blue-700'],
            ['label' => 'Disetujui', 'key' => 'approved', 'color' => 'bg-green-100 text-green-700'],
            ['label' => 'Ditolak', 'key' => 'rejected', 'color' => 'bg-red-100 text-hmti-red'],
        ] as $s)
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 flex items-center gap-3">
            <span class="w-3 h-3 rounded-full {{ explode(' ', $s['color'])[0] }}"></span>
            <div>
                <p class="text-xl font-bold text-hmti-dark">{{ $counts[$s['key']] }}</p>
                <p class="text-xs text-hmti-gray">{{ $s['label'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Filter --}}
    <form method="GET" class="card !p-4 flex flex-wrap gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / instansi..." class="input flex-1 min-w-[200px]">
        <select name="status" class="input w-36">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="reviewing" {{ request('status') === 'reviewing' ? 'selected' : '' }}>Ditinjau</option>
            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
        </select>
        <button type="submit" class="btn-primary">Filter</button>
        @if(request()->anyFilled(['search', 'status']))
            <a href="{{ route('admin.collaboration.index') }}" class="btn-outline">Reset</a>
        @endif
    </form>

    {{-- Table --}}
    <div class="card !p-0 overflow-hidden">
        @if($requests->isEmpty())
            <div class="p-12 text-center">
                <svg class="w-14 h-14 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-hmti-gray text-sm">Tidak ada permintaan kerjasama ditemukan.</p>
            </div>
        @else
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="table-header">Pemohon</th>
                        <th class="table-header">Jenis</th>
                        <th class="table-header">Tanggal</th>
                        <th class="table-header">Status</th>
                        <th class="table-header text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $req)
                    <tr class="border-b border-gray-50 hover:bg-gray-50/50" x-data="{ open: false }">
                        <td class="table-cell">
                            <p class="font-semibold text-hmti-dark">{{ $req->name }}</p>
                            @if($req->organization)
                                <p class="text-xs text-hmti-gray">{{ $req->organization }}</p>
                            @endif
                            <p class="text-xs text-hmti-gray">{{ $req->email }}</p>
                            @if($req->phone)<p class="text-xs text-hmti-gray">{{ $req->phone }}</p>@endif
                        </td>
                        <td class="table-cell">
                            <span class="badge-blue text-xs">{{ $req->proposalLabel() }}</span>
                        </td>
                        <td class="table-cell text-hmti-gray">{{ $req->created_at->format('d M Y') }}</td>
                        <td class="table-cell">
                            <span class="text-xs px-2.5 py-1 rounded-full font-medium
                                @if($req->status === 'pending') bg-orange-100 text-orange-700
                                @elseif($req->status === 'reviewing') bg-blue-100 text-blue-700
                                @elseif($req->status === 'approved') bg-green-100 text-green-700
                                @else bg-red-100 text-hmti-red @endif">
                                @if($req->status === 'pending') Pending
                                @elseif($req->status === 'reviewing') Ditinjau
                                @elseif($req->status === 'approved') Disetujui
                                @else Ditolak @endif
                            </span>
                        </td>
                        <td class="table-cell text-center">
                            <button @click="open = !open" class="text-xs text-hmti-blue hover:underline">
                                Kelola
                            </button>
                        </td>
                    </tr>

                    {{-- Expandable detail panel --}}
                    <tr x-show="open" x-transition class="bg-hmti-blue/3">
                        <td colspan="5" class="px-5 py-4">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-xs font-semibold text-hmti-gray uppercase mb-2">Isi Proposal</p>
                                    <p class="text-sm text-hmti-dark leading-relaxed whitespace-pre-wrap bg-white rounded-lg p-3 border border-gray-100">{{ $req->message }}</p>
                                </div>
                                <form action="{{ route('admin.collaboration.update', $req) }}" method="POST" class="space-y-3">
                                    @csrf @method('PUT')
                                    <p class="text-xs font-semibold text-hmti-gray uppercase">Update Status</p>
                                    <select name="status" class="input">
                                        @foreach(['pending' => 'Pending', 'reviewing' => 'Sedang Ditinjau', 'approved' => 'Setujui', 'rejected' => 'Tolak'] as $val => $label)
                                            <option value="{{ $val }}" {{ $req->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        <label class="label">Catatan Admin</label>
                                        <textarea name="admin_notes" rows="3" class="input resize-none"
                                                  placeholder="Pesan/catatan untuk/dari pemohon (opsional)">{{ old('admin_notes', $req->admin_notes) }}</textarea>
                                    </div>
                                    @if($req->handler)
                                    <p class="text-xs text-hmti-gray">Terakhir ditangani oleh: {{ $req->handler->name }} — {{ $req->handled_at?->format('d M Y H:i') }}</p>
                                    @endif
                                    <div class="flex gap-2">
                                        <button type="submit" class="btn-primary text-xs">Simpan</button>
                                        <form action="{{ route('admin.collaboration.destroy', $req) }}" method="POST" onsubmit="return confirm('Hapus permintaan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-danger text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-5 py-3 border-t border-gray-100">{{ $requests->links() }}</div>
        @endif
    </div>
</div>
@endsection
