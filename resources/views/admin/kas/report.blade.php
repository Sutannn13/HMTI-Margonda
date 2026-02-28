@extends('layouts.admin')
@section('title', 'Laporan Kas')
@section('page-title', 'Laporan Uang Kas')

@section('content')
<div class="space-y-6">
    {{-- Year Selector --}}
    <div class="relative rounded-2xl p-5 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <form method="GET" action="{{ route('admin.kas.report') }}" class="flex items-end gap-4">
            <div>
                <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block">Tahun</label>
                <select name="year" class="input w-28" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    @for($y = 2024; $y <= now()->year + 1; $y++)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn-primary btn-shiny">Tampilkan</button>
        </form>
    </div>

    {{-- Yearly Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" data-gsap="stagger-children">
        <div class="relative rounded-2xl p-6 text-center overflow-hidden" style="background: rgba(74,222,128,0.06); border: 1px solid rgba(74,222,128,0.15); backdrop-filter: blur(12px);">
            <p class="text-sm text-green-400 font-medium">Total Terkumpul {{ $year }}</p>
            <p class="text-3xl font-extrabold text-green-400 mt-2">Rp {{ number_format($totalCollectedYear, 0, ',', '.') }}</p>
        </div>
        <div class="relative rounded-2xl p-6 text-center overflow-hidden" style="background: rgba(248,113,113,0.06); border: 1px solid rgba(248,113,113,0.15); backdrop-filter: blur(12px);">
            <p class="text-sm text-red-400 font-medium">Total Tertunggak {{ $year }}</p>
            <p class="text-3xl font-extrabold text-red-400 mt-2">Rp {{ number_format($totalOutstandingYear, 0, ',', '.') }}</p>
        </div>
        <div class="relative rounded-2xl p-6 text-center overflow-hidden" style="background: rgba(251,146,60,0.06); border: 1px solid rgba(251,146,60,0.15); backdrop-filter: blur(12px);">
            <p class="text-sm text-orange-400 font-medium">Total Denda {{ $year }}</p>
            <p class="text-3xl font-extrabold text-orange-400 mt-2">Rp {{ number_format($totalFinesYear, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Monthly Chart --}}
    <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);" x-data="reportChart()" x-init="init()">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="flex items-center justify-between mb-4" style="padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h3 class="text-lg font-semibold text-white">Grafik Kas Bulanan {{ $year }}</h3>
        </div>
        <div class="relative h-72">
            <canvas x-ref="reportChart"></canvas>
        </div>
    </div>

    {{-- Monthly Breakdown Table --}}
    <div class="relative rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="p-4" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h3 class="font-semibold text-white">Rincian Per Bulan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Bulan</th>
                        <th class="py-3 px-4 text-center text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Anggota</th>
                        <th class="py-3 px-4 text-center text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Lunas</th>
                        <th class="py-3 px-4 text-center text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Belum</th>
                        <th class="py-3 px-4 text-right text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Terkumpul</th>
                        <th class="py-3 px-4 text-right text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Tertunggak</th>
                        <th class="py-3 px-4 text-right text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Denda</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Disposisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlyData as $m => $data)
                    <tr class="transition-colors hover:bg-white/[0.03]" style="border-bottom: 1px solid rgba(255,255,255,0.04);">
                        <td class="py-3 px-4 font-medium">
                            <a href="{{ route('admin.kas.index', ['month' => $m, 'year' => $year]) }}" class="text-hmti-yellow hover:text-white transition-colors">
                                {{ $data['month_name'] }}
                            </a>
                        </td>
                        <td class="py-3 px-4 text-center text-blue-200/70">{{ $data['total_members'] }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-green-400 font-medium">{{ $data['paid'] }}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($data['unpaid'] > 0)
                                <span class="text-red-400 font-medium">{{ $data['unpaid'] }}</span>
                            @else
                                <span class="text-blue-300/30">0</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right font-medium text-green-400">
                            Rp {{ number_format($data['collected'], 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-4 text-right">
                            @if($data['outstanding'] > 0)
                                <span class="text-red-400 font-medium">Rp {{ number_format($data['outstanding'], 0, ',', '.') }}</span>
                            @else
                                <span class="text-blue-300/30">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-right">
                            @if($data['fines'] > 0)
                                <span class="text-orange-400 font-medium">Rp {{ number_format($data['fines'], 0, ',', '.') }}</span>
                            @else
                                <span class="text-blue-300/30">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="text-xs {{ $data['disposition'] === 'Belum Ditentukan' ? 'text-blue-300/40' : 'text-hmti-yellow font-medium' }}">
                                {{ $data['disposition'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Outstanding Members --}}
    @if($outstandingMembers->count() > 0)
    <div class="relative rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="p-4 flex items-center justify-between" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h3 class="text-lg font-semibold text-white">Anggota dengan Tunggakan</h3>
            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-red-400 bg-red-400/10 border border-red-400/20">{{ $outstandingMembers->count() }} orang</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Anggota</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Divisi</th>
                        <th class="py-3 px-4 text-center text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Bulan Belum Bayar</th>
                        <th class="py-3 px-4 text-center text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Bulan Kena Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($outstandingMembers as $member)
                    <tr class="transition-colors hover:bg-red-500/[0.03]" style="border-bottom: 1px solid rgba(255,255,255,0.04);">
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <img src="{{ $member->avatar_url }}" alt="" class="w-7 h-7 rounded-full ring-1 ring-white/10">
                                <span class="font-medium text-white">{{ $member->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-blue-200/70">{{ strtoupper($member->division) }}</td>
                        <td class="py-3 px-4 text-center">
                            <span class="text-yellow-400 font-bold">{{ $member->unpaid_count }}</span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($member->late_count > 0)
                                <span class="text-red-400 font-bold">{{ $member->late_count }}</span>
                            @else
                                <span class="text-blue-300/30">0</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
function reportChart() {
    return {
        init() {
            const data = @json($monthlyData);
            const labels = Object.values(data).map(d => d.month_name.substring(0, 3));
            new Chart(this.$refs.reportChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Terkumpul',
                            data: Object.values(data).map(d => d.collected),
                            borderColor: '#22c55e',
                            backgroundColor: 'rgba(34, 197, 94, 0.1)',
                            fill: true,
                            tension: 0.3,
                        },
                        {
                            label: 'Tertunggak',
                            data: Object.values(data).map(d => d.outstanding),
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            fill: true,
                            tension: 0.3,
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
    };
}
</script>
@endpush
@endsection
