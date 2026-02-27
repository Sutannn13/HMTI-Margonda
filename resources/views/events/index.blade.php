@extends('layouts.app')
@section('title', 'Event')
@section('page-title', 'Manajemen Event')

@section('content')
<div class="space-y-4" x-data="{
    init() {
        if (window.Echo) {
            window.Echo.channel('events').listen('EventUpdated', (e) => {
                $store.notifications.add({
                    title: e.action === 'created' ? 'Event Baru!' : 'Event Diperbarui',
                    body: e.event.title,
                    priority: 'normal',
                    time: 'Baru saja'
                });
            });
        }
    }
}">
    {{-- Toolbar --}}
    <div class="card !p-4">
        <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center justify-between">
            <form method="GET" class="flex flex-wrap gap-2 items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event..."
                       class="input w-48">
                <select name="type" class="input w-auto">
                    <option value="">Semua Tipe</option>
                    @foreach(['seminar', 'workshop', 'meeting', 'competition', 'social'] as $t)
                        <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
                <select name="status" class="input w-auto">
                    <option value="">Semua Status</option>
                    @foreach(['upcoming', 'ongoing', 'completed', 'cancelled'] as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-primary">Filter</button>
            </form>
            @if(auth()->user()->hasElevatedAccess())
                <a href="{{ route('events.create') }}" class="btn-secondary whitespace-nowrap">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Buat Event
                </a>
            @endif
        </div>
    </div>

    {{-- Events Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($events as $event)
            <div class="card hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between mb-3">
                    <span class="badge {{ $event->type === 'seminar' ? 'badge-blue' : ($event->type === 'workshop' ? 'badge-yellow' : 'badge-green') }} capitalize">
                        {{ $event->type }}
                    </span>
                    <span class="badge {{ $event->status === 'upcoming' ? 'badge-blue' :
                        ($event->status === 'ongoing' ? 'badge-yellow' :
                        ($event->status === 'completed' ? 'badge-green' : 'badge-red')) }} capitalize">
                        {{ $event->status }}
                    </span>
                </div>
                <a href="{{ route('events.show', $event) }}">
                    <h3 class="text-lg font-bold text-hmti-dark hover:text-hmti-blue transition-colors mb-2 line-clamp-2">
                        {{ $event->title }}
                    </h3>
                </a>
                <div class="space-y-2 text-sm text-hmti-gray">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ $event->start_date->format('d M Y, H:i') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $event->location }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $event->registrations_count }} peserta
                        @if($event->max_participants)
                            / {{ $event->max_participants }}
                        @endif
                    </div>
                </div>
                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                    <p class="text-xs text-hmti-gray">Oleh {{ $event->creator->name }}</p>
                    <a href="{{ route('events.show', $event) }}" class="text-xs text-hmti-blue font-semibold hover:underline">
                        Detail →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 text-hmti-gray">
                <p>Belum ada event.</p>
            </div>
        @endforelse
    </div>

    <div class="flex justify-center">{{ $events->links() }}</div>
</div>
@endsection
