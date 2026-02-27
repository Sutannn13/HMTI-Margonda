@php $layout = auth()->check() && auth()->user()->hasElevatedAccess() ? 'layouts.app' : 'layouts.member'; @endphp
@extends($layout)
@section('title', $member->name)
@section('page-title', 'Detail Anggota')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    {{-- Profile Card --}}
    <div class="card">
        <div class="flex flex-col sm:flex-row items-start gap-6">
            <img src="{{ $member->avatar_url }}" class="w-24 h-24 rounded-xl object-cover border-4 border-hmti-yellow/30" alt="">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h2 class="text-2xl font-bold text-hmti-dark">{{ $member->name }}</h2>
                    <span class="badge {{ $member->status === 'active' ? 'badge-green' : ($member->status === 'alumni' ? 'badge-blue' : 'badge-red') }} capitalize">
                        {{ $member->status }}
                    </span>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-hmti-gray">NIM</span>
                        <p class="font-mono font-medium">{{ $member->nim }}</p>
                    </div>
                    <div>
                        <span class="text-hmti-gray">Email</span>
                        <p class="font-medium">{{ $member->email }}</p>
                    </div>
                    <div>
                        <span class="text-hmti-gray">Role</span>
                        <p class="font-medium capitalize">{{ $member->role }}</p>
                    </div>
                    <div>
                        <span class="text-hmti-gray">Divisi</span>
                        <p class="font-medium capitalize">{{ str_replace('_', ' ', $member->division ?? '-') }}</p>
                    </div>
                    <div>
                        <span class="text-hmti-gray">Angkatan</span>
                        <p class="font-medium">{{ $member->generation ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-hmti-gray">Telepon</span>
                        <p class="font-medium">{{ $member->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <span class="text-hmti-gray">Bergabung</span>
                        <p class="font-medium">{{ $member->joined_at?->format('d M Y') ?? '-' }}</p>
                    </div>
                </div>
            </div>
            @if(auth()->user()->hasElevatedAccess())
                <a href="{{ route('members.edit', $member) }}" class="btn-outline text-sm">Edit</a>
            @endif
        </div>
    </div>

    {{-- Event Participation --}}
    <div class="card">
        <div class="card-header">
            <h3 class="text-base font-semibold">Riwayat Event</h3>
            <span class="badge-blue">{{ $member->registeredEvents->count() }} event</span>
        </div>
        <div class="space-y-2">
            @forelse($member->registeredEvents as $event)
                <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50">
                    <div>
                        <a href="{{ route('events.show', $event) }}" class="text-sm font-medium text-hmti-dark hover:text-hmti-blue">
                            {{ $event->title }}
                        </a>
                        <p class="text-xs text-hmti-gray">{{ $event->start_date->format('d M Y') }}</p>
                    </div>
                    <span class="badge text-xs {{ $event->pivot->attendance_status === 'attended' ? 'badge-green' : ($event->pivot->attendance_status === 'absent' ? 'badge-red' : 'badge-blue') }}">
                        {{ ucfirst($event->pivot->attendance_status) }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-hmti-gray text-center py-4">Belum mengikuti event apapun.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
