@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Welcome Banner --}}
    <div class="relative rounded-2xl p-6 lg:p-8 text-white overflow-hidden animate-fade-in-up" style="background: linear-gradient(135deg, rgba(26,58,107,0.6) 0%, rgba(20,80,160,0.4) 50%, rgba(245,197,24,0.15) 100%); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.12); box-shadow: 0 8px 32px rgba(0,0,0,0.2), inset 0 1px 0 rgba(255,255,255,0.1);">
        <div class="absolute top-0 right-0 w-40 h-40 bg-hmti-yellow/10 rounded-full -translate-y-10 translate-x-10 animate-float"></div>
        <div class="absolute bottom-0 left-1/2 w-32 h-32 bg-white/5 rounded-full translate-y-10 animate-float-slow"></div>
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 32px 32px;"></div>
        {{-- Glass shine --}}
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
        <div class="relative">
            <div class="flex items-center gap-4 mb-3">
                <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-14 w-14 rounded-xl object-cover shadow-lg ring-2 ring-white/20">
                <div>
                    <h2 class="text-xl font-extrabold">Selamat Datang, {{ auth()->user()->name }}!</h2>
                    <p class="text-blue-200/80 text-sm">Panel Admin HMTI Margonda — {{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
            <p class="text-blue-100/70 text-sm mt-2">Kelola struktur organisasi, uang kas, dan data anggota HMTI Margonda dari sini.</p>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4" data-gsap="stagger-children">
        {{-- Total Anggota --}}
        <div class="group relative rounded-2xl p-3 sm:p-5 flex items-center gap-3 sm:gap-4 transition-all duration-300 hover:scale-[1.02] animate-fade-in-up delay-100 cursor-default" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);" x-data="animateCounter({{ $totalMembers }})" x-init="init()">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-blue-400/20 to-transparent"></div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300 group-hover:scale-110" style="background: rgba(59,130,246,0.15); border: 1px solid rgba(59,130,246,0.2);">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl sm:text-2xl font-extrabold text-white" x-text="current">0</p>
                <p class="text-xs text-blue-300/60">Anggota Aktif</p>
            </div>
        </div>

        {{-- Kas Lunas --}}
        <div class="group relative rounded-2xl p-3 sm:p-5 flex items-center gap-3 sm:gap-4 transition-all duration-300 hover:scale-[1.02] animate-fade-in-up delay-200 cursor-default" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);" x-data="animateCounter({{ $kasPaid }})" x-init="init()">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-green-400/20 to-transparent"></div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300 group-hover:scale-110" style="background: rgba(34,197,94,0.15); border: 1px solid rgba(34,197,94,0.2);">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl sm:text-2xl font-extrabold text-green-400" x-text="current">0</p>
                <p class="text-xs text-blue-300/60">Kas Lunas</p>
            </div>
        </div>

        {{-- Belum Bayar --}}
        <div class="group relative rounded-2xl p-3 sm:p-5 flex items-center gap-3 sm:gap-4 transition-all duration-300 hover:scale-[1.02] animate-fade-in-up delay-300 cursor-default" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);" x-data="animateCounter({{ $kasUnpaid }})" x-init="init()">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-yellow-400/20 to-transparent"></div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300 group-hover:scale-110" style="background: rgba(245,197,24,0.15); border: 1px solid rgba(245,197,24,0.2);">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl sm:text-2xl font-extrabold text-yellow-400" x-text="current">0</p>
                <p class="text-xs text-blue-300/60">Belum Bayar</p>
            </div>
        </div>

        {{-- Kena Sanksi --}}
        <div class="group relative rounded-2xl p-3 sm:p-5 flex items-center gap-3 sm:gap-4 transition-all duration-300 hover:scale-[1.02] animate-fade-in-up delay-500 cursor-default" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);" x-data="animateCounter({{ $kasLate }})" x-init="init()">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-red-400/20 to-transparent"></div>
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shrink-0 transition-all duration-300 group-hover:scale-110" style="background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.2);">
                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-xl sm:text-2xl font-extrabold text-red-400" x-text="current">0</p>
                <p class="text-xs text-blue-300/60">Kena Sanksi</p>
            </div>
        </div>
    </div>

    {{-- Financial Overview --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-gsap="stagger-children">
        {{-- Kas Collection Chart --}}
        <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);" x-data="kasChart()" x-init="init()">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Grafik Pengumpulan Kas {{ $currentYear }}</h3>
                <span class="text-[11px] font-medium px-2.5 py-1 rounded-full text-blue-300 bg-blue-400/10 border border-blue-400/20">Bulanan</span>
            </div>
            <div class="relative h-64">
                <canvas x-ref="kasChart"></canvas>
            </div>
        </div>

        {{-- Financial Summary --}}
        <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Ringkasan Keuangan</h3>
                <span class="text-[11px] font-medium px-2.5 py-1 rounded-full text-yellow-300 bg-yellow-400/10 border border-yellow-400/20">{{ \App\Models\KasPayment::MONTH_NAMES[$currentMonth] }} {{ $currentYear }}</span>
            </div>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 rounded-xl" style="background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.15);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(34,197,94,0.15);">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-green-300">Total Terkumpul</span>
                    </div>
                    <span class="font-bold text-green-400">Rp {{ number_format($totalCollected, 0, ',', '.') }}</span>
                </div>

                <div class="flex items-center justify-between p-4 rounded-xl" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.15);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: rgba(239,68,68,0.15);">
                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-red-300">Belum Terbayar</span>
                    </div>
                    <span class="font-bold text-red-400">Rp {{ number_format($totalOutstanding, 0, ',', '.') }}</span>
                </div>

                <div class="pt-3" style="border-top: 1px solid rgba(255,255,255,0.08);">
                    <a href="{{ route('admin.kas.index') }}" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl text-sm font-semibold text-white transition-all duration-300 hover:scale-[1.02]" style="background: linear-gradient(135deg, rgba(245,197,24,0.3) 0%, rgba(26,58,107,0.5) 100%); border: 1px solid rgba(245,197,24,0.2);">
                        Kelola Uang Kas
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Division breakdown + Sanctioned Members --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-gsap="stagger-children">
        {{-- Division breakdown --}}
        <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
            <h3 class="text-lg font-semibold text-white mb-4">Anggota per Divisi</h3>
            <div class="space-y-3">
                @php
                    $divColors = ['kwsb' => 'blue', 'kominfo' => 'yellow', 'litbang' => 'green', 'psdm' => 'purple'];
                    $divColorHex = ['kwsb' => '59,130,246', 'kominfo' => '245,197,24', 'litbang' => '34,197,94', 'psdm' => '168,85,247'];
                    $divNames = ['kwsb' => 'KWSB', 'kominfo' => 'Kominfo', 'litbang' => 'Litbang', 'psdm' => 'PSDM'];
                @endphp
                @foreach(['kwsb', 'kominfo', 'litbang', 'psdm'] as $div)
                <div class="flex items-center justify-between p-3 rounded-xl transition-all duration-200 hover:scale-[1.01]" style="background: rgba({{ $divColorHex[$div] }},0.06); border: 1px solid rgba({{ $divColorHex[$div] }},0.12);">
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-{{ $divColors[$div] }}-400"></div>
                        <span class="text-sm font-medium text-white">{{ $divNames[$div] }}</span>
                    </div>
                    <span class="text-sm font-bold text-{{ $divColors[$div] }}-400">{{ $divisions[$div] ?? 0 }} anggota</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Sanctioned Members --}}
        <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);">
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Anggota Kena Sanksi</h3>
                <span class="text-[11px] font-medium px-2.5 py-1 rounded-full text-red-300 bg-red-400/10 border border-red-400/20">{{ $sanctionedMembers->count() }} orang</span>
            </div>
            @if($sanctionedMembers->count() > 0)
            <div class="space-y-3 max-h-64 overflow-y-auto">
                @foreach($sanctionedMembers as $member)
                <div class="flex items-center justify-between p-3 rounded-xl" style="background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.12);">
                    <div class="flex items-center gap-3">
                        <img src="{{ $member->avatar_url }}" alt="" class="w-8 h-8 rounded-full object-cover ring-1 ring-white/10">
                        <div>
                            <p class="text-sm font-medium text-white">{{ $member->name }}</p>
                            <p class="text-xs text-red-400/80">{{ $member->kasPayments->count() }} bulan tertunggak</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-red-400">
                        Rp {{ number_format($member->kasPayments->sum('total_amount'), 0, ',', '.') }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <svg class="w-12 h-12 text-green-500/30 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-blue-300/50">Semua anggota sudah membayar kas!</p>
            </div>
            @endif
        </div>
    </div>

    {{-- Recent Payments --}}
    <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: inset 0 1px 0 rgba(255,255,255,0.08);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-white">Pembayaran Terakhir</h3>
            <a href="{{ route('admin.kas.index') }}" class="text-sm text-blue-400 hover:text-hmti-yellow transition-colors">Lihat Semua</a>
        </div>
        @if($recentPayments->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Anggota</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Periode</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Jumlah</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Tanggal Bayar</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentPayments as $payment)
                    <tr class="transition-colors hover:bg-white/[0.03]" style="border-bottom: 1px solid rgba(255,255,255,0.04);">
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <img src="{{ $payment->member->avatar_url }}" alt="" class="w-7 h-7 rounded-full ring-1 ring-white/10">
                                <span class="font-medium text-white">{{ $payment->member->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-200/70">{{ $payment->period_label }}</td>
                        <td class="py-3 px-4 font-medium text-white">{{ $payment->formatted_total }}</td>
                        <td class="py-3 px-4 text-blue-300/50">{{ $payment->paid_at?->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-4">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-green-400 bg-green-400/10 border border-green-400/20">Lunas</span>
                            @if($payment->is_late)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-red-400 bg-red-400/10 border border-red-400/20 ml-1">+Denda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-center py-8 text-blue-300/50 text-sm">Belum ada pembayaran.</p>
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
                            backgroundColor: 'rgba(59,130,246,0.5)',
                            borderColor: 'rgba(59,130,246,0.8)',
                            borderWidth: 1,
                            borderRadius: 6,
                        },
                        {
                            label: 'Target',
                            data: data.map(d => d.expected),
                            backgroundColor: 'rgba(245, 197, 24, 0.2)',
                            borderColor: 'rgba(245,197,24,0.4)',
                            borderWidth: 1,
                            borderRadius: 6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 15,
                                color: 'rgba(147,197,253,0.5)',
                                font: { size: 11 }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255,255,255,0.05)', drawBorder: false },
                            ticks: {
                                color: 'rgba(147,197,253,0.4)',
                                callback: v => 'Rp ' + (v/1000) + 'k',
                                font: { size: 10 }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                color: 'rgba(147,197,253,0.4)',
                                font: { size: 10 }
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
