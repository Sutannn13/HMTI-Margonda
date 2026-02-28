@extends('layouts.admin')
@section('title', 'Uang Kas')
@section('page-title', 'Manajemen Uang Kas')

@section('content')
<div class="space-y-6">
    {{-- Month/Year Selector --}}
    <div class="relative rounded-2xl p-5 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <form method="GET" action="{{ route('admin.kas.index') }}" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block">Bulan</label>
                <select name="month" class="input w-40" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    @foreach(\App\Models\KasPayment::MONTH_NAMES as $num => $name)
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block">Tahun</label>
                <select name="year" class="input w-28" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    @for($y = 2024; $y <= now()->year + 1; $y++)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn-primary btn-shiny">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Tampilkan
            </button>
        </form>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-7 gap-3" data-gsap="stagger-children">
        @php
            $statsArr = [
                ['value' => $stats['total_members'], 'label' => 'Total Anggota', 'color' => '96,165,250'],
                ['value' => $stats['paid'], 'label' => 'Lunas', 'color' => '74,222,128'],
                ['value' => $stats['unpaid'], 'label' => 'Belum Bayar', 'color' => '250,204,21'],
                ['value' => $stats['late'], 'label' => 'Kena Denda', 'color' => '248,113,113'],
                ['value' => 'Rp ' . number_format($stats['total_collected']/1000, 0, ',', '.') . 'k', 'label' => 'Terkumpul', 'color' => '74,222,128'],
                ['value' => 'Rp ' . number_format($stats['total_outstanding']/1000, 0, ',', '.') . 'k', 'label' => 'Tertunggak', 'color' => '248,113,113'],
                ['value' => 'Rp ' . number_format($stats['total_fines']/1000, 0, ',', '.') . 'k', 'label' => 'Total Denda', 'color' => '251,146,60'],
            ];
        @endphp
        @foreach($statsArr as $st)
        <div class="relative rounded-2xl p-4 text-center transition-all hover:scale-[1.02]" style="background: rgba({{ $st['color'] }},0.06); border: 1px solid rgba({{ $st['color'] }},0.15); backdrop-filter: blur(12px);">
            <p class="text-lg font-bold text-white">{{ $st['value'] }}</p>
            <p class="text-[10px] text-blue-300/60 mt-1">{{ $st['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Info Banner --}}
    <div class="relative rounded-2xl p-4 flex items-start gap-3 overflow-hidden" style="background: rgba(96,165,250,0.06); border: 1px solid rgba(96,165,250,0.15); backdrop-filter: blur(12px);">
        <svg class="w-5 h-5 text-blue-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
        </svg>
        <div class="text-sm text-blue-200/80">
            <p class="font-semibold text-blue-300">Aturan Uang Kas:</p>
            <ul class="mt-1 space-y-1 text-xs text-blue-200/60">
                <li>• Iuran bulanan: <strong class="text-blue-200">Rp 25.000</strong> per anggota</li>
                <li>• Denda keterlambatan: <strong class="text-blue-200">Rp 15.000</strong> jika belum bayar hingga berganti bulan</li>
                <li>• Sisa uang kas: dikembalikan atau untuk planning bersama</li>
            </ul>
        </div>
    </div>

    {{-- Payment Table --}}
    <div class="relative rounded-2xl overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="p-4 flex items-center justify-between" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h3 class="font-semibold text-white">
                Daftar Pembayaran - {{ \App\Models\KasPayment::MONTH_NAMES[$month] }} {{ $year }}
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.08);">
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">#</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Anggota</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Divisi</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Iuran</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Denda</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Total</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Status</th>
                        <th class="py-3 px-4 text-left text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Catatan</th>
                        <th class="py-3 px-4 text-center text-[11px] font-semibold text-blue-300/60 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $i => $payment)
                    <tr class="transition-colors hover:bg-white/[0.03] {{ $payment->is_late && !$payment->is_paid ? 'bg-red-500/[0.03]' : '' }}" style="border-bottom: 1px solid rgba(255,255,255,0.04);">
                        <td class="py-3 px-4 text-blue-300/50">{{ $payments->firstItem() + $i }}</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <img src="{{ $payment->member->avatar_url }}" alt="" class="w-7 h-7 rounded-full ring-1 ring-white/10">
                                <div>
                                    <p class="font-medium text-white">{{ $payment->member->name }}</p>
                                    <p class="text-[10px] text-blue-300/40">{{ $payment->member->position_label }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $divColors = [
                                    'kwsb'    => ['59,130,246', 'text-blue-400'],
                                    'kominfo' => ['245,197,24', 'text-yellow-400'],
                                    'litbang' => ['34,197,94', 'text-green-400'],
                                    'psdm'    => ['168,85,247', 'text-purple-400'],
                                ];
                                $dc = $divColors[$payment->member->division] ?? ['148,163,184', 'text-gray-400'];
                            @endphp
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full {{ $dc[1] }}" style="background: rgba({{ $dc[0] }},0.1); border: 1px solid rgba({{ $dc[0] }},0.2);">
                                {{ strtoupper($payment->member->division) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-blue-200/70">{{ $payment->formatted_amount }}</td>
                        <td class="py-3 px-4">
                            @if($payment->fine_amount > 0)
                                <span class="text-red-400 font-medium">{{ $payment->formatted_fine }}</span>
                            @else
                                <span class="text-blue-300/30">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 font-semibold text-white">{{ $payment->formatted_total }}</td>
                        <td class="py-3 px-4">
                            @if($payment->is_paid)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-green-400 bg-green-400/10 border border-green-400/20">Lunas</span>
                                @if($payment->paid_at)
                                    <p class="text-[10px] text-blue-300/40 mt-0.5">{{ $payment->paid_at->format('d/m/Y') }}</p>
                                @endif
                            @elseif($payment->is_late)
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-red-400 bg-red-400/10 border border-red-400/20">Telat + Denda</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold text-yellow-400 bg-yellow-400/10 border border-yellow-400/20">Belum Bayar</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <div x-data="{ editing: false }" class="relative">
                                <button @click="editing = !editing" class="text-xs text-hmti-yellow hover:text-white transition-colors">
                                    {{ $payment->notes ? Str::limit($payment->notes, 20) : 'Tambah catatan' }}
                                </button>
                                <div x-show="editing" @click.away="editing = false" x-transition
                                     class="absolute right-0 top-6 z-10 w-64 rounded-xl p-3 shadow-2xl" style="background: rgba(15,28,50,0.95); border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(20px);">
                                    <form method="POST" action="{{ route('admin.kas.update-notes', $payment) }}">
                                        @csrf @method('PUT')
                                        <textarea name="notes" rows="2" class="input text-xs w-full" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;" placeholder="Catatan...">{{ $payment->notes }}</textarea>
                                        <button type="submit" class="btn-primary text-xs mt-2 w-full btn-shiny">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 px-4 text-center">
                            @if($payment->is_paid)
                                <form method="POST" action="{{ route('admin.kas.mark-unpaid', $payment) }}" class="inline"
                                      onsubmit="event.preventDefault(); confirmAction({title:'Batalkan Pembayaran?',text:'Status {{ $payment->member->name }} akan dikembalikan ke belum bayar.',icon:'warning',confirmText:'Ya, batalkan!'}).then(r => { if(r.isConfirmed) this.submit(); });">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg text-white/60 bg-white/10 hover:bg-white/20 font-medium transition-colors border border-white/10">
                                        Batalkan
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.kas.mark-paid', $payment) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs px-3 py-1.5 rounded-lg bg-green-500/20 text-green-400 border border-green-500/30 hover:bg-green-500/30 font-medium transition-colors">
                                        Tandai Lunas
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="py-12 text-center text-blue-300/50 text-sm">
                            Belum ada data kas untuk periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($payments->hasPages())
        <div class="p-4" style="border-top: 1px solid rgba(255,255,255,0.06);">
            {{ $payments->links() }}
        </div>
        @endif
    </div>

    {{-- Disposition --}}
    @if($summary)
    <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="flex items-center justify-between mb-4" style="padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h3 class="font-semibold text-white">Disposisi Sisa Uang Kas</h3>
        </div>
        <form method="POST" action="{{ route('admin.kas.disposition') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $year }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block">Keputusan</label>
                    <select name="disposition" class="input w-full" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                        <option value="pending" {{ $summary->disposition === 'pending' ? 'selected' : '' }}>Belum Ditentukan</option>
                        <option value="returned" {{ $summary->disposition === 'returned' ? 'selected' : '' }}>Dikembalikan</option>
                        <option value="planning" {{ $summary->disposition === 'planning' ? 'selected' : '' }}>Untuk Planning Bersama</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block">Catatan</label>
                    <input type="text" name="notes" class="input w-full" value="{{ $summary->notes }}" placeholder="Catatan tambahan..." style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                </div>
            </div>
            <button type="submit" class="btn-primary btn-shiny">Simpan Disposisi</button>
        </form>
    </div>
    @endif
</div>
@endsection
