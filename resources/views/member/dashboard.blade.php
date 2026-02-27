@extends('layouts.member')
@section('title', 'Beranda Anggota')
@section('page-title', 'Beranda')

@section('content')
<div class="space-y-6">

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-hmti-blue via-hmti-blue-light to-[#3a6db5] p-6 text-white">
        <div class="relative z-10">
            <p class="text-sm text-blue-200 mb-1">Selamat datang kembali,</p>
            <h2 class="text-2xl font-bold">{{ auth()->user()->name }} 👋</h2>
            <p class="text-blue-200 text-sm mt-1">
                {{ now()->translatedFormat('l, d F Y') }}
                @if(auth()->user()->division)
                    &mdash; Divisi {{ ucfirst(str_replace('_', ' ', auth()->user()->division)) }}
                @endif
            </p>
            <div class="flex gap-3 mt-4">
                <a href="{{ route('member.events') }}" class="px-4 py-2 rounded-lg bg-hmti-yellow text-hmti-blue-dark text-sm font-semibold hover:bg-hmti-yellow-light transition-colors">
                    Lihat Kegiatan
                </a>
                <a href="{{ route('member.profile') }}" class="px-4 py-2 rounded-lg bg-white/10 text-white text-sm font-medium hover:bg-white/20 transition-colors">
                    Edit Profil
                </a>
            </div>
        </div>
        {{-- Decorative circles --}}
        <div class="absolute -right-8 -top-8 w-40 h-40 rounded-full bg-white/5"></div>
        <div class="absolute -right-2 top-10 w-24 h-24 rounded-full bg-hmti-yellow/10"></div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-hmti-blue/10 flex items-center justify-center">
                    <svg class="w-5 h-5 text-hmti-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-xs text-hmti-gray">Total</span>
            </div>
            <p class="text-2xl font-bold text-hmti-dark">{{ $stats['registered_events'] }}</p>
            <p class="text-xs text-hmti-gray mt-0.5">Kegiatan Terdaftar</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-hmti-gray">Hadir</span>
            </div>
            <p class="text-2xl font-bold text-hmti-dark">{{ $stats['attended_events'] }}</p>
            <p class="text-xs text-hmti-gray mt-0.5">Kegiatan Dihadiri</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-hmti-yellow/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-hmti-yellow-dark" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <span class="text-xs text-hmti-gray">Sertifikat</span>
            </div>
            <p class="text-2xl font-bold text-hmti-dark">{{ $stats['certificates'] }}</p>
            <p class="text-xs text-hmti-gray mt-0.5">Sertifikat Diperoleh</p>
        </div>

        <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-purple-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs text-hmti-gray">Aktif</span>
            </div>
            <p class="text-2xl font-bold text-hmti-dark">{{ $stats['upcoming_registered'] }}</p>
            <p class="text-xs text-hmti-gray mt-0.5">Akan Datang</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Upcoming Events --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-hmti-dark">Kegiatan Tersedia</h3>
                <a href="{{ route('member.events') }}" class="text-xs text-hmti-blue hover:underline">Lihat semua →</a>
            </div>

            @if($upcomingEvents->isEmpty())
                <div class="bg-white rounded-2xl border border-gray-100 p-8 text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-hmti-gray">Kamu sudah terdaftar di semua kegiatan aktif!</p>
                </div>
            @else
                @foreach($upcomingEvents as $event)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 flex gap-4 hover:shadow-md transition-shadow">
                    <div class="w-14 h-14 rounded-xl bg-hmti-blue/10 flex flex-col items-center justify-center shrink-0">
                        <span class="text-xs font-bold text-hmti-blue">{{ $event->start_date->format('d') }}</span>
                        <span class="text-[10px] text-hmti-gray uppercase">{{ $event->start_date->format('M') }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] px-2 py-0.5 rounded-full font-medium
                                @if($event->status === 'ongoing') bg-green-100 text-green-700
                                @else bg-blue-100 text-blue-700 @endif">
                                {{ $event->status === 'ongoing' ? 'Sedang Berlangsung' : 'Akan Datang' }}
                            </span>
                            <span class="text-[10px] text-hmti-gray">{{ ucfirst($event->type) }}</span>
                        </div>
                        <p class="font-semibold text-sm text-hmti-dark truncate">{{ $event->title }}</p>
                        <p class="text-xs text-hmti-gray mt-0.5">{{ $event->location }}</p>
                    </div>
                    <div class="shrink-0">
                        <a href="{{ route('events.show', $event) }}" class="btn-primary text-xs py-1.5 px-3">Daftar</a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        {{-- Right column --}}
        <div class="space-y-5">
            {{-- Recent Announcements --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-hmti-dark text-sm">Pengumuman</h3>
                    <a href="{{ route('announcements.index') }}" class="text-xs text-hmti-blue hover:underline">Semua →</a>
                </div>
                @forelse($announcements as $ann)
                <div class="py-2.5 border-b border-gray-50 last:border-0">
                    <div class="flex items-center gap-2 mb-0.5">
                        <span class="w-2 h-2 rounded-full shrink-0
                            @if($ann->priority === 'urgent') bg-hmti-red
                            @elseif($ann->priority === 'high') bg-orange-500
                            @else bg-hmti-blue @endif"></span>
                        <span class="text-xs font-medium text-hmti-dark truncate">{{ $ann->title }}</span>
                    </div>
                    <p class="text-[11px] text-hmti-gray ml-4">{{ $ann->created_at->diffForHumans() }}</p>
                </div>
                @empty
                <p class="text-sm text-hmti-gray text-center py-4">Belum ada pengumuman.</p>
                @endforelse
            </div>

            {{-- Active Projects --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <h3 class="font-bold text-hmti-dark text-sm mb-3">Proyek Aktif</h3>
                @forelse($activeProjects as $project)
                <div class="py-2.5 border-b border-gray-50 last:border-0">
                    <p class="text-xs font-semibold text-hmti-dark">{{ $project->name }}</p>
                    <p class="text-[11px] text-hmti-gray mt-0.5">
                        Lead: {{ $project->lead->name ?? '-' }}
                        &mdash;
                        <span class="{{ $project->status === 'in_progress' ? 'text-green-600' : 'text-orange-500' }}">
                            {{ $project->status === 'in_progress' ? 'Berjalan' : 'Perencanaan' }}
                        </span>
                    </p>
                </div>
                @empty
                <p class="text-xs text-hmti-gray text-center py-3">Tidak ada proyek aktif.</p>
                @endforelse
            </div>

            {{-- Collaboration CTA --}}
            <div class="bg-gradient-to-br from-hmti-yellow/20 to-hmti-yellow/5 rounded-2xl border border-hmti-yellow/30 p-4">
                <h4 class="font-bold text-hmti-dark text-sm mb-1">Punya Ide Kerja Sama?</h4>
                <p class="text-xs text-hmti-gray mb-3">Ajukan proposal kolaborasi dengan HMTI Margonda untuk event, workshop, atau proyek riset.</p>
                <a href="{{ route('collaboration.create') }}" class="block w-full text-center py-2 rounded-lg bg-hmti-yellow text-hmti-blue-dark text-xs font-semibold hover:bg-hmti-yellow-light transition-colors">
                    Ajukan Sekarang
                </a>
            </div>
        </div>
    </div>

    {{-- My Recent Events --}}
    @if($myEvents->isNotEmpty())
    <div>
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-bold text-hmti-dark">Kegiatan Saya Terakhir</h3>
            <a href="{{ route('member.my-events') }}" class="text-xs text-hmti-blue hover:underline">Lihat semua →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            @foreach($myEvents as $reg)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
                <div class="flex items-start justify-between mb-2">
                    <div class="text-xs px-2 py-0.5 rounded-full font-medium
                        @if($reg->attendance_status === 'attended') bg-green-100 text-green-700
                        @elseif($reg->attendance_status === 'absent') bg-red-100 text-hmti-red
                        @else bg-blue-100 text-blue-700 @endif">
                        @if($reg->attendance_status === 'attended') Hadir
                        @elseif($reg->attendance_status === 'absent') Tidak Hadir
                        @else Terdaftar @endif
                    </div>
                    @if($reg->certificate_generated)
                    <span title="Sertifikat tersedia">
                        <svg class="w-4 h-4 text-hmti-yellow-dark" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </span>
                    @endif
                </div>
                <p class="text-sm font-semibold text-hmti-dark leading-tight">{{ $reg->event->title }}</p>
                <p class="text-[11px] text-hmti-gray mt-1">{{ $reg->event->start_date->format('d M Y') }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
