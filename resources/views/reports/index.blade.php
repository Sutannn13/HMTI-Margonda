@extends('layouts.app')
@section('title', 'Laporan & Sertifikat')
@section('page-title', 'Laporan & Sertifikat')

@section('content')
<div class="space-y-6">
    {{-- Monthly Report Section --}}
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-hmti-dark">Laporan Bulanan</h3>
        </div>
        <div class="p-4">
            <form action="{{ route('reports.monthly') }}" method="GET" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="label">Bulan</label>
                    <select name="month" class="input">
                        @for ($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ now()->month == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="label">Tahun</label>
                    <select name="year" class="input">
                        @for ($y = now()->year; $y >= now()->year - 3; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Unduh PDF
                </button>
            </form>
        </div>
    </div>

    {{-- Certificate Section --}}
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-hmti-dark">Sertifikat Kegiatan</h3>
        </div>
        <div class="p-4">
            <p class="text-sm text-hmti-gray mb-4">Pilih kegiatan untuk mengunduh sertifikat peserta.</p>

            @if($completedEvents->isEmpty())
                <div class="text-center py-8 text-hmti-gray">
                    <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                    </svg>
                    <p>Belum ada kegiatan selesai.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr>
                                <th class="table-header">Kegiatan</th>
                                <th class="table-header">Tanggal</th>
                                <th class="table-header">Peserta Hadir</th>
                                <th class="table-header text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completedEvents as $event)
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="table-cell font-medium text-hmti-dark">{{ $event->title }}</td>
                                    <td class="table-cell text-hmti-gray">{{ $event->start_date->format('d M Y') }}</td>
                                    <td class="table-cell">
                                        <span class="badge-blue">{{ $event->registrations->where('attendance_status', 'attended')->count() }}</span>
                                    </td>
                                    <td class="table-cell text-center space-x-2">
                                        <a href="{{ route('reports.bulk-certificates', $event) }}" class="btn-outline text-xs py-1 px-2">
                                            Semua Sertifikat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
