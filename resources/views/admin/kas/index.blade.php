@extends('layouts.admin')
@section('title', 'Uang Kas')
@section('page-title', 'Manajemen Uang Kas')

@section('content')
<div class="space-y-6">
    {{-- Month/Year Selector --}}
    <div class="card">
        <form method="GET" action="{{ route('admin.kas.index') }}" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="label">Bulan</label>
                <select name="month" class="input w-40">
                    @foreach(\App\Models\KasPayment::MONTH_NAMES as $num => $name)
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="label">Tahun</label>
                <select name="year" class="input w-28">
                    @for($y = 2024; $y <= now()->year + 1; $y++)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn-primary">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Tampilkan
            </button>
        </form>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3">
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-xl font-bold text-hmti-blue">{{ $stats['total_members'] }}</p>
            <p class="text-[10px] text-hmti-gray mt-1">Total Anggota</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-xl font-bold text-green-600">{{ $stats['paid'] }}</p>
            <p class="text-[10px] text-hmti-gray mt-1">Lunas</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-xl font-bold text-yellow-600">{{ $stats['unpaid'] }}</p>
            <p class="text-[10px] text-hmti-gray mt-1">Belum Bayar</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-xl font-bold text-red-600">{{ $stats['late'] }}</p>
            <p class="text-[10px] text-hmti-gray mt-1">Kena Denda</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-lg font-bold text-green-600">Rp {{ number_format($stats['total_collected']/1000, 0, ',', '.') }}k</p>
            <p class="text-[10px] text-hmti-gray mt-1">Terkumpul</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-lg font-bold text-red-600">Rp {{ number_format($stats['total_outstanding']/1000, 0, ',', '.') }}k</p>
            <p class="text-[10px] text-hmti-gray mt-1">Tertunggak</p>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <p class="text-lg font-bold text-orange-600">Rp {{ number_format($stats['total_fines']/1000, 0, ',', '.') }}k</p>
            <p class="text-[10px] text-hmti-gray mt-1">Total Denda</p>
        </div>
    </div>

    {{-- Info Banner --}}
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <div class="text-sm text-blue-800">
            <p class="font-semibold">Aturan Uang Kas:</p>
            <ul class="mt-1 space-y-1 text-xs">
                <li>• Iuran bulanan: <strong>Rp 25.000</strong> per anggota</li>
                <li>• Denda keterlambatan: <strong>Rp 15.000</strong> jika belum bayar hingga berganti bulan</li>
                <li>• Sisa uang kas: dikembalikan atau untuk planning bersama</li>
            </ul>
        </div>
    </div>

    {{-- Payment Table --}}
    <div class="card overflow-hidden !p-0">
        <div class="p-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-hmti-dark">
                Daftar Pembayaran - {{ \App\Models\KasPayment::MONTH_NAMES[$month] }} {{ $year }}
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="table-header">#</th>
                        <th class="table-header">Anggota</th>
                        <th class="table-header">Divisi</th>
                        <th class="table-header">Iuran</th>
                        <th class="table-header">Denda</th>
                        <th class="table-header">Total</th>
                        <th class="table-header">Status</th>
                        <th class="table-header">Catatan</th>
                        <th class="table-header text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($payments as $i => $payment)
                    <tr class="hover:bg-gray-50 {{ $payment->is_late && !$payment->is_paid ? 'bg-red-50/50' : '' }}">
                        <td class="table-cell text-hmti-gray">{{ $payments->firstItem() + $i }}</td>
                        <td class="table-cell">
                            <div class="flex items-center gap-2">
                                <img src="{{ $payment->member->avatar_url }}" alt="" class="w-7 h-7 rounded-full">
                                <div>
                                    <p class="font-medium text-hmti-dark">{{ $payment->member->name }}</p>
                                    <p class="text-[10px] text-hmti-gray">{{ $payment->member->position_label }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="table-cell">
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                                {{ $payment->member->division === 'kwsb' ? 'bg-blue-100 text-blue-700' :
                                   ($payment->member->division === 'kominfo' ? 'bg-yellow-100 text-yellow-700' :
                                   ($payment->member->division === 'litbang' ? 'bg-green-100 text-green-700' :
                                   'bg-purple-100 text-purple-700')) }}">
                                {{ strtoupper($payment->member->division) }}
                            </span>
                        </td>
                        <td class="table-cell">{{ $payment->formatted_amount }}</td>
                        <td class="table-cell">
                            @if($payment->fine_amount > 0)
                                <span class="text-red-600 font-medium">{{ $payment->formatted_fine }}</span>
                            @else
                                <span class="text-hmti-gray">-</span>
                            @endif
                        </td>
                        <td class="table-cell font-semibold">{{ $payment->formatted_total }}</td>
                        <td class="table-cell">
                            @if($payment->is_paid)
                                <span class="badge-green">Lunas</span>
                                @if($payment->paid_at)
                                    <p class="text-[10px] text-hmti-gray mt-0.5">{{ $payment->paid_at->format('d/m/Y') }}</p>
                                @endif
                            @elseif($payment->is_late)
                                <span class="badge-red">Telat + Denda</span>
                            @else
                                <span class="badge-yellow">Belum Bayar</span>
                            @endif
                        </td>
                        <td class="table-cell">
                            <div x-data="{ editing: false }" class="relative">
                                <button @click="editing = !editing" class="text-xs text-hmti-blue hover:underline">
                                    {{ $payment->notes ? Str::limit($payment->notes, 20) : 'Tambah catatan' }}
                                </button>
                                <div x-show="editing" @click.away="editing = false" x-transition
                                     class="absolute right-0 top-6 z-10 w-64 bg-white rounded-lg shadow-lg border p-3">
                                    <form method="POST" action="{{ route('admin.kas.update-notes', $payment) }}">
                                        @csrf @method('PUT')
                                        <textarea name="notes" rows="2" class="input text-xs" placeholder="Catatan...">{{ $payment->notes }}</textarea>
                                        <button type="submit" class="btn-primary text-xs mt-2 w-full">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="table-cell text-center">
                            @if($payment->is_paid)
                                <form method="POST" action="{{ route('admin.kas.mark-unpaid', $payment) }}" class="inline"
                                      onsubmit="return confirm('Batalkan pembayaran {{ $payment->member->name }}?')">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 font-medium transition-colors">
                                        Batalkan
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.kas.mark-paid', $payment) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-green-500 text-white hover:bg-green-600 font-medium transition-colors">
                                        Tandai Lunas
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="table-cell text-center py-8 text-hmti-gray">
                            Belum ada data kas untuk periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($payments->hasPages())
        <div class="p-4 border-t border-gray-100">
            {{ $payments->links() }}
        </div>
        @endif
    </div>

    {{-- Disposition --}}
    @if($summary)
    <div class="card">
        <div class="card-header">
            <h3 class="font-semibold text-hmti-dark">Disposisi Sisa Uang Kas</h3>
        </div>
        <form method="POST" action="{{ route('admin.kas.disposition') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $year }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label">Keputusan</label>
                    <select name="disposition" class="input">
                        <option value="pending" {{ $summary->disposition === 'pending' ? 'selected' : '' }}>Belum Ditentukan</option>
                        <option value="returned" {{ $summary->disposition === 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="planning" {{ $summary->disposition === 'planning' ? 'selected' : '' }}>Untuk Planning Bersama</option>
                    </select>
                </div>
                <div>
                    <label class="label">Catatan</label>
                    <input type="text" name="notes" class="input" value="{{ $summary->notes }}" placeholder="Catatan tambahan...">
                </div>
            </div>
            <button type="submit" class="btn-primary">Simpan Disposisi</button>
        </form>
    </div>
    @endif
</div>
@endsection
