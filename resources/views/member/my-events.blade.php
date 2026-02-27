@extends('layouts.member')
@section('title', 'Kegiatan Saya')
@section('page-title', 'Kegiatan Saya')

@section('content')
<div class="space-y-5">

    {{-- Summary bar --}}
    <div class="grid grid-cols-3 gap-3">
        @php
            $allRegs = $registrations->getCollection();
            $attended = $allRegs->where('attendance_status', 'attended')->count();
            $certs    = $allRegs->where('certificate_generated', true)->count();
        @endphp
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center">
            <p class="text-2xl font-bold text-hmti-blue">{{ $registrations->total() }}</p>
            <p class="text-xs text-hmti-gray mt-0.5">Total Terdaftar</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $attended }}</p>
            <p class="text-xs text-hmti-gray mt-0.5">Hadir</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 text-center">
            <p class="text-2xl font-bold text-hmti-yellow-dark">{{ $certs }}</p>
            <p class="text-xs text-hmti-gray mt-0.5">Sertifikat</p>
        </div>
    </div>

    {{-- Registrations list --}}
    @if($registrations->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="text-hmti-gray text-sm mb-4">Kamu belum terdaftar ke kegiatan apapun.</p>
            <a href="{{ route('member.events') }}" class="btn-primary">Lihat Kegiatan</a>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100">
                <h3 class="font-bold text-hmti-dark text-sm">Riwayat Pendaftaran</h3>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($registrations as $reg)
                <div class="px-5 py-4 flex items-center gap-4">
                    {{-- Date badge --}}
                    <div class="w-12 h-12 rounded-xl bg-hmti-blue/8 flex flex-col items-center justify-center shrink-0 border border-hmti-blue/10">
                        <span class="text-xs font-bold text-hmti-blue leading-tight">{{ $reg->event->start_date->format('d') }}</span>
                        <span class="text-[9px] text-hmti-gray uppercase">{{ $reg->event->start_date->format('M Y') }}</span>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-hmti-dark truncate">{{ $reg->event->title }}</p>
                        <p class="text-xs text-hmti-gray">{{ $reg->event->location ?? 'HMTI Margonda' }}</p>
                        <p class="text-[11px] text-hmti-gray mt-0.5">Terdaftar: {{ $reg->registered_at->format('d M Y') }}</p>
                    </div>

                    {{-- Status + Actions --}}
                    <div class="flex items-center gap-3 shrink-0">
                        <span class="text-xs px-2.5 py-1 rounded-full font-medium
                            @if($reg->attendance_status === 'attended') bg-green-100 text-green-700
                            @elseif($reg->attendance_status === 'absent') bg-red-100 text-hmti-red
                            @else bg-blue-100 text-blue-700 @endif">
                            @if($reg->attendance_status === 'attended') ✓ Hadir
                            @elseif($reg->attendance_status === 'absent') ✗ Tidak Hadir
                            @else Terdaftar @endif
                        </span>

                        @if($reg->certificate_generated && $reg->attendance_status === 'attended')
                            <a href="{{ route('reports.certificate', [$reg->event, auth()->user()]) }}"
                               class="text-xs px-3 py-1.5 rounded-lg bg-hmti-yellow/15 text-hmti-yellow-dark font-medium hover:bg-hmti-yellow/25 transition-colors"
                               title="Unduh Sertifikat">
                                <svg class="w-4 h-4 inline -mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Sertifikat
                            </a>
                        @endif

                        <a href="{{ route('events.show', $reg->event) }}" class="text-xs text-hmti-blue hover:underline">Detail</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="mt-4">{{ $registrations->links() }}</div>
    @endif
</div>
@endsection
