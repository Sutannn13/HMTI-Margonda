@extends('layouts.guest')
@section('title', 'Beranda')

@section('content')
{{-- Hero Section with background image --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/hmti1.jpeg') }}" alt="HMTI Margonda" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-br from-hmti-blue-dark/90 via-hmti-blue/80 to-hmti-blue-dark/90"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-36">
        <div class="text-center">
            <div class="flex items-center justify-center gap-6 mb-8">
                <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-16 lg:h-20 w-auto object-contain opacity-90">
                <div class="w-px h-16 bg-white/30"></div>
                <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-16 lg:h-20 w-auto rounded-xl object-contain opacity-90">
            </div>
            <h1 class="text-4xl lg:text-6xl font-extrabold text-white mb-4 tracking-tight">
                HMTI <span class="text-hmti-yellow">Margonda</span>
            </h1>
            <p class="text-xl lg:text-2xl text-hmti-yellow font-semibold mb-3">
                Himpunan Mahasiswa Teknologi Informasi
            </p>
            <p class="text-gray-300 text-base lg:text-lg max-w-2xl mx-auto mb-8">
                Universitas Bina Sarana Informatika — Kampus Margonda, Depok
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('guest.structure') }}" class="btn-secondary px-8 py-3 text-base">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Lihat Struktur Organisasi
                </a>
            </div>
        </div>
    </div>
    {{-- Wave separator --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 120L60 105C120 90 240 60 360 52.5C480 45 600 60 720 67.5C840 75 960 75 1080 67.5C1200 60 1320 45 1380 37.5L1440 30V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="#f0f4f8"/>
        </svg>
    </div>
</section>

{{-- About + History Section --}}
<section class="py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-hmti-blue mb-4">Tentang HMTI Margonda</h2>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <img src="{{ asset('images/hmti2.jpeg') }}" alt="HMTI Margonda" class="rounded-2xl shadow-xl w-full h-80 object-cover">
            </div>
            <div class="space-y-5">
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
                <div class="grid grid-cols-2 gap-4 pt-2">
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <p class="text-2xl font-extrabold text-hmti-blue">4</p>
                        <p class="text-xs text-hmti-gray mt-1">Divisi Aktif</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                        <p class="text-2xl font-extrabold text-hmti-blue">14</p>
                        <p class="text-xs text-hmti-gray mt-1">Anggota Pengurus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Sejarah HMTI UBSI --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 rounded-full bg-hmti-yellow/20 text-hmti-blue text-xs font-bold uppercase tracking-wider mb-3">Sejarah & Identitas</span>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-hmti-blue mb-4">Sejarah HMTI UBSI</h2>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            {{-- Card Identitas --}}
            <div class="bg-gradient-to-br from-hmti-blue to-hmti-blue-dark rounded-2xl p-6 text-white shadow-lg">
                <div class="w-12 h-12 bg-hmti-yellow/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-hmti-yellow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Universitas Bina Sarana Informatika</h3>
                <p class="text-gray-300 text-sm leading-relaxed">
                    UBSI (dulu AMIK BSI / STMIK BSI) telah berdiri sejak tahun <strong class="text-hmti-yellow">1988</strong>,
                    dan berkembang menjadi universitas yang tersebar di lebih dari <strong class="text-hmti-yellow">20 kota</strong>
                    di seluruh Indonesia, termasuk kampus Margonda di Depok.
                </p>
            </div>
            {{-- Card HMTI --}}
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Himpunan Mahasiswa TI (HMTI)</h3>
                <p class="text-yellow-100 text-sm leading-relaxed">
                    HMTI adalah organisasi kemahasiswaan resmi tingkat program studi yang bertugas menampung aspirasi
                    dan mengembangkan potensi mahasiswa Teknologi Informasi di lingkungan UBSI. HMTI aktif di seluruh
                    kampus UBSI, termasuk kampus Margonda.
                </p>
            </div>
            {{-- Card Margonda --}}
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Kampus Margonda</h3>
                <p class="text-green-100 text-sm leading-relaxed">
                    Berlokasi di <strong class="text-white">Jl. Margonda Raya No.353, Depok, Jawa Barat</strong>,
                    kampus ini merupakan salah satu kampus UBSI yang aktif dengan kegiatan akademik dan organisasi
                    kemahasiswaan yang berkembang pesat.
                </p>
            </div>
        </div>

        {{-- Timeline Sejarah --}}
        <div class="bg-gray-50 rounded-2xl p-8">
            <h3 class="text-xl font-bold text-hmti-blue mb-6 text-center">Perjalanan HMTI Margonda</h3>
            <div class="space-y-6 relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-hmti-yellow/40 hidden sm:block"></div>
                @php
                $timeline = [
                    ['year' => '1988', 'title' => 'Berdirinya BSI', 'desc' => 'AMIK BSI (Bina Sarana Informatika) berdiri di Jakarta sebagai lembaga pendidikan komputer, cikal bakal Universitas BSI yang kini dikenal.'],
                    ['year' => '2006', 'title' => 'Transformasi Menjadi STMIK BSI', 'desc' => 'BSI berkembang menjadi Sekolah Tinggi Manajemen Informatika dan Komputer (STMIK BSI) dengan program studi Teknik Informatika dan Sistem Informasi.'],
                    ['year' => '2010-an', 'title' => 'Ekspansi Kampus', 'desc' => 'UBSI memperluas jaringan kampus ke berbagai kota, termasuk pembukaan Kampus Margonda di Depok yang melayani mahasiswa wilayah Jabodetabek.'],
                    ['year' => '2021', 'title' => 'Universitas Bina Sarana Informatika', 'desc' => 'BSI resmi bertransformasi dari Perguran Tinggi (PT) menjadi Universitas Bina Sarana Informatika, memperkuat posisinya sebagai universitas teknologi informasi terkemuka di Indonesia.'],
                    ['year' => '2026', 'title' => 'HMTI Margonda Aktif', 'desc' => 'HMTI Kampus Margonda terus bergerak aktif dengan 14 pengurus dari 4 divisi — KWSB, Kominfo, Litbang, dan PSDM — menjalankan berbagai program kerja untuk kemajuan mahasiswa TI.'],
                ];
                @endphp
                @foreach($timeline as $item)
                <div class="sm:pl-12 relative">
                    <div class="absolute left-2 top-1.5 w-5 h-5 rounded-full bg-hmti-yellow border-2 border-white shadow hidden sm:flex items-center justify-center">
                        <div class="w-2 h-2 rounded-full bg-hmti-blue"></div>
                    </div>
                    <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                        <div class="flex items-start gap-3">
                            <span class="inline-block px-2.5 py-1 text-xs font-bold rounded-full bg-hmti-blue text-white shrink-0">{{ $item['year'] }}</span>
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

{{-- Divisions Preview --}}
<section class="py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-hmti-blue mb-4">Divisi Kami</h2>
            <p class="text-hmti-gray max-w-2xl mx-auto">Empat divisi yang bekerja sinergis untuk memajukan HMTI Margonda</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="group bg-gradient-to-br from-hmti-blue to-hmti-blue-dark rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-hmti-yellow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">KWSB</h3>
                <p class="text-gray-300 text-sm">Ketua, Wakil, Sekretaris & Bendahara — Pimpinan inti organisasi.</p>
            </div>
            <div class="group bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Kominfo</h3>
                <p class="text-yellow-100 text-sm">Komunikasi & Informasi — Pengelolaan media dan publikasi.</p>
            </div>
            <div class="group bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">Litbang</h3>
                <p class="text-green-100 text-sm">Penelitian & Pengembangan — Riset dan inovasi teknologi.</p>
            </div>
            <div class="group bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
                </div>
                <h3 class="font-bold text-lg mb-2">PSDM</h3>
                <p class="text-purple-100 text-sm">Pengembangan Sumber Daya Manusia — Pelatihan dan pengembangan.</p>
            </div>
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('guest.structure') }}" class="btn-primary px-8 py-3">
                Lihat Selengkapnya
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>
        </div>
    </div>
</section>

{{-- Program Kerja --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 rounded-full bg-hmti-blue/10 text-hmti-blue text-xs font-bold uppercase tracking-wider mb-3">Program Unggulan</span>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-hmti-blue mb-4">Program Kerja HMTI Margonda</h2>
            <p class="text-hmti-gray max-w-2xl mx-auto text-base">Rangkaian program kerja yang dirancang untuk menumbuhkan kepedulian sosial, sportivitas, kemampuan teknologi, dan wawasan profesional mahasiswa TI.</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        <div class="space-y-8">
            {{-- Proker 1: Baksos --}}
            <div class="group bg-gradient-to-r from-red-50 to-red-100/50 border border-red-100 rounded-2xl p-6 lg:p-8 hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-2xl bg-red-500 flex items-center justify-center shadow-md">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-red-500 text-white">PROKER 01</span>
                            <span class="text-xs text-hmti-gray bg-white rounded-full px-2.5 py-1 border">Sosial Kemasyarakatan</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-hmti-dark mb-3">Bakti Sosial ke Panti Asuhan</h3>
                        <p class="text-hmti-gray text-sm leading-relaxed mb-4">
                            Kegiatan sosial yang mengajak seluruh pengurus dan mahasiswa TI untuk berkunjung dan berbagi kebahagiaan bersama anak-anak di panti asuhan sekitar Depok. Program ini bertujuan membangun jiwa sosial, kepekaan terhadap lingkungan, serta mempererat kebersamaan antar anggota HMTI.
                        </p>
                        <ul class="space-y-2">
                            @foreach(['Pengumpulan donasi berupa sembako, pakaian layak pakai, dan perlengkapan belajar dari seluruh pengurus dan mahasiswa TI.','Kunjungan langsung ke panti asuhan dengan kegiatan bermain, belajar bersama, dan hiburan sederhana untuk anak-anak.','Penyerahan bantuan secara resmi disertai dokumentasi dan laporan kegiatan untuk transparansi.','Melibatkan seluruh divisi HMTI sebagai bentuk kerja sama lintas divisi yang konkret dan berdampak nyata.'] as $point)
                            <li class="flex items-start gap-2 text-sm text-hmti-gray">
                                <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                {{ $point }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Proker 2: Futsal --}}
            <div class="group bg-gradient-to-r from-green-50 to-green-100/50 border border-green-100 rounded-2xl p-6 lg:p-8 hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-2xl bg-green-500 flex items-center justify-center shadow-md">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-green-500 text-white">PROKER 02</span>
                            <span class="text-xs text-hmti-gray bg-white rounded-full px-2.5 py-1 border">Olahraga & Kolaborasi</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-hmti-dark mb-3">Turnamen Futsal HMTI Cup — Kolaborasi Antar Cabang</h3>
                        <p class="text-hmti-gray text-sm leading-relaxed mb-4">
                            Turnamen futsal antar cabang HMTI UBSI se-Jabodetabek yang dirancang untuk mempererat tali silaturahmi, membangun semangat sportivitas, dan menciptakan sinergi positif antar mahasiswa TI dari berbagai kampus. Kegiatan ini diharapkan menjadi agenda tahunan HMTI Margonda yang ditunggu-tunggu.
                        </p>
                        <ul class="space-y-2">
                            @foreach(['Melibatkan minimal 4–6 cabang HMTI UBSI (Margonda, Bogor, Bekasi, Kalimalang, dll.) sebagai peserta dalam sistem gugur.','Panitia dari HMTI Margonda berperan sebagai tuan rumah, menyiapkan venue, jadwal pertandingan, dan wasit.','Tersedia trofi kejuaraan, medali, dan hadiah menarik bagi pemenang sebagai bentuk apresiasi dan motivasi.','Kegiatan dilengkapi pentas seni kecil dan sesi networking antar pengurus cabang untuk mempererat hubungan.'] as $point)
                            <li class="flex items-start gap-2 text-sm text-hmti-gray">
                                <svg class="w-4 h-4 text-green-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                {{ $point }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Proker 3: Website --}}
            <div class="group bg-gradient-to-r from-blue-50 to-blue-100/50 border border-blue-100 rounded-2xl p-6 lg:p-8 hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-2xl bg-hmti-blue flex items-center justify-center shadow-md">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-hmti-blue text-white">PROKER 03</span>
                            <span class="text-xs text-hmti-gray bg-white rounded-full px-2.5 py-1 border">Teknologi & Inovasi</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-hmti-dark mb-3">Pengembangan Website Resmi HMTI Margonda</h3>
                        <p class="text-hmti-gray text-sm leading-relaxed mb-4">
                            Program kerja pengembangan platform digital HMTI Margonda yang komprehensif — mulai dari website profil organisasi, manajemen anggota, hingga portal informasi kegiatan. Proyek ini menjadi ajang nyata bagi mahasiswa TI untuk menerapkan ilmu yang didapat di perkuliahan dalam konteks organisasi riil.
                        </p>
                        <ul class="space-y-2">
                            @foreach(['Pembentukan tim dev yang terdiri dari pengurus Litbang dan Kominfo, dibimbing oleh dosen pembimbing kemahasiswaan.','Website mencakup halaman profil HMTI, struktur organisasi, agenda kegiatan, galeri foto, dan portal berita.','Proses pengembangan menggunakan metodologi Agile dengan sprint mingguan dan review rutin bersama seluruh pengurus.','Website dipublikasikan resmi dengan domain yang representatif dan dikelola secara berkelanjutan oleh Kominfo.'] as $point)
                            <li class="flex items-start gap-2 text-sm text-hmti-gray">
                                <svg class="w-4 h-4 text-hmti-blue mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                {{ $point }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Proker 4: Seminar --}}
            <div class="group bg-gradient-to-r from-purple-50 to-purple-100/50 border border-purple-100 rounded-2xl p-6 lg:p-8 hover:shadow-lg transition-all duration-300">
                <div class="flex flex-col lg:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 rounded-2xl bg-purple-500 flex items-center justify-center shadow-md">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-purple-500 text-white">PROKER 04</span>
                            <span class="text-xs text-hmti-gray bg-white rounded-full px-2.5 py-1 border">Pendidikan & Wawasan</span>
                        </div>
                        <h3 class="text-xl font-extrabold text-hmti-dark mb-3">Seminar Nasional Teknologi & Webinar Online</h3>
                        <p class="text-hmti-gray text-sm leading-relaxed mb-4">
                            Mengingat keterbatasan aula kampus Margonda, HMTI memprioritaskan penyelenggaraan <strong>seminar luring</strong> di ruang kelas gabungan atau venue eksternal yang dapat menampung lebih banyak peserta. Untuk jangkauan lebih luas, kegiatan juga diduplikasi dalam format webinar online.
                        </p>
                        <ul class="space-y-2">
                            @foreach(['Menghadirkan narasumber dari industri IT (praktisi, startup founder, software engineer) maupun akademisi yang kompeten.','Topik seminar relevan dengan tren teknologi: AI & Machine Learning, Cybersecurity, UI/UX Design, dan Pengembangan Karier di Bidang IT.','Format hybrid memungkinkan mahasiswa yang tidak hadir langsung tetap bisa mengikuti melalui platform Zoom/YouTube Live.','Peserta mendapatkan e-sertifikat resmi HMTI yang dapat digunakan sebagai tambahan portofolio dan poin keaktifan.'] as $point)
                            <li class="flex items-start gap-2 text-sm text-hmti-gray">
                                <svg class="w-4 h-4 text-purple-500 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                {{ $point }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Collaboration Form --}}
<section id="kolaborasi" class="py-16 lg:py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="inline-block px-4 py-1.5 rounded-full bg-hmti-yellow/20 text-hmti-blue-dark text-xs font-bold uppercase tracking-wider mb-3">Kolaborasi</span>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-hmti-blue mb-4">Ajukan Kolaborasi Bersama</h2>
            <p class="text-hmti-gray max-w-xl mx-auto">Punya ide kolaborasi, sponsorship, atau kerja sama kegiatan bersama HMTI Margonda? Isi form di bawah ini dan kami akan segera menghubungi kamu!</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        @if(session('collab_success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)" x-transition.opacity
             class="mb-6 bg-green-50 border border-green-200 rounded-xl p-5 flex items-start gap-3">
            <svg class="w-5 h-5 text-green-600 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <div>
                <p class="font-semibold text-green-800 text-sm">Pengajuan kolaborasi berhasil terkirim!</p>
                <p class="text-green-700 text-xs mt-1">Tim HMTI Margonda akan segera menghubungi kamu melalui email yang kamu daftarkan. Terima kasih atas minat berkolaborasinya 🙌</p>
            </div>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl p-6 lg:p-10 border border-gray-100">
            <form method="POST" action="{{ route('guest.collab') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="label" for="collab_name">Nama Lengkap / Organisasi <span class="text-hmti-red">*</span></label>
                        <input type="text" name="name" id="collab_name" value="{{ old('name') }}"
                               class="input @error('name') border-red-400 @enderror"
                               placeholder="Nama kamu atau nama organisasi" required>
                        @error('name')<p class="mt-1 text-xs text-hmti-red">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label" for="collab_email">Email Aktif <span class="text-hmti-red">*</span></label>
                        <input type="email" name="email" id="collab_email" value="{{ old('email') }}"
                               class="input @error('email') border-red-400 @enderror"
                               placeholder="email@contoh.com" required>
                        @error('email')<p class="mt-1 text-xs text-hmti-red">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="label" for="collab_phone">Nomor WhatsApp / HP</label>
                        <input type="text" name="phone" id="collab_phone" value="{{ old('phone') }}"
                               class="input" placeholder="08xxxxxxxxx">
                    </div>
                    <div>
                        <label class="label" for="collab_type">Jenis Kolaborasi <span class="text-hmti-red">*</span></label>
                        <select name="type" id="collab_type" class="input @error('type') border-red-400 @enderror" required>
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
                              class="input resize-none @error('message') border-red-400 @enderror"
                              placeholder="Ceritakan ide kolaborasi kamu secara singkat — tujuan, target peserta, timeframe, dan hal lain yang perlu kami ketahui..." required>{{ old('message') }}</textarea>
                    @error('message')<p class="mt-1 text-xs text-hmti-red">{{ $message }}</p>@enderror
                </div>
                <div class="flex items-center justify-between pt-2">
                    <p class="text-xs text-hmti-gray">
                        <svg class="w-3.5 h-3.5 inline mr-1 text-hmti-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Notifikasi dikirim ke <strong>hmti.ubsi.margonda@gmail.com</strong>
                    </p>
                    <button type="submit" class="btn-primary px-8 py-2.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-hmti-gray">
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

{{-- CTA Section --}}
<section class="py-16 bg-gradient-to-r from-hmti-blue-dark to-hmti-blue relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-40 h-40 rounded-full bg-hmti-yellow"></div>
        <div class="absolute bottom-10 right-10 w-60 h-60 rounded-full bg-hmti-yellow"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 text-center">
        <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-16 w-auto rounded-xl mx-auto mb-5 opacity-90">
        <h2 class="text-3xl font-extrabold text-white mb-4">Bergabung Bersama HMTI Margonda</h2>
        <p class="text-gray-300 mb-8 max-w-2xl mx-auto">
            Mari bersama-sama mengembangkan potensi dan berkontribusi dalam kemajuan teknologi informasi
            di lingkungan Universitas Bina Sarana Informatika Kampus Margonda.
        </p>
        <a href="#kolaborasi" class="inline-flex items-center gap-2 px-8 py-3 bg-hmti-yellow text-hmti-blue-dark font-bold rounded-xl hover:bg-yellow-400 transition-colors shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Ajukan Kolaborasi
        </a>
    </div>
</section>
@endsection
