@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-hmti-blue/10 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-hmti-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-hmti-dark">{{ $stats['total_members'] }}</p>
                <p class="text-xs text-hmti-gray">Total Anggota</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-hmti-dark">{{ $stats['active_members'] }}</p>
                <p class="text-xs text-hmti-gray">Anggota Aktif</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-hmti-yellow/20 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-hmti-yellow-dark" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-hmti-dark">{{ $stats['total_events'] }}</p>
                <p class="text-xs text-hmti-gray">Total Event</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-hmti-dark">{{ $stats['upcoming_events'] }}</p>
                <p class="text-xs text-hmti-gray">Event Mendatang</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-hmti-dark">{{ $stats['active_projects'] }}</p>
                <p class="text-xs text-hmti-gray">Proyek Aktif</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-hmti-red/10 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-hmti-red" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-hmti-dark">{{ $stats['announcements'] }}</p>
                <p class="text-xs text-hmti-gray">Pengumuman</p>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Member Growth Chart --}}
        <div class="card" x-data="memberGrowthChart()" x-init="init()">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Pertumbuhan Anggota</h3>
                <span class="badge-blue">12 Bulan Terakhir</span>
            </div>
            <div class="relative h-64">
                <canvas x-ref="memberChart"></canvas>
            </div>
        </div>

        {{-- Event Attendance Chart --}}
        <div class="card" x-data="eventAttendanceChart()" x-init="init()">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Kehadiran Event</h3>
                <span class="badge-yellow">Event Terakhir</span>
            </div>
            <div class="relative h-64">
                <canvas x-ref="attendanceChart"></canvas>
            </div>
        </div>

        {{-- Division Distribution --}}
        <div class="card" x-data="divisionChart()" x-init="init()">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Distribusi Divisi</h3>
                <span class="badge-green">Anggota Aktif</span>
            </div>
            <div class="relative h-64 flex items-center justify-center">
                <canvas x-ref="divisionChart"></canvas>
            </div>
        </div>

        {{-- Project Status --}}
        <div class="card" x-data="projectStatusChart()" x-init="init()">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Status Proyek</h3>
                <span class="badge-blue">Semua Proyek</span>
            </div>
            <div class="relative h-64 flex items-center justify-center">
                <canvas x-ref="projectChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Bottom Row: Recent Events + Announcements + Projects --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent Events --}}
        <div class="card">
            <div class="card-header">
                <h3 class="text-base font-semibold text-hmti-dark">Event Terbaru</h3>
                <a href="{{ route('events.index') }}" class="text-xs text-hmti-blue hover:underline">Lihat semua</a>
            </div>
            <div class="space-y-3">
                @forelse($recentEvents as $event)
                    <a href="{{ route('events.show', $event) }}" class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center text-xs font-bold shrink-0
                            {{ $event->status === 'upcoming' ? 'bg-hmti-blue/10 text-hmti-blue' :
                               ($event->status === 'ongoing' ? 'bg-hmti-yellow/20 text-hmti-yellow-dark' :
                               ($event->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500')) }}">
                            {{ strtoupper(substr($event->type, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-hmti-dark truncate">{{ $event->title }}</p>
                            <p class="text-xs text-hmti-gray">{{ $event->start_date->format('d M Y') }}</p>
                        </div>
                        <span class="badge text-[10px]
                            {{ $event->status === 'upcoming' ? 'badge-blue' :
                               ($event->status === 'ongoing' ? 'badge-yellow' :
                               ($event->status === 'completed' ? 'badge-green' : 'badge-red')) }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </a>
                @empty
                    <p class="text-sm text-hmti-gray text-center py-4">Belum ada event.</p>
                @endforelse
            </div>
        </div>

        {{-- Recent Announcements --}}
        <div class="card">
            <div class="card-header">
                <h3 class="text-base font-semibold text-hmti-dark">Pengumuman Terbaru</h3>
                <a href="{{ route('announcements.index') }}" class="text-xs text-hmti-blue hover:underline">Lihat semua</a>
            </div>
            <div class="space-y-3">
                @forelse($recentAnnouncements as $ann)
                    <div class="p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center gap-2 mb-1">
                            @if($ann->priority === 'urgent')
                                <span class="w-2 h-2 rounded-full bg-hmti-red animate-pulse"></span>
                            @elseif($ann->priority === 'high')
                                <span class="w-2 h-2 rounded-full bg-hmti-yellow"></span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-hmti-blue"></span>
                            @endif
                            <p class="text-sm font-medium text-hmti-dark truncate">{{ $ann->title }}</p>
                        </div>
                        <p class="text-xs text-hmti-gray line-clamp-2">{{ Str::limit($ann->body, 80) }}</p>
                        <p class="text-[10px] text-hmti-gray mt-1">{{ $ann->created_at->diffForHumans() }} · {{ $ann->author->name }}</p>
                    </div>
                @empty
                    <p class="text-sm text-hmti-gray text-center py-4">Belum ada pengumuman.</p>
                @endforelse
            </div>
        </div>

        {{-- Active Projects --}}
        <div class="card">
            <div class="card-header">
                <h3 class="text-base font-semibold text-hmti-dark">Proyek Aktif</h3>
            </div>
            <div class="space-y-3">
                @forelse($activeProjects as $project)
                    <div class="p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="flex items-center justify-between mb-1">
                            <p class="text-sm font-medium text-hmti-dark truncate">{{ $project->name }}</p>
                            <span class="badge text-[10px] {{ $project->status === 'in_progress' ? 'badge-yellow' : 'badge-blue' }}">
                                {{ $project->status === 'in_progress' ? 'Berjalan' : 'Perencanaan' }}
                            </span>
                        </div>
                        <p class="text-xs text-hmti-gray">Lead: {{ $project->lead->name }}</p>
                        <p class="text-[10px] text-hmti-gray">{{ $project->start_date->format('d M Y') }} —
                            {{ $project->end_date ? $project->end_date->format('d M Y') : 'TBD' }}</p>
                    </div>
                @empty
                    <p class="text-sm text-hmti-gray text-center py-4">Belum ada proyek aktif.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function memberGrowthChart() {
        return {
            chart: null,
            async init() {
                const res = await fetch('{{ route("api.chart-data") }}?type=member_growth');
                const data = await res.json();
                this.chart = new Chart(this.$refs.memberChart, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        };
    }

    function eventAttendanceChart() {
        return {
            chart: null,
            async init() {
                const res = await fetch('{{ route("api.chart-data") }}?type=event_attendance');
                const data = await res.json();
                this.chart = new Chart(this.$refs.attendanceChart, {
                    type: 'bar',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }
        };
    }

    function divisionChart() {
        return {
            chart: null,
            async init() {
                const res = await fetch('{{ route("api.chart-data") }}?type=division_distribution');
                const data = await res.json();
                this.chart = new Chart(this.$refs.divisionChart, {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 8, font: { size: 11 } } } }
                    }
                });
            }
        };
    }

    function projectStatusChart() {
        return {
            chart: null,
            async init() {
                const res = await fetch('{{ route("api.chart-data") }}?type=project_status');
                const data = await res.json();
                this.chart = new Chart(this.$refs.projectChart, {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, padding: 8, font: { size: 11 } } } }
                    }
                });
            }
        };
    }
</script>
@endpush
