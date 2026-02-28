@extends('layouts.guest')
@section('title', 'Struktur Organisasi')

@section('content')
{{-- Header --}}
<section class="relative overflow-hidden bg-gradient-to-br from-hmti-blue-dark via-hmti-blue to-hmti-blue-light min-h-[40vh] sm:min-h-[50vh] flex items-center">
    <div class="absolute inset-0 opacity-10">
        <img src="{{ asset('images/hmti2.jpeg') }}" alt="" class="w-full h-full object-cover">
    </div>
    {{-- Hero glow --}}
    <div class="absolute inset-0 bg-hero-glow"></div>
    {{-- Animated bg --}}
    <div class="absolute top-10 right-10 w-48 sm:w-72 h-48 sm:h-72 bg-hmti-yellow/10 rounded-full animate-blob blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-40 sm:w-56 h-40 sm:h-56 bg-white/5 rounded-full animate-float-slow blur-2xl"></div>
    <div class="absolute inset-0 bg-grid-pattern"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-36 text-center w-full">

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-premium text-white/90 text-xs font-semibold tracking-wide mb-4 sm:mb-6" data-aos="fade-up" data-aos-delay="100">
            <span class="w-2 h-2 rounded-full bg-hmti-yellow animate-pulse-glow"></span>
            Periode {{ date('Y') }}/{{ date('Y') + 1 }}
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-6xl font-black text-white mb-3 sm:mb-4 text-shadow" data-aos="fade-up" data-aos-delay="200">Struktur Organisasi</h1>
        <p class="text-hmti-yellow font-bold text-base sm:text-lg" data-aos="fade-up" data-aos-delay="300">HMTI Margonda — Universitas Bina Sarana Informatika</p>
    </div>

    {{-- Wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 80L80 68C160 56 320 32 480 28C640 24 800 40 960 44C1120 48 1280 40 1360 36L1440 32V80H0Z" fill="rgba(255,255,255,0.02)"/>
        </svg>
    </div>
</section>

{{-- KWSB Section --}}
<section class="py-12 sm:py-16 lg:py-24 relative z-10" style="background: rgba(255,255,255,0.02); backdrop-filter: blur(8px); border-top: 1px solid rgba(255,255,255,0.06); border-bottom: 1px solid rgba(255,255,255,0.06);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-white/10 text-white/80 uppercase tracking-wider">
                Pimpinan Inti
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-hmti-blue mt-4">KWSB</h2>
            <p class="text-hmti-gray mt-2 text-sm sm:text-base">Ketua, Wakil Ketua, Sekretaris & Bendahara</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        @if($kwsb->count() > 0)
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-8 max-w-5xl mx-auto">
            @foreach($kwsb as $i => $member)
            <div class="text-center group" data-aos="zoom-in" data-aos-delay="{{ ($i + 1) * 100 }}">
                <div class="relative mx-auto w-28 h-28 sm:w-40 sm:h-40 mb-3 sm:mb-5">
                    {{-- Animated ring --}}
                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-hmti-blue to-hmti-yellow opacity-20 group-hover:opacity-50 transition-all duration-500 group-hover:scale-110"></div>
                    <div class="absolute -inset-1.5 sm:-inset-2 rounded-full border-2 border-dashed border-hmti-yellow/30 group-hover:border-hmti-yellow/60 transition-colors animate-[spin_20s_linear_infinite]"></div>
                    <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}"
                         class="w-28 h-28 sm:w-40 sm:h-40 rounded-full object-cover border-3 sm:border-4 border-white shadow-xl group-hover:shadow-2xl transition-all duration-300 group-hover:scale-105">
                </div>
                <h3 class="font-bold text-sm sm:text-lg text-white group-hover:text-hmti-yellow transition-colors">{{ $member->name }}</h3>
                <span class="inline-flex items-center px-3 sm:px-4 py-1 sm:py-1.5 rounded-full text-[10px] sm:text-xs font-bold mt-1.5 sm:mt-2 shadow-sm
                    {{ $member->position === 'ketua' ? 'bg-hmti-blue text-white' :
                       ($member->position === 'wakil' ? 'bg-hmti-blue-light text-white' :
                       ($member->position === 'sekretaris' ? 'bg-hmti-yellow text-hmti-blue-dark' :
                       'bg-green-500 text-white')) }}">
                    {{ $member->position_label }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-hmti-gray">Data belum tersedia.</p>
        @endif
    </div>
</section>

{{-- Divisi Cards --}}
<section class="py-12 sm:py-16 lg:py-24 relative overflow-hidden z-10" style="background: rgba(0,0,0,0.12); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.04);">
    <div class="absolute top-0 right-0 w-80 h-80 bg-hmti-blue/3 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-hmti-yellow/20 text-hmti-yellow uppercase tracking-wider">
                Divisi Organisasi
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-hmti-blue mt-4">Divisi-Divisi HMTI Margonda</h2>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8">
            @php
            $divisions = [
                ['name' => 'Divisi Kominfo', 'subtitle' => 'Komunikasi & Informasi', 'data' => $kominfo, 'from' => 'from-yellow-500', 'to' => 'to-yellow-600', 'kadivColor' => 'bg-yellow-100 text-yellow-700', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z'],
                ['name' => 'Divisi Litbang', 'subtitle' => 'Penelitian & Pengembangan', 'data' => $litbang, 'from' => 'from-green-500', 'to' => 'to-green-600', 'kadivColor' => 'bg-green-100 text-green-700', 'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z'],
                ['name' => 'Divisi PSDM', 'subtitle' => 'Pengembangan SDM', 'data' => $psdm, 'from' => 'from-purple-500', 'to' => 'to-purple-600', 'kadivColor' => 'bg-purple-100 text-purple-700', 'icon' => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5'],
            ];
            @endphp

            @foreach($divisions as $di => $div)
            <div class="rounded-2xl overflow-hidden shadow-lg border border-white/10 hover:shadow-2xl hover:border-hmti-yellow/30 transition-all duration-500 hover:-translate-y-1 group card-glow" data-aos="fade-up" data-aos-delay="{{ ($di + 1) * 150 }}">
                <div class="bg-gradient-to-r {{ $div['from'] }} {{ $div['to'] }} p-4 sm:p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-5 translate-x-5"></div>
                    <div class="relative flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $div['icon'] }}"/></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-white">{{ $div['name'] }}</h3>
                            <p class="text-white/70 text-xs">{{ $div['subtitle'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-[#1e4080]/70 backdrop-blur-sm p-6 space-y-4">
                    @foreach($div['data'] as $member)
                    <div class="flex items-center gap-4 {{ !$loop->last ? 'pb-4 border-b border-white/10' : '' }} hover:bg-white/5 -mx-2 px-2 py-1 rounded-lg transition-colors">
                        <div class="relative">
                            <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover shadow-sm ring-2 ring-white">
                            @if($member->position === 'kadiv')
                            <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-hmti-yellow rounded-full flex items-center justify-center ring-2 ring-white">
                                <svg class="w-3 h-3 text-hmti-blue-dark" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-white">{{ $member->name }}</p>
                            <span class="text-xs px-2.5 py-0.5 rounded-full font-medium
                                {{ $member->position === 'kadiv' ? $div['kadivColor'] : 'bg-gray-100 text-gray-600' }}">
                                {{ $member->position_label }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @if($div['data']->count() === 0)
                    <p class="text-center text-hmti-gray text-sm py-4">Data belum tersedia.</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-12 sm:py-16 bg-white/5 backdrop-blur-md border-b border-white/10 relative overflow-hidden z-10">
    <div class="max-w-4xl mx-auto px-4 text-center" data-aos="fade-up">
        <div class="bg-gradient-to-r from-hmti-blue to-hmti-blue-dark rounded-2xl sm:rounded-3xl p-6 sm:p-10 lg:p-14 relative overflow-hidden shadow-2xl shadow-hmti-blue/20">
            <div class="absolute top-0 right-0 w-28 sm:w-40 h-28 sm:h-40 bg-hmti-yellow/10 rounded-full -translate-y-10 translate-x-10 animate-float"></div>
            <div class="absolute bottom-0 left-0 w-24 sm:w-32 h-24 sm:h-32 bg-white/5 rounded-full translate-y-8 -translate-x-8 animate-float-slow"></div>
            <div class="absolute inset-0 bg-grid-pattern"></div>

            <div class="relative">
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-black text-white mb-3 sm:mb-4 text-shadow">Tertarik Berkolaborasi?</h2>
                <p class="text-gray-300 mb-6 sm:mb-8 max-w-lg mx-auto text-sm sm:text-base">Ajukan ide kolaborasi, sponsorship, atau kerja sama kegiatan bersama HMTI Margonda.</p>
                <a href="{{ route('home') }}#kolaborasi" class="btn-shiny inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-3.5 bg-hmti-yellow text-hmti-blue-dark font-bold rounded-xl hover:bg-yellow-400 transition-all shadow-lg shadow-hmti-yellow/25 hover:scale-105">
                    Ajukan Kolaborasi
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
