@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Welcome Banner --}}
    <div class="bg-gradient-to-r from-hmti-blue to-hmti-blue-light rounded-2xl p-6 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-40 h-40 bg-hmti-yellow/10 rounded-full -translate-y-10 translate-x-10"></div>
        <div class="absolute bottom-0 left-1/2 w-32 h-32 bg-white/5 rounded-full translate-y-10"></div>
        <div class="relative">
            <div class="flex items-center gap-4 mb-3">
                <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-12 w-12 rounded-xl object-cover shadow-lg">
                <div>
                    <h2 class="text-xl font-bold">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="text-blue-200 text-sm">Panel Admin HMTI Margonda</p>
                </div>
            </div>
            <p class="text-blue-100 text-sm">Kelola struktur organisasi, uang kas, dan data anggota HMTI Margonda dari sini.</p>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Total Anggota --}}
        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-hmti-blue/10 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-hmti-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-hmti-dark">{{ $totalMembers }}</p>
                <p class="text-xs text-hmti-gray">Anggota Aktif</p>
            </div>
        </div>

        {{-- Kas Lunas Bulan Ini --}}
        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-green-600">{{ $kasPaid }}</p>
                <p class="text-xs text-hmti-gray">Kas Lunas (Bulan Ini)</p>
            </div>
        </div>

        {{-- Kas Belum Bayar --}}
        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-yellow-600">{{ $kasUnpaid }}</p>
                <p class="text-xs text-hmti-gray">Belum Bayar</p>
            </div>
        </div>

        {{-- Kas Terlambat --}}
        <div class="stat-card">
            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-red-600">{{ $kasLate }}</p>
                <p class="text-xs text-hmti-gray">Kena Sanksi</p>
            </div>
        </div>
    </div>

    {{-- Financial Overview --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Kas Collection Chart --}}
        <div class="card" x-data="kasChart()" x-init="init()">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Grafik Pengumpulan Kas {{ $currentYear }}</h3>
                <span class="badge-blue">Bulanan</span>
            </div>
            <div class="relative h-64">
                <canvas x-ref="kasChart"></canvas>
            </div>
        </div>

        {{-- Financial Summary --}}
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Ringkasan Keuangan</h3>
                <span class="badge-yellow">{{ \App\Models\KasPayment::MONTH_NAMES[$currentMonth] }} {{ $currentYear }}</span>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-green-800">Total Terkumpul</span>
                    </div>
                    <span class="font-bold text-green-700">Rp {{ number_format($totalCollected, 0, ',', '.') }}</span>
                </div>

                <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-red-800">Belum Terbayar</span>
                    </div>
                    <span class="font-bold text-red-700">Rp {{ number_format($totalOutstanding, 0, ',', '.') }}</span>
                </div>

                <div class="pt-3 border-t border-gray-100">
                    <a href="{{ route('admin.kas.index') }}" class="btn-primary w-full justify-center">
                        Kelola Uang Kas
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Division breakdown + Sanctioned Members --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Division breakdown --}}
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Anggota per Divisi</h3>
            </div>
            <div class="space-y-3">
                @php
                    $divColors = ['kwsb' => 'blue', 'kominfo' => 'yellow', 'litbang' => 'green', 'psdm' => 'purple'];
                    $divNames = ['kwsb' => 'KWSB', 'kominfo' => 'Kominfo', 'litbang' => 'Litbang', 'psdm' => 'PSDM'];
                @endphp
                @foreach(['kwsb', 'kominfo', 'litbang', 'psdm'] as $div)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-{{ $divColors[$div] }}-500"></div>
                        <span class="text-sm font-medium text-hmti-dark">{{ $divNames[$div] }}</span>
                    </div>
                    <span class="text-sm font-bold text-hmti-blue">{{ $divisions[$div] ?? 0 }} anggota</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Sanctioned Members --}}
        <div class="card">
            <div class="card-header">
                <h3 class="text-lg font-semibold text-hmti-dark">Anggota Kena Sanksi</h3>
                <span class="badge-red">{{ $sanctionedMembers->count() }} orang</span>
            </div>
            @if($sanctionedMembers->count() > 0)
            <div class="space-y-3 max-h-64 overflow-y-auto">
                @foreach($sanctionedMembers as $member)
                <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-100">
                    <div class="flex items-center gap-3">
                        <img src="{{ $member->avatar_url }}" alt="" class="w-8 h-8 rounded-full object-cover">
                        <div>
                            <p class="text-sm font-medium text-hmti-dark">{{ $member->name }}</p>
                            <p class="text-xs text-red-600">{{ $member->kasPayments->count() }} bulan tertunggak</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-red-600">
                        Rp {{ number_format($member->kasPayments->sum('total_amount'), 0, ',', '.') }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-green-300 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-hmti-gray">Semua anggota sudah membayar kas!</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Recent Payments --}}
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-hmti-dark">Pembayaran Terakhir</h3>
            <a href="{{ route('admin.kas.index') }}" class="text-sm text-hmti-blue hover:underline">Lihat Semua</a>
        </div>
        @if($recentPayments->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="table-header">Anggota</th>
                        <th class="table-header">Periode</th>
                        <th class="table-header">Jumlah</th>
                        <th class="table-header">Tanggal Bayar</th>
                        <th class="table-header">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($recentPayments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="table-cell">
                            <div class="flex items-center gap-2">
                                <img src="{{ $payment->member->avatar_url }}" alt="" class="w-7 h-7 rounded-full">
                                <span class="font-medium">{{ $payment->member->name }}</span>
                            </div>
                        </td>
                        <td class="table-cell">{{ $payment->period_label }}</td>
                        <td class="table-cell font-medium">{{ $payment->formatted_total }}</td>
                        <td class="table-cell text-hmti-gray">{{ $payment->paid_at?->format('d/m/Y H:i') }}</td>
                        <td class="table-cell">
                            <span class="badge-green">Lunas</span>
                            @if($payment->is_late)
                                <span class="badge-red ml-1">+Denda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-center py-8 text-hmti-gray text-sm">Belum ada pembayaran.</p>
        @endif
    </div>
</div>

@push('scripts')
<script>
function kasChart() {
    return {
        init() {
            const data = @json($yearlyKas);
            new Chart(this.$refs.kasChart, {
                type: 'bar',
                data: {
                    labels: data.map(d => d.month.substring(0, 3)),
                    datasets: [
                        {
                            label: 'Terkumpul',
                            data: data.map(d => d.collected),
                            backgroundColor: 'rgba(26, 58, 107, 0.8)',
                            borderRadius: 6,
                        },
                        {
                            label: 'Target',
                            data: data.map(d => d.expected),
                            backgroundColor: 'rgba(245, 197, 24, 0.3)',
                            borderRadius: 6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: v => 'Rp ' + (v/1000) + 'k'
                            }
                        }
                    }
                }
            });
        }
    }
}
</script>
@endpush
@endsection
