@extends('layouts.guest')
@section('title', 'Beranda')

@section('content')
{{-- ===== HERO SECTION ===== --}}
<section class="relative overflow-hidden min-h-[100svh] flex items-center">
    {{-- Background image --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/hmti1.jpeg') }}" alt="HMTI Margonda" class="w-full h-full object-cover scale-105">
        <div class="absolute inset-0 bg-gradient-to-br from-hmti-blue-dark/95 via-hmti-blue/85 to-hmti-blue-dark/90"></div>
    </div>
    {{-- Hero glow --}}
    <div class="absolute inset-0 bg-hero-glow"></div>
    {{-- Animated bg blobs --}}
    <div class="absolute top-20 left-10 w-48 sm:w-72 h-48 sm:h-72 bg-hmti-yellow/10 rounded-full animate-blob blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-64 sm:w-96 h-64 sm:h-96 bg-hmti-blue-light/15 rounded-full animate-blob-delay blur-3xl"></div>
    <div class="absolute top-1/2 left-1/3 w-40 sm:w-56 h-40 sm:h-56 bg-white/5 rounded-full animate-float-slow blur-2xl"></div>
    {{-- Animated grid dots --}}
    <div class="absolute inset-0 bg-grid-pattern"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 lg:py-40 w-full">
        <div class="text-center">


            {{-- Badge --}}
            <div data-aos="fade-up" data-aos-delay="200">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass-premium text-white/90 text-xs font-semibold tracking-wide mb-4 sm:mb-6">
                    <span class="w-2 h-2 rounded-full bg-hmti-yellow animate-pulse-glow"></span>
                    Periode {{ date('Y') }}/{{ date('Y') + 1 }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-white mb-4 sm:mb-5 tracking-tight leading-[1.1] text-shadow" data-aos="fade-up" data-aos-delay="300">
                HMTI <span class="text-gradient">Margonda</span>
            </h1>
            <p class="text-lg sm:text-xl lg:text-2xl text-hmti-yellow font-bold mb-2 sm:mb-3" data-aos="fade-up" data-aos-delay="400">
                Himpunan Mahasiswa Teknologi Informasi
            </p>
            <p class="text-gray-300 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto mb-8 sm:mb-10 px-2" data-aos="fade-up" data-aos-delay="500">
                Universitas Bina Sarana Informatika — Kampus Margonda, Depok
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('guest.structure') }}" class="btn-shiny btn-magnetic group inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-3.5 bg-hmti-yellow text-hmti-blue-dark font-bold rounded-xl hover:bg-yellow-400 transition-all shadow-lg shadow-hmti-yellow/25 hover:shadow-hmti-yellow/40 hover:scale-105 w-full sm:w-auto justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Lihat Struktur Organisasi
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="#tentang" class="btn-magnetic inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-3.5 glass-premium rounded-xl text-white font-semibold hover:bg-white/15 transition-all w-full sm:w-auto justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    Jelajahi
                </a>
            </div>

            {{-- Stats ticker --}}
            <div class="mt-10 sm:mt-16 grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="700">
                <div class="glass-premium rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-center hover-lift cursor-default" x-data="animateCounter(4)" x-init="init()">
                    <p class="text-xl sm:text-2xl font-black text-hmti-yellow" x-text="current">0</p>
                    <p class="text-[10px] sm:text-[11px] text-gray-400 mt-0.5">Divisi Aktif</p>
                </div>
                <div class="glass-premium rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-center hover-lift cursor-default" x-data="animateCounter(14)" x-init="init()">
                    <p class="text-xl sm:text-2xl font-black text-hmti-yellow" x-text="current">0</p>
                    <p class="text-[10px] sm:text-[11px] text-gray-400 mt-0.5">Pengurus</p>
                </div>
                <div class="glass-premium rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-center hover-lift cursor-default" x-data="animateCounter(4)" x-init="init()">
                    <p class="text-xl sm:text-2xl font-black text-hmti-yellow" x-text="current">0</p>
                    <p class="text-[10px] sm:text-[11px] text-gray-400 mt-0.5">Program Kerja</p>
                </div>
                <div class="glass-premium rounded-xl px-3 sm:px-4 py-2.5 sm:py-3 text-center hover-lift cursor-default" x-data="animateCounter(2026)" x-init="init()">
                    <p class="text-xl sm:text-2xl font-black text-hmti-yellow" x-text="current">0</p>
                    <p class="text-[10px] sm:text-[11px] text-gray-400 mt-0.5">Aktif Sejak</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden sm:flex flex-col items-center gap-2 animate-float" data-aos="fade-up" data-aos-delay="900">
        <span class="text-white/40 text-xs tracking-widest uppercase">Scroll</span>
        <div class="w-5 h-8 rounded-full border-2 border-white/20 flex justify-center pt-1.5">
            <div class="w-1 h-2 rounded-full bg-hmti-yellow animate-bounce"></div>
        </div>
    </div>

    {{-- Wave separator --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 120L60 105C120 90 240 60 360 52.5C480 45 600 60 720 67.5C840 75 960 75 1080 67.5C1200 60 1320 45 1380 37.5L1440 30V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="rgba(255,255,255,0.03)"/>
        </svg>
    </div>
</section>

{{-- ===== ABOUT + STATS SECTION ===== --}}
<section id="tentang" class="py-14 sm:py-20 lg:py-28 relative z-10" style="background: rgba(255,255,255,0.02); backdrop-filter: blur(8px); border-top: 1px solid rgba(255,255,255,0.06); border-bottom: 1px solid rgba(255,255,255,0.06);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-white/80 text-xs font-bold uppercase tracking-wider mb-3">Tentang Kami</span>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-black text-hmti-blue mb-4">Tentang HMTI Margonda</h2>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14 items-center">
            {{-- Image with decorative frame --}}
            <div class="relative" data-aos="fade-right">
                <div class="absolute -inset-4 bg-gradient-to-br from-hmti-blue/20 to-hmti-yellow/20 rounded-3xl blur-xl opacity-50"></div>
                <div class="relative">
                    <img src="{{ asset('images/hmti2.jpeg') }}" alt="HMTI Margonda" class="rounded-2xl shadow-2xl w-full h-64 sm:h-80 lg:h-96 object-cover">
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-4 -right-2 sm:-bottom-5 sm:-right-5 bg-hmti-yellow text-hmti-blue-dark rounded-2xl px-4 sm:px-5 py-2.5 sm:py-3 shadow-xl animate-float">
                        <p class="text-xl sm:text-2xl font-black">{{ date('Y') }}</p>
                        <p class="text-[10px] sm:text-xs font-bold">Periode Aktif</p>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div data-aos="fade-left">
                <div class="space-y-5 mb-8">
                    <p class="text-hmti-gray leading-relaxed text-base">
                        <strong class="text-hmti-dark">Himpunan Mahasiswa Teknologi Informasi (HMTI)</strong> Margonda merupakan
                        organisasi mahasiswa yang bernaung di bawah Program Studi Teknologi Informasi, Universitas Bina Sarana Informatika
                        Kampus Margonda, Depok.
                    </p>
                    <p class="text-hmti-gray leading-relaxed text-base">
                        HMTI Margonda hadir sebagai wadah bagi mahasiswa untuk mengembangkan potensi, kreativitas, dan soft skills
                        di bidang teknologi informasi. Melalui berbagai divisi yang ada, kami berkomitmen untuk mencetak sumber daya manusia
                        yang unggul dan siap bersaing di era digital.
                    </p>
                </div>
                {{-- Feature list --}}
                <div class="space-y-3">
                    @foreach([
                        ['icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'text' => 'Pengembangan potensi dan kreativitas mahasiswa TI', 'color' => 'blue'],
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'text' => '14 pengurus aktif dari 4 divisi utama', 'color' => 'yellow'],
                        ['icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9', 'text' => 'Siap bersaing di era digital dan industri 4.0', 'color' => 'green'],
                    ] as $i => $feat)
                    <div class="flex items-start gap-4 p-3 rounded-xl hover:bg-white/10 transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ ($i+1) * 100 }}">
                        <div class="w-10 h-10 rounded-lg bg-{{ $feat['color'] === 'blue' ? 'blue-400' : ($feat['color'] === 'yellow' ? 'hmti-yellow' : 'green-400') }}/20 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-{{ $feat['color'] === 'blue' ? 'blue-400' : ($feat['color'] === 'yellow' ? 'hmti-yellow' : 'green-400') }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $feat['icon'] }}"/></svg>
                        </div>
                        <p class="text-sm text-hmti-dark font-medium pt-2">{{ $feat['text'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== SEJARAH HMTI UBSI ===== --}}
<section class="py-14 sm:py-20 lg:py-28 relative overflow-hidden z-10" style="background: rgba(0,0,0,0.15); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.04);">
    {{-- Decorative blobs --}}
    <div class="absolute top-0 right-0 w-60 sm:w-80 h-60 sm:h-80 bg-hmti-yellow/5 rounded-full translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 sm:w-64 h-48 sm:h-64 bg-hmti-blue/5 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-hmti-yellow/20 text-hmti-yellow text-xs font-bold uppercase tracking-wider mb-3">Sejarah &amp; Identitas</span>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-black text-hmti-blue mb-4">Sejarah HMTI UBSI</h2>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full"></div>
        </div>

        {{-- Identity cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-8 mb-12 sm:mb-16">
            <div class="bg-gradient-to-br from-hmti-blue to-hmti-blue-dark rounded-2xl p-5 sm:p-7 text-white shadow-xl card-glow" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 sm:w-14 h-12 sm:h-14 bg-hmti-yellow/20 rounded-2xl flex items-center justify-center mb-4 sm:mb-5">
                    <svg class="w-7 h-7 text-hmti-yellow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-3">Universitas Bina Sarana Informatika</h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    UBSI (dulu AMIK BSI / STMIK BSI) telah berdiri sejak tahun <strong class="text-hmti-yellow">1988</strong>,
                    dan berkembang menjadi universitas yang tersebar di lebih dari <strong class="text-hmti-yellow">20 kota</strong>
                    di seluruh Indonesia, termasuk kampus Margonda di Depok.
                </p>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-5 sm:p-7 text-white shadow-xl card-glow" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 sm:w-14 h-12 sm:h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-4 sm:mb-5">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-3">Himpunan Mahasiswa TI (HMTI)</h3>
                <p class="text-yellow-100 text-sm leading-relaxed">
                    HMTI adalah organisasi kemahasiswaan resmi tingkat program studi yang bertugas menampung aspirasi
                    dan mengembangkan potensi mahasiswa Teknologi Informasi di lingkungan UBSI.
                </p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-5 sm:p-7 text-white shadow-xl card-glow sm:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 sm:w-14 h-12 sm:h-14 bg-white/20 rounded-2xl flex items-center justify-center mb-4 sm:mb-5">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-3">Kampus Margonda</h3>
                <p class="text-green-100 text-sm leading-relaxed">
                    Berlokasi di <strong class="text-white">Jl. Margonda Raya No.353, Depok, Jawa Barat</strong>,
                    kampus ini merupakan salah satu kampus UBSI yang aktif dengan kegiatan akademik dan organisasi.
                </p>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="bg-white/5 border border-white/10 rounded-2xl sm:rounded-3xl p-5 sm:p-8 lg:p-10" data-aos="fade-up">
            <h3 class="text-lg sm:text-xl font-black text-hmti-blue mb-6 sm:mb-8 text-center">Perjalanan HMTI Margonda</h3>
            <div class="space-y-6 relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-hmti-yellow/40 hidden sm:block"></div>
                @php
                $timeline = [
                    ['year' => '1988', 'title' => 'Berdirinya BSI', 'desc' => 'AMIK BSI (Bina Sarana Informatika) berdiri di Jakarta sebagai lembaga pendidikan komputer.'],
                    ['year' => '2006', 'title' => 'Transformasi Menjadi STMIK BSI', 'desc' => 'BSI berkembang menjadi Sekolah Tinggi Manajemen Informatika dan Komputer (STMIK BSI).'],
                    ['year' => '2010-an', 'title' => 'Ekspansi Kampus', 'desc' => 'UBSI memperluas jaringan kampus ke berbagai kota, termasuk pembukaan Kampus Margonda di Depok.'],
                    ['year' => '2021', 'title' => 'Universitas Bina Sarana Informatika', 'desc' => 'BSI resmi bertransformasi menjadi Universitas Bina Sarana Informatika (UBSI).'],
                    ['year' => '2026', 'title' => 'HMTI Margonda Aktif', 'desc' => 'HMTI Kampus Margonda aktif dengan 14 pengurus dari 4 divisi menjalankan berbagai program kerja.'],
                ];
                @endphp
                @foreach($timeline as $i => $item)
                <div class="sm:pl-12 relative" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                    <div class="absolute left-[3px] top-1.5 w-7 h-7 rounded-full bg-hmti-yellow border-4 border-white shadow-md hidden sm:flex items-center justify-center">
                        <div class="w-2 h-2 rounded-full bg-hmti-blue"></div>
                    </div>
                    <div class="bg-white/5 rounded-xl p-5 border border-white/10 hover:border-hmti-yellow/40 transition-all duration-300">
                        <div class="flex items-start gap-3">
                            <span class="inline-block px-3 py-1.5 text-xs font-bold rounded-full bg-hmti-blue text-white shrink-0 shadow-sm">{{ $item['year'] }}</span>
                            <div>
                                <h4 class="font-bold text-hmti-dark text-sm mb-1">{{ $item['title'] }}</h4>
                                <p class="text-hmti-gray text-sm leading-relaxed">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===== DIVISI KAMI ===== --}}
<section class="py-14 sm:py-20 lg:py-28 relative overflow-hidden z-10" style="background: rgba(255,255,255,0.02); backdrop-filter: blur(8px); border-bottom: 1px solid rgba(255,255,255,0.06);">
    <div class="absolute top-1/3 right-0 w-72 h-72 bg-hmti-blue/5 rounded-full translate-x-1/2 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-hmti-yellow/20 text-hmti-yellow text-xs font-bold uppercase tracking-wider mb-3">Organisasi</span>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-black text-hmti-blue mb-4">Divisi Kami</h2>
            <p class="text-hmti-gray max-w-2xl mx-auto text-sm sm:text-base">Empat divisi yang bekerja sinergis untuk memajukan HMTI Margonda</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6" data-gsap="stagger-children">
            @php
            $divisi = [
                ['name' => 'KWSB', 'desc' => 'Ketua, Wakil, Sekretaris & Bendahara — Pimpinan inti organisasi.', 'from' => 'from-hmti-blue', 'to' => 'to-hmti-blue-dark', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z', 'iconColor' => 'text-hmti-yellow'],
                ['name' => 'Kominfo', 'desc' => 'Komunikasi & Informasi — Pengelolaan media dan publikasi.', 'from' => 'from-yellow-500', 'to' => 'to-yellow-600', 'icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z', 'iconColor' => 'text-white'],
                ['name' => 'Litbang', 'desc' => 'Penelitian & Pengembangan — Riset dan inovasi teknologi.', 'from' => 'from-green-500', 'to' => 'to-green-600', 'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'iconColor' => 'text-white'],
                ['name' => 'PSDM', 'desc' => 'Pengembangan Sumber Daya Manusia — Pelatihan dan pengembangan.', 'from' => 'from-purple-500', 'to' => 'to-purple-600', 'icon' => 'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5', 'iconColor' => 'text-white'],
            ];
            @endphp
            @foreach($divisi as $i => $div)
            <div class="group bg-gradient-to-br {{ $div['from'] }} {{ $div['to'] }} rounded-2xl p-4 sm:p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 card-glow" data-aos="zoom-in" data-aos-delay="{{ ($i+1) * 100 }}">
                <div class="w-10 sm:w-14 h-10 sm:h-14 rounded-xl sm:rounded-2xl bg-white/15 backdrop-blur-sm flex items-center justify-center mb-3 sm:mb-5 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                    <svg class="w-5 sm:w-7 h-5 sm:h-7 {{ $div['iconColor'] }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $div['icon'] }}"/></svg>
                </div>
                <h3 class="font-bold text-sm sm:text-lg mb-1 sm:mb-2">{{ $div['name'] }}</h3>
                <p class="text-white/80 text-xs sm:text-sm leading-relaxed hidden sm:block">{{ $div['desc'] }}</p>
                <div class="mt-3 sm:mt-4 pt-2 sm:pt-3 border-t border-white/15">
                    <a href="{{ route('guest.structure') }}" class="text-[10px] sm:text-xs font-semibold text-white/70 hover:text-white flex items-center gap-1 transition-colors group-hover:gap-2">
                        Lihat anggota <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-8 sm:mt-10" data-aos="fade-up">
            <a href="{{ route('guest.structure') }}" class="btn-primary btn-shiny px-6 sm:px-8 py-3 shadow-lg shadow-hmti-blue/20 hover:shadow-hmti-blue/40 hover:scale-105 transition-all">
                Lihat Selengkapnya
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ===== PROGRAM KERJA ===== --}}
<section id="program-kerja" class="py-14 sm:py-20 lg:py-28 relative overflow-hidden z-10" style="background: rgba(0,0,0,0.12); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.04);">
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-hmti-blue/3 rounded-full -translate-x-1/2 translate-y-1/2 blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-white/80 text-xs font-bold uppercase tracking-wider mb-3">Program Unggulan</span>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-black text-hmti-blue mb-4">Program Kerja HMTI Margonda</h2>
            <p class="text-hmti-gray max-w-2xl mx-auto text-sm sm:text-base">Rangkaian program kerja untuk menumbuhkan kepedulian sosial, sportivitas, kemampuan teknologi, dan wawasan profesional mahasiswa TI.</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        <div class="space-y-5 sm:space-y-8" data-gsap="stagger-children">
            @php
            $prokers = [
                [
                    'num' => '01', 'title' => 'Bakti Sosial ke Panti Asuhan', 'cat' => 'Sosial Kemasyarakatan',
                    'bgColor' => '#e74c3c', 'shadowColor' => 'rgba(231,76,60,0.3)',
                    'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                    'checkColor' => '#f87171', 'glowBg' => 'rgba(231,76,60,0.05)',
                    'desc' => 'Kegiatan sosial yang mengajak seluruh pengurus dan mahasiswa TI untuk berkunjung dan berbagi kebahagiaan bersama anak-anak di panti asuhan sekitar Depok.',
                    'points' => [
                        'Pengumpulan donasi berupa sembako, pakaian layak pakai, dan perlengkapan belajar.',
                        'Kunjungan langsung ke panti asuhan dengan kegiatan bermain dan belajar bersama.',
                        'Penyerahan bantuan resmi disertai dokumentasi dan laporan kegiatan.',
                        'Melibatkan seluruh divisi HMTI sebagai bentuk kerja sama lintas divisi.'
                    ]
                ],
                [
                    'num' => '02', 'title' => 'Turnamen Futsal HMTI Cup — Kolaborasi Antar Cabang', 'cat' => 'Olahraga & Kolaborasi',
                    'bgColor' => '#22c55e', 'shadowColor' => 'rgba(34,197,94,0.3)',
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                    'checkColor' => '#4ade80', 'glowBg' => 'rgba(34,197,94,0.05)',
                    'desc' => 'Turnamen futsal antar cabang HMTI UBSI se-Jabodetabek yang dirancang untuk mempererat tali silaturahmi dan sportivitas.',
                    'points' => [
                        'Melibatkan minimal 4-6 cabang HMTI UBSI (Margonda, Bogor, Bekasi, Kalimalang, dll.).',
                        'Panitia dari HMTI Margonda berperan sebagai tuan rumah dan penyelenggara.',
                        'Tersedia trofi kejuaraan, medali, dan hadiah menarik bagi pemenang.',
                        'Dilengkapi pentas seni kecil dan sesi networking antar pengurus cabang.'
                    ]
                ],
                [
                    'num' => '03', 'title' => 'Pengembangan Website Resmi HMTI Margonda', 'cat' => 'Teknologi & Inovasi',
                    'bgColor' => '#3b82f6', 'shadowColor' => 'rgba(59,130,246,0.3)',
                    'icon' => 'M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9',
                    'checkColor' => '#60a5fa', 'glowBg' => 'rgba(59,130,246,0.05)',
                    'desc' => 'Platform digital komprehensif — dari website profil, manajemen anggota, hingga portal informasi kegiatan.',
                    'points' => [
                        'Tim dev terdiri dari pengurus Litbang dan Kominfo, dibimbing dosen pembimbing.',
                        'Website mencakup profil HMTI, struktur organisasi, agenda kegiatan, dan portal berita.',
                        'Proses pengembangan menggunakan metodologi Agile dengan sprint mingguan.',
                        'Dipublikasikan resmi dan dikelola berkelanjutan oleh Kominfo.'
                    ]
                ],
                [
                    'num' => '04', 'title' => 'Seminar Nasional Teknologi & Webinar Online', 'cat' => 'Pendidikan & Wawasan',
                    'bgColor' => '#a855f7', 'shadowColor' => 'rgba(168,85,247,0.3)',
                    'icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                    'checkColor' => '#c084fc', 'glowBg' => 'rgba(168,85,247,0.05)',
                    'desc' => 'Seminar luring dan webinar online untuk menjangkau lebih banyak peserta dari seluruh kampus.',
                    'points' => [
                        'Narasumber dari industri IT: praktisi, startup founder, software engineer.',
                        'Topik relevan: AI & ML, Cybersecurity, UI/UX Design, Pengembangan Karier IT.',
                        'Format hybrid memungkinkan partisipasi via Zoom/YouTube Live.',
                        'Peserta mendapatkan e-sertifikat resmi HMTI untuk portofolio.'
                    ]
                ],
            ];
            @endphp

            @foreach($prokers as $i => $proker)
            <div class="group relative" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="absolute inset-0 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background: linear-gradient(to right, {{ $proker['glowBg'] }}, transparent)"></div>
                <div class="relative bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl sm:rounded-3xl p-4 sm:p-6 lg:p-8 hover:shadow-xl hover:border-white/20 transition-all duration-500 card-glow shadow-sm">
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
                        <div class="flex-shrink-0">
                            <div class="w-12 sm:w-16 h-12 sm:h-16 rounded-xl sm:rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300"
                                 style="background-color: {{ $proker['bgColor'] }}; box-shadow: 0 8px 24px {{ $proker['shadowColor'] }}">
                                <svg class="w-6 sm:w-8 h-6 sm:h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $proker['icon'] }}"/></svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                <span class="text-xs font-bold px-3 py-1 rounded-full text-white shadow-sm" style="background-color: {{ $proker['bgColor'] }}">PROKER {{ $proker['num'] }}</span>
                                <span class="text-xs text-white/90 bg-white/15 rounded-full px-3 py-1 font-medium">{{ $proker['cat'] }}</span>
                            </div>
                            <h3 class="text-xl font-extrabold text-hmti-dark mb-3">{{ $proker['title'] }}</h3>
                            <p class="text-hmti-gray text-sm leading-relaxed mb-4">{{ $proker['desc'] }}</p>
                            <ul class="space-y-2">
                                @foreach($proker['points'] as $point)
                                <li class="flex items-start gap-2 text-sm text-hmti-gray">
                                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20" style="color: {{ $proker['checkColor'] }}"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    {{ $point }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FAQ SECTION ===== --}}
<section class="py-14 sm:py-20 lg:py-28 relative overflow-hidden z-10" style="background: rgba(255,255,255,0.02); backdrop-filter: blur(8px); border-bottom: 1px solid rgba(255,255,255,0.06);">
    <div class="absolute top-1/4 left-0 w-64 h-64 bg-hmti-yellow/5 rounded-full -translate-x-1/3 blur-3xl"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 sm:mb-14" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-white/80 text-xs font-bold uppercase tracking-wider mb-3">FAQ</span>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-black text-hmti-blue mb-4">Pertanyaan yang Sering Diajukan</h2>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full"></div>
        </div>

        <div class="space-y-3 sm:space-y-4" data-gsap="stagger-children">
            @php
            $faqs = [
                ['q' => 'Apa itu HMTI Margonda?', 'a' => 'HMTI Margonda adalah Himpunan Mahasiswa Teknologi Informasi di Universitas Bina Sarana Informatika Kampus Margonda, Depok. Organisasi ini berperan sebagai wadah bagi mahasiswa TI untuk mengembangkan potensi akademik, kreativitas, dan soft skills.'],
                ['q' => 'Bagaimana cara bergabung dengan HMTI?', 'a' => 'Untuk bergabung menjadi pengurus HMTI Margonda, kamu bisa mengikuti proses perekrutan yang dibuka setiap awal periode kepengurusan baru. Informasi akan diumumkan melalui media sosial dan website resmi HMTI.'],
                ['q' => 'Siapa saja yang bisa mengajukan kolaborasi?', 'a' => 'Semua pihak — mahasiswa, organisasi kemahasiswaan lain, komunitas, perusahaan, dan institusi — dapat mengajukan kolaborasi dengan HMTI Margonda melalui form kolaborasi di website ini.'],
                ['q' => 'Apa saja divisi yang ada di HMTI Margonda?', 'a' => 'HMTI Margonda terdiri dari 4 divisi utama: KWSB (Pimpinan Inti), Kominfo (Komunikasi & Informasi), Litbang (Penelitian & Pengembangan), dan PSDM (Pengembangan Sumber Daya Manusia).'],
                ['q' => 'Apakah kegiatan HMTI hanya untuk mahasiswa TI?', 'a' => 'Kegiatan tertentu seperti seminar dan webinar terbuka untuk umum, termasuk mahasiswa dari program studi lain. Namun, keanggotaan pengurus HMTI dikhususkan untuk mahasiswa Program Studi Teknologi Informasi.'],
            ];
            @endphp

            @foreach($faqs as $i => $faq)
            <div x-data="{ open: false }" class="bg-white/5 border border-white/10 rounded-xl sm:rounded-2xl overflow-hidden hover:border-white/20 transition-all duration-300">
                <button @click="open = !open" class="flex items-center justify-between w-full text-left px-4 sm:px-6 py-4 sm:py-5 group">
                    <span class="flex items-center gap-2 sm:gap-3">
                        <span class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-hmti-yellow/30 transition-colors">
                            <span class="text-[10px] sm:text-xs font-bold text-white/70 group-hover:text-white transition-colors">{{ $i + 1 }}</span>
                        </span>
                        <span class="text-sm font-semibold text-white/90">{{ $faq['q'] }}</span>
                    </span>
                    <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-y-2">
                    <div class="px-6 pb-5 pt-0">
                        <div class="pl-11 text-sm text-gray-300 leading-relaxed border-t border-white/10 pt-4">{{ $faq['a'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== COLLABORATION FORM ===== --}}
<section id="kolaborasi" class="py-14 sm:py-20 lg:py-28 relative overflow-hidden z-10" style="background: rgba(0,0,0,0.12); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(255,255,255,0.04);">
    <div class="absolute top-0 right-0 w-60 sm:w-80 h-60 sm:h-80 bg-hmti-yellow/5 rounded-full translate-x-1/3 -translate-y-1/3 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-48 sm:w-64 h-48 sm:h-64 bg-hmti-blue/5 rounded-full -translate-x-1/3 translate-y-1/3 blur-3xl"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8 sm:mb-12" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 rounded-full bg-hmti-yellow/20 text-hmti-yellow text-xs font-bold uppercase tracking-wider mb-3">Kolaborasi</span>
            <h2 class="text-2xl sm:text-3xl lg:text-5xl font-black text-hmti-blue mb-4">Ajukan Kolaborasi Bersama</h2>
            <p class="text-hmti-gray max-w-xl mx-auto text-sm sm:text-base">Punya ide kolaborasi, sponsorship, atau kerja sama kegiatan bersama HMTI Margonda? Isi form di bawah ini!</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        {{-- Track Status Widget --}}
        <div class="mb-8" data-aos="fade-up" x-data="{
            trackOpen: false,
            trackEmail: '',
            trackResult: null,
            trackLoading: false,
            trackError: '',
            async checkStatus() {
                if (!this.trackEmail) return;
                this.trackLoading = true;
                this.trackError = '';
                this.trackResult = null;
                try {
                    const res = await fetch('/api/collab-status?email=' + encodeURIComponent(this.trackEmail));
                    const data = await res.json();
                    if (data.found) {
                        this.trackResult = data;
                    } else {
                        this.trackError = 'Tidak ditemukan pengajuan dengan email tersebut.';
                    }
                } catch(e) {
                    this.trackError = 'Gagal memuat data. Coba lagi nanti.';
                }
                this.trackLoading = false;
            }
        }">
            <button @click="trackOpen = !trackOpen"
                    class="mx-auto flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 text-white/80 text-sm font-medium hover:bg-white/20 hover:text-white transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span x-text="trackOpen ? 'Tutup Tracking' : 'Cek Status Pengajuan'"></span>
            </button>

            <div x-show="trackOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                 class="mt-4 rounded-2xl shadow-xl p-5 max-w-lg mx-auto" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
                <p class="text-sm font-semibold text-white mb-3">Masukkan email yang kamu gunakan saat mengajukan kolaborasi:</p>
                <div class="flex gap-2">
                    <input type="email" x-model="trackEmail" @keydown.enter="checkStatus()" placeholder="email@contoh.com" class="input flex-1 text-sm">
                    <button @click="checkStatus()" :disabled="trackLoading" class="btn-primary text-xs px-4 shrink-0">
                        <span x-show="!trackLoading">Cek</span>
                        <span x-show="trackLoading" class="flex items-center gap-1">
                            <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                            Loading...
                        </span>
                    </button>
                </div>

                {{-- Error --}}
                <p x-show="trackError" x-text="trackError" class="mt-3 text-xs text-red-600 bg-red-50 rounded-lg px-3 py-2"></p>

                {{-- Result --}}
                <div x-show="trackResult" class="mt-4 space-y-3">
                    <div class="flex items-center gap-3 p-3 rounded-xl" :class="{
                        'bg-orange-50 border border-orange-200': trackResult?.status === 'pending',
                        'bg-blue-50 border border-blue-200': trackResult?.status === 'reviewing',
                        'bg-green-50 border border-green-200': trackResult?.status === 'approved',
                        'bg-red-50 border border-red-200': trackResult?.status === 'rejected',
                    }">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" :class="{
                            'bg-orange-100': trackResult?.status === 'pending',
                            'bg-blue-100': trackResult?.status === 'reviewing',
                            'bg-green-100': trackResult?.status === 'approved',
                            'bg-red-100': trackResult?.status === 'rejected',
                        }">
                            <template x-if="trackResult?.status === 'pending'">
                                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </template>
                            <template x-if="trackResult?.status === 'reviewing'">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </template>
                            <template x-if="trackResult?.status === 'approved'">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </template>
                            <template x-if="trackResult?.status === 'rejected'">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </template>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-hmti-dark" x-text="trackResult?.type"></p>
                            <p class="text-xs font-medium" :class="{
                                'text-orange-700': trackResult?.status === 'pending',
                                'text-blue-700': trackResult?.status === 'reviewing',
                                'text-green-700': trackResult?.status === 'approved',
                                'text-red-700': trackResult?.status === 'rejected',
                            }" x-text="trackResult?.status_label"></p>
                        </div>
                    </div>
                    <template x-if="trackResult?.admin_notes">
                        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
                            <p class="text-[11px] text-hmti-gray font-semibold uppercase mb-1">Catatan dari HMTI:</p>
                            <p class="text-sm text-hmti-dark" x-text="trackResult?.admin_notes"></p>
                        </div>
                    </template>
                    <p class="text-[11px] text-hmti-gray">Diajukan pada: <span x-text="trackResult?.submitted_at" class="font-medium"></span></p>
                </div>
            </div>
        </div>

        @if(session('collab_success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" x-transition.opacity
             class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-5 flex items-start gap-3" data-aos="zoom-in">
            <svg class="w-6 h-6 text-green-600 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <div>
                <p class="font-bold text-green-800 text-sm">Pengajuan kolaborasi berhasil terkirim!</p>
                <p class="text-green-700 text-xs mt-1">Tim HMTI Margonda akan segera menghubungi kamu melalui email. Terima kasih!</p>
            </div>
        </div>
        @endif

        <div class="rounded-2xl sm:rounded-3xl shadow-2xl p-4 sm:p-6 lg:p-10" style="background: rgba(255,255,255,0.04); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.06);" data-aos="fade-up" data-aos-delay="100">
            <form method="POST" action="{{ route('guest.collab') }}" class="space-y-4 sm:space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="label" for="collab_name">Nama Lengkap / Organisasi <span class="text-hmti-red">*</span></label>
                        <input type="text" name="name" id="collab_name" value="{{ old('name') }}"
                               class="input input-glow @error('name') border-red-400 @enderror"
                               placeholder="Nama kamu atau organisasi" required>
                        @error('name')<p class="mt-1 text-xs text-hmti-red">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label" for="collab_email">Email Aktif <span class="text-hmti-red">*</span></label>
                        <input type="email" name="email" id="collab_email" value="{{ old('email') }}"
                               class="input input-glow @error('email') border-red-400 @enderror"
                               placeholder="email@contoh.com" required>
                        @error('email')<p class="mt-1 text-xs text-hmti-red">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="label" for="collab_phone">Nomor WhatsApp / HP</label>
                        <input type="text" name="phone" id="collab_phone" value="{{ old('phone') }}" class="input input-glow" placeholder="08xxxxxxxxx">
                    </div>
                    <div>
                        <label class="label" for="collab_type">Jenis Kolaborasi <span class="text-hmti-red">*</span></label>
                        <select name="type" id="collab_type" class="input input-glow @error('type') border-red-400 @enderror" required>
                            <option value="" disabled selected>Pilih jenis kolaborasi</option>
                            <option value="Kegiatan / Event Bersama" {{ old('type') == 'Kegiatan / Event Bersama' ? 'selected' : '' }}>Kegiatan / Event Bersama</option>
                            <option value="Sponsorship" {{ old('type') == 'Sponsorship' ? 'selected' : '' }}>Sponsorship</option>
                            <option value="Kolaborasi Antar Organisasi" {{ old('type') == 'Kolaborasi Antar Organisasi' ? 'selected' : '' }}>Kolaborasi Antar Organisasi</option>
                            <option value="Kerja Sama Akademik" {{ old('type') == 'Kerja Sama Akademik' ? 'selected' : '' }}>Kerja Sama Akademik</option>
                            <option value="Lainnya" {{ old('type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('type')<p class="mt-1 text-xs text-hmti-red">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="label" for="collab_message">Deskripsi Kolaborasi <span class="text-hmti-red">*</span></label>
                    <textarea name="message" id="collab_message" rows="5"
                              class="input input-glow resize-none @error('message') border-red-400 @enderror"
                              placeholder="Ceritakan ide kolaborasi kamu secara singkat..." required>{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-xs text-hmti-red">{{ $message }}</p>@enderror
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                    <p class="text-xs text-hmti-gray">
                        <svg class="w-3.5 h-3.5 inline mr-1 text-hmti-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Notifikasi dikirim ke <strong>hmti.ubsi.margonda@gmail.com</strong>
                    </p>
                    <button type="submit" class="btn-primary btn-shiny px-6 sm:px-8 py-3 shadow-lg shadow-hmti-blue/20 hover:shadow-hmti-blue/40 hover:scale-105 transition-all w-full sm:w-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-gray-400" data-aos="fade-up">
            <a href="mailto:hmti.ubsi.margonda@gmail.com" class="flex items-center gap-2 hover:text-hmti-blue transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                hmti.ubsi.margonda@gmail.com
            </a>
            <span class="hidden sm:block text-gray-300">|</span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Jl. Margonda Raya No.353, Depok
            </span>
        </div>
    </div>
</section>

{{-- ===== CTA SECTION ===== --}}
<section class="py-14 sm:py-20 relative overflow-hidden z-10" style="background: linear-gradient(135deg, rgba(10,22,40,0.8) 0%, rgba(15,32,66,0.6) 50%, rgba(10,22,40,0.8) 100%); backdrop-filter: blur(20px);">
    {{-- Animated bg elements --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-28 sm:w-40 h-28 sm:h-40 rounded-full bg-hmti-yellow animate-float"></div>
        <div class="absolute bottom-10 right-10 w-40 sm:w-60 h-40 sm:h-60 rounded-full bg-hmti-yellow animate-float-slow"></div>
        <div class="absolute top-1/2 left-1/2 w-24 sm:w-32 h-24 sm:h-32 rounded-full bg-white animate-blob"></div>
    </div>
    {{-- Grid pattern --}}
    <div class="absolute inset-0 bg-grid-pattern"></div>

    <div class="relative max-w-4xl mx-auto px-4 text-center" data-aos="zoom-in">
        <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-16 sm:h-20 w-auto rounded-2xl mx-auto mb-4 sm:mb-6 shadow-2xl hover:scale-105 transition-transform animate-pulse-glow">
        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-white mb-3 sm:mb-4 text-shadow">Bergabung Bersama HMTI Margonda</h2>
        <p class="text-gray-300 mb-8 sm:mb-10 max-w-2xl mx-auto text-sm sm:text-base px-2">
            Mari bersama-sama mengembangkan potensi dan berkontribusi dalam kemajuan teknologi informasi
            di lingkungan Universitas Bina Sarana Informatika Kampus Margonda.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
            <a href="#kolaborasi" class="btn-shiny btn-magnetic inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-3.5 bg-hmti-yellow text-hmti-blue-dark font-bold rounded-xl hover:bg-yellow-400 transition-all shadow-lg shadow-hmti-yellow/25 hover:scale-105 w-full sm:w-auto justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Ajukan Kolaborasi
            </a>
            <a href="{{ route('guest.structure') }}" class="btn-magnetic inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-3.5 glass-premium rounded-xl text-white font-semibold hover:bg-white/20 transition-all w-full sm:w-auto justify-center">
                Lihat Struktur
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>
@endsection
