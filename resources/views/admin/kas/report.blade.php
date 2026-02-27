@extends('layouts.admin')
@section('title', 'Laporan Kas')
@section('page-title', 'Laporan Uang Kas')

@section('content')
<div class="space-y-6">
    {{-- Year Selector --}}
    <div class="card">
        <form method="GET" action="{{ route('admin.kas.report') }}" class="flex items-end gap-4">
            <div>
                <label class="label">Tahun</label>
                <select name="year" class="input w-28">
                    @for($y = 2024; $y <= now()->year + 1; $y++)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn-primary">Tampilkan</button>
        </form>
    </div>

    {{-- Yearly Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-green-50 rounded-xl p-6 border border-green-200 text-center">
            <p class="text-sm text-green-700 font-medium">Total Terkumpul {{ $year }}</p>
            <p class="text-3xl font-extrabold text-green-700 mt-2">Rp {{ number_format($totalCollectedYear, 0, ',', '.') }}</p>
        </div>
        <div class="bg-red-50 rounded-xl p-6 border border-red-200 text-center">
            <p class="text-sm text-red-700 font-medium">Total Tertunggak {{ $year }}</p>
            <p class="text-3xl font-extrabold text-red-700 mt-2">Rp {{ number_format($totalOutstandingYear, 0, ',', '.') }}</p>
        </div>
        <div class="bg-orange-50 rounded-xl p-6 border border-orange-200 text-center">
            <p class="text-sm text-orange-700 font-medium">Total Denda {{ $year }}</p>
            <p class="text-3xl font-extrabold text-orange-700 mt-2">Rp {{ number_format($totalFinesYear, 0, ',', '.') }}</p>
        </div>
    </div>

    {{-- Monthly Chart --}}
    <div class="card" x-data="reportChart()" x-init="init()">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-hmti-dark">Grafik Kas Bulanan {{ $year }}</h3>
        </div>
        <div class="relative h-72">
            <canvas x-ref="reportChart"></canvas>
        </div>
    </div>

    {{-- Monthly Breakdown Table --}}
    <div class="card overflow-hidden !p-0">
        <div class="p-4 border-b border-gray-100">
            <h3 class="font-semibold text-hmti-dark">Rincian Per Bulan</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">Bulan</th>
                        <th class="table-header text-center">Anggota</th>
                        <th class="table-header text-center">Lunas</th>
                        <th class="table-header text-center">Belum</th>
                        <th class="table-header text-right">Terkumpul</th>
                        <th class="table-header text-right">Tertunggak</th>
                        <th class="table-header text-right">Denda</th>
                        <th class="table-header">Disposisi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($monthlyData as $m => $data)
                    <tr class="hover:bg-gray-50">
                        <td class="table-cell font-medium">
                            <a href="{{ route('admin.kas.index', ['month' => $m, 'year' => $year]) }}" class="text-hmti-blue hover:underline">
                                {{ $data['month_name'] }}
                            </a>
                        </td>
                        <td class="table-cell text-center">{{ $data['total_members'] }}</td>
                        <td class="table-cell text-center">
                            <span class="text-green-600 font-medium">{{ $data['paid'] }}</span>
                        </td>
                        <td class="table-cell text-center">
                            @if($data['unpaid'] > 0)
                                <span class="text-red-600 font-medium">{{ $data['unpaid'] }}</span>
                            @else
                                <span class="text-hmti-gray">0</span>
                            @endif
                        </td>
                        <td class="table-cell text-right font-medium text-green-700">
                            Rp {{ number_format($data['collected'], 0, ',', '.') }}
                        </td>
                        <td class="table-cell text-right">
                            @if($data['outstanding'] > 0)
                                <span class="text-red-600 font-medium">Rp {{ number_format($data['outstanding'], 0, ',', '.') }}</span>
                            @else
                                <span class="text-hmti-gray">-</span>
                            @endif
                        </td>
                        <td class="table-cell text-right">
                            @if($data['fines'] > 0)
                                <span class="text-orange-600 font-medium">Rp {{ number_format($data['fines'], 0, ',', '.') }}</span>
                            @else
                                <span class="text-hmti-gray">-</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            <span class="text-xs {{ $data['disposition'] === 'Belum Ditentukan' ? 'text-hmti-gray' : 'text-hmti-blue font-medium' }}">
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
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-hmti-dark">Anggota dengan Tunggakan</h3>
            <span class="badge-red">{{ $outstandingMembers->count() }} orang</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">Anggota</th>
                        <th class="table-header">Divisi</th>
                        <th class="table-header text-center">Bulan Belum Bayar</th>
                        <th class="table-header text-center">Bulan Kena Denda</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($outstandingMembers as $member)
                    <tr class="hover:bg-red-50/50">
                        <td class="table-cell">
                            <div class="flex items-center gap-2">
                                <img src="{{ $member->avatar_url }}" alt="" class="w-7 h-7 rounded-full">
                                <span class="font-medium">{{ $member->name }}</span>
                            </div>
                        </td>
                        <td class="table-cell">{{ strtoupper($member->division) }}</td>
                        <td class="table-cell text-center">
                            <span class="text-yellow-600 font-bold">{{ $member->unpaid_count }}</span>
                        </td>
                        <td class="table-cell text-center">
                            @if($member->late_count > 0)
                                <span class="text-red-600 font-bold">{{ $member->late_count }}</span>
                            @else
                                <span class="text-hmti-gray">0</span>
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
                        legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { callback: v => 'Rp ' + (v/1000) + 'k' }
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
