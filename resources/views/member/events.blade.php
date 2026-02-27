@extends('layouts.member')
@section('title', 'Kegiatan')
@section('page-title', 'Kegiatan HMTI')

@section('content')
<div class="space-y-5">

    {{-- Filter bar --}}
    <form method="GET" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4">
        <div class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari kegiatan..." class="input flex-1 min-w-[180px]">
            <select name="status" class="input w-36">
                <option value="">Semua Status</option>
                <option value="upcoming" {{ request('status') === 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Berlangsung</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
            <select name="type" class="input w-36">
                <option value="">Semua Tipe</option>
                <option value="seminar" {{ request('type') === 'seminar' ? 'selected' : '' }}>Seminar</option>
                <option value="workshop" {{ request('type') === 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="competition" {{ request('type') === 'competition' ? 'selected' : '' }}>Kompetisi</option>
                <option value="social" {{ request('type') === 'social' ? 'selected' : '' }}>Sosial</option>
                <option value="internal" {{ request('type') === 'internal' ? 'selected' : '' }}>Internal</option>
            </select>
            <button type="submit" class="btn-primary">Cari</button>
            @if(request()->anyFilled(['search', 'status', 'type']))
                <a href="{{ route('member.events') }}" class="btn-outline">Reset</a>
            @endif
        </div>
    </form>

    {{-- Events grid --}}
    @if($events->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <p class="text-hmti-gray text-sm">Tidak ada kegiatan ditemukan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($events as $event)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all hover:-translate-y-0.5">
                {{-- Top colour bar based on status --}}
                <div class="h-1.5
                    @if($event->status === 'ongoing') bg-green-400
                    @elseif($event->status === 'upcoming') bg-hmti-blue
                    @elseif($event->status === 'completed') bg-gray-300
                    @else bg-hmti-red @endif">
                </div>

                <div class="p-5">
                    {{-- Tags --}}
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-[10px] px-2 py-0.5 rounded-full font-semibold uppercase tracking-wide
                            @if($event->status === 'ongoing') bg-green-100 text-green-700
                            @elseif($event->status === 'upcoming') bg-blue-100 text-blue-700
                            @elseif($event->status === 'completed') bg-gray-100 text-gray-600
                            @else bg-red-100 text-hmti-red @endif">
                            @if($event->status === 'upcoming') Akan Datang
                            @elseif($event->status === 'ongoing') Berlangsung
                            @elseif($event->status === 'completed') Selesai
                            @else Dibatalkan @endif
                        </span>
                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-hmti-yellow/15 text-hmti-yellow-dark font-medium capitalize">
                            {{ $event->type }}
                        </span>
                    </div>

                    <h4 class="font-bold text-hmti-dark text-sm mb-1 leading-tight">{{ $event->title }}</h4>
                    <p class="text-xs text-hmti-gray line-clamp-2 mb-3">{{ Str::limit($event->description, 90) }}</p>

                    <div class="space-y-1.5 text-xs text-hmti-gray">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-hmti-blue shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $event->start_date->format('d M Y, H:i') }}
                        </div>
                        @if($event->location)
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-hmti-blue shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $event->location }}
                        </div>
                        @endif
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                        @if($event->max_participants)
                        <div class="text-xs text-hmti-gray">
                            {{ $event->registrations_count ?? 0 }}/{{ $event->max_participants }} peserta
                        </div>
                        @else
                        <div></div>
                        @endif

                        @if($myRegisteredIds->contains($event->id))
                            <span class="inline-flex items-center gap-1 text-xs text-green-600 font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Terdaftar
                            </span>
                        @elseif($event->status === 'upcoming' || $event->status === 'ongoing')
                            <a href="{{ route('events.show', $event) }}" class="text-xs px-3 py-1.5 rounded-lg bg-hmti-blue text-white font-medium hover:bg-hmti-blue-light transition-colors">
                                Daftar
                            </a>
                        @else
                            <a href="{{ route('events.show', $event) }}" class="text-xs text-hmti-blue hover:underline">Detail →</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div>{{ $events->links() }}</div>
    @endif
</div>
@endsection
