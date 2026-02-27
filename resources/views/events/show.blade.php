@php $layout = auth()->check() && auth()->user()->hasElevatedAccess() ? 'layouts.app' : 'layouts.member'; @endphp
@extends($layout)
@section('title', $event->title)
@section('page-title', 'Detail Event')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    {{-- Event Header --}}
    <div class="card">
        <div class="flex flex-col md:flex-row gap-6">
            @if($event->poster_url)
                <img src="{{ $event->poster_url }}" class="w-full md:w-48 h-48 rounded-lg object-cover" alt="">
            @endif
            <div class="flex-1">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="badge badge-blue capitalize">{{ $event->type }}</span>
                    <span class="badge {{ $event->status === 'upcoming' ? 'badge-blue' : ($event->status === 'ongoing' ? 'badge-yellow' : ($event->status === 'completed' ? 'badge-green' : 'badge-red')) }} capitalize">
                        {{ $event->status }}
                    </span>
                </div>
                <h2 class="text-2xl font-bold text-hmti-dark mb-3">{{ $event->title }}</h2>
                <div class="grid grid-cols-2 gap-3 text-sm text-hmti-gray">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $event->start_date->format('d M Y, H:i') }} - {{ $event->end_date->format('H:i') }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $event->location }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Dibuat oleh {{ $event->creator->name }}
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857"/></svg>
                        {{ $event->participants->count() }} peserta
                        @if($event->max_participants) / {{ $event->max_participants }} @endif
                    </div>
                </div>
                <div class="mt-4 flex flex-wrap gap-2">
                    {{-- Register button (for non-admin users) --}}
                    @if($event->status === 'upcoming' && !$event->participants->contains(auth()->id()))
                        <form method="POST" action="{{ route('events.register', $event) }}">
                            @csrf
                            <button type="submit" class="btn-primary" {{ $event->isFull() ? 'disabled' : '' }}>
                                {{ $event->isFull() ? 'Event Penuh' : 'Daftar Sekarang' }}
                            </button>
                        </form>
                    @elseif($event->participants->contains(auth()->id()))
                        <span class="btn-outline !cursor-default opacity-60">✓ Sudah Terdaftar</span>
                    @endif

                    @if(auth()->user()->hasElevatedAccess())
                        <a href="{{ route('events.edit', $event) }}" class="btn-outline">Edit</a>
                        @if($event->status === 'completed')
                            <a href="{{ route('reports.bulk-certificates', $event) }}" class="btn-secondary">
                                Download Sertifikat
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Description --}}
    <div class="card">
        <h3 class="text-base font-semibold text-hmti-dark mb-3">Deskripsi</h3>
        <div class="prose prose-sm max-w-none text-hmti-gray">{!! nl2br(e($event->description)) !!}</div>
    </div>

    {{-- Participants Table --}}
    <div class="card">
        <div class="card-header">
            <h3 class="text-base font-semibold text-hmti-dark">Daftar Peserta</h3>
            <span class="badge-blue">{{ $event->participants->count() }} terdaftar</span>
        </div>

        @if(auth()->user()->hasElevatedAccess() && $event->status === 'completed')
            <form method="POST" action="{{ route('events.attendance', $event) }}">
                @csrf
        @endif

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">#</th>
                        <th class="table-header">Peserta</th>
                        <th class="table-header">NIM</th>
                        <th class="table-header">Status Kehadiran</th>
                        <th class="table-header">Sertifikat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($event->participants as $i => $participant)
                        <tr class="hover:bg-gray-50">
                            <td class="table-cell text-hmti-gray">{{ $i + 1 }}</td>
                            <td class="table-cell">
                                <div class="flex items-center gap-2">
                                    <img src="{{ $participant->avatar_url }}" class="w-6 h-6 rounded-full" alt="">
                                    {{ $participant->name }}
                                </div>
                            </td>
                            <td class="table-cell font-mono text-xs">{{ $participant->nim }}</td>
                            <td class="table-cell">
                                @if(auth()->user()->hasElevatedAccess() && $event->status === 'completed')
                                    <select name="attendees[{{ $participant->id }}]" class="input !py-1 !text-xs w-auto">
                                        @foreach(['registered', 'attended', 'absent'] as $status)
                                            <option value="{{ $status }}" {{ $participant->pivot->attendance_status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                @else
                                    <span class="badge text-xs {{ $participant->pivot->attendance_status === 'attended' ? 'badge-green' : ($participant->pivot->attendance_status === 'absent' ? 'badge-red' : 'badge-blue') }}">
                                        {{ ucfirst($participant->pivot->attendance_status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="table-cell">
                                @if($participant->pivot->attendance_status === 'attended' && auth()->user()->hasElevatedAccess())
                                    <a href="{{ route('reports.certificate', [$event, $participant]) }}" class="text-xs text-hmti-blue hover:underline">
                                        Download PDF
                                    </a>
                                @elseif($participant->pivot->certificate_generated)
                                    <span class="text-xs text-green-600">✓ Terbit</span>
                                @else
                                    <span class="text-xs text-hmti-gray">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="table-cell text-center py-6 text-hmti-gray">Belum ada peserta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(auth()->user()->hasElevatedAccess() && $event->status === 'completed' && $event->participants->isNotEmpty())
            <div class="mt-4 flex justify-end">
                <button type="submit" class="btn-primary">Simpan Kehadiran</button>
            </div>
            </form>
        @endif
    </div>
</div>
@endsection
