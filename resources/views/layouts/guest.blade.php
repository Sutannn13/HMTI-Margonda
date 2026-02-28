<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="HMTI Margonda — Himpunan Mahasiswa Teknologi Informasi, Universitas Bina Sarana Informatika Kampus Margonda, Depok.">
    @if(session('collab_success'))<meta name="flash-success" content="Pengajuan kolaborasi berhasil terkirim!">@endif
    <title>@yield('title', 'HMTI Margonda') - Himpunan Mahasiswa Teknologi Informasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="text-white min-h-screen flex flex-col relative" 
      x-data="{ mobileNav: false, scrolled: false, activeSection: '{{ request()->routeIs('home') ? 'beranda' : '' }}' }"
      x-on:scroll.window="scrolled = (window.scrollY > 20)"
      x-on:section-visible.document="activeSection = $event.detail.section"
      x-cloak
      style="background: linear-gradient(135deg, #060e1a 0%, #0a1628 20%, #0f2042 50%, #0d1f3c 80%, #070f1e 100%);">

    {{-- Scroll Progress Bar --}}
    <div id="scroll-progress"></div>

    {{-- Interactive Cursor Glow --}}
    <div id="cursor-glow"></div>

    {{-- Global Backlight Orbs --}}
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        {{-- Primary blue glow --}}
        <div class="absolute top-[15%] left-[10%] w-[500px] h-[500px] rounded-full animate-float" data-gsap="parallax" data-speed="0.2" style="background: radial-gradient(circle, rgba(26,58,160,0.15) 0%, transparent 70%); filter: blur(80px);"></div>
        {{-- Yellow accent glow --}}
        <div class="absolute top-[40%] right-[5%] w-[400px] h-[400px] rounded-full animate-float-slow" data-gsap="parallax" data-speed="0.35" style="background: radial-gradient(circle, rgba(245,197,24,0.08) 0%, transparent 70%); filter: blur(60px);"></div>
        {{-- Bottom blue glow --}}
        <div class="absolute bottom-[10%] left-[30%] w-[600px] h-[600px] rounded-full animate-blob" data-gsap="parallax" data-speed="0.15" style="background: radial-gradient(circle, rgba(20,80,180,0.1) 0%, transparent 70%); filter: blur(100px);"></div>
        {{-- Subtle teal glow --}}
        <div class="absolute top-[60%] left-[60%] w-[350px] h-[350px] rounded-full animate-blob-delay" data-gsap="parallax" data-speed="0.4" style="background: radial-gradient(circle, rgba(56,189,248,0.06) 0%, transparent 70%); filter: blur(70px);"></div>
    </div>

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
         :class="scrolled ? 'bg-[#0d1e3a]/88 backdrop-blur-xl shadow-lg shadow-black/20 border-b border-white/10' : 'bg-transparent'"
         style="top: 3px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-18">
                {{-- Left: Logo + Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-9 w-auto object-contain transition-transform group-hover:scale-105">
                    <div class="hidden sm:block">
                        <p class="font-extrabold text-sm leading-tight text-white">HMTI Margonda</p>
                        <p class="text-[10px] leading-tight text-gray-300">Universitas Bina Sarana Informatika</p>
                    </div>
                </a>

                {{-- Center: Nav links --}}
                <div class="hidden lg:flex items-center gap-1">
                    {{-- Beranda --}}
                    <a href="{{ route('home') }}"
                       class="nav-link relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200"
                       :class="activeSection === 'beranda' && '{{ request()->routeIs('home') ? '1' : '0' }}' === '1' ? 'text-hmti-yellow bg-white/10 font-bold' : 'text-white/80 hover:text-white hover:bg-white/10'">
                        Beranda
                        <span x-show="activeSection === 'beranda' && '{{ request()->routeIs('home') ? '1' : '0' }}' === '1'" x-transition class="absolute bottom-0 left-1/2 -translate-x-1/2 w-5 h-0.5 rounded-full bg-hmti-yellow"></span>
                    </a>

                    {{-- Struktur Organisasi --}}
                    <a href="{{ route('guest.structure') }}"
                       class="nav-link relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200
                              {{ request()->routeIs('guest.structure') ? 'text-hmti-yellow bg-white/10 font-bold' : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                        Struktur Organisasi
                        @if(request()->routeIs('guest.structure'))<span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-5 h-0.5 rounded-full bg-hmti-yellow"></span>@endif
                    </a>

                    {{-- Program Kerja (anchor link) --}}
                    <a href="{{ route('home') }}#program-kerja"
                       class="nav-link relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200"
                       :class="activeSection === 'program-kerja' ? 'text-hmti-yellow bg-white/10 font-bold' : 'text-white/80 hover:text-white hover:bg-white/10'">
                        Program Kerja
                        <span x-show="activeSection === 'program-kerja'" x-transition class="absolute bottom-0 left-1/2 -translate-x-1/2 w-5 h-0.5 rounded-full bg-hmti-yellow"></span>
                    </a>

                    {{-- Kolaborasi (anchor link) --}}
                    <a href="{{ route('home') }}#kolaborasi"
                       class="nav-link relative px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200"
                       :class="activeSection === 'kolaborasi' ? 'text-hmti-yellow bg-white/10 font-bold' : 'text-white/80 hover:text-white hover:bg-white/10'">
                        Kolaborasi
                        <span x-show="activeSection === 'kolaborasi'" x-transition class="absolute bottom-0 left-1/2 -translate-x-1/2 w-5 h-0.5 rounded-full bg-hmti-yellow"></span>
                    </a>
                </div>

                {{-- Right --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                           class="hidden sm:inline-flex items-center gap-2 px-4 py-2 text-xs font-bold rounded-lg transition-all bg-white/15 text-white hover:bg-white/25 border border-white/20 btn-magnetic">
                            Admin Panel
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 text-xs font-bold rounded-lg transition-all text-white/80 hover:text-white hover:bg-white/10">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Admin
                        </a>
                    @endauth
                    <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-9 w-auto rounded-lg object-contain shadow-sm">
                    {{-- Mobile hamburger --}}
                    <button @click="mobileNav = !mobileNav" class="lg:hidden p-2 rounded-lg transition-colors text-white hover:bg-white/10">
                        <svg x-show="!mobileNav" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileNav" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div x-show="mobileNav" x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-y-2"
             class="lg:hidden bg-[#0d1e3a]/95 backdrop-blur-xl border-t border-white/10 shadow-xl" @click.away="mobileNav = false">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('home') }}" @click="mobileNav = false"
                   class="block px-3 py-2.5 text-sm font-medium rounded-lg transition-all"
                   :class="activeSection === 'beranda' && '{{ request()->routeIs('home') ? '1' : '0' }}' === '1' ? 'bg-white/10 text-hmti-yellow font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white'">
                    Beranda
                </a>
                <a href="{{ route('guest.structure') }}" @click="mobileNav = false"
                   class="block px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('guest.structure') ? 'bg-white/10 text-hmti-yellow font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Struktur Organisasi
                </a>
                <a href="{{ route('home') }}#program-kerja" @click="mobileNav = false"
                   class="block px-3 py-2.5 text-sm font-medium rounded-lg transition-all"
                   :class="activeSection === 'program-kerja' ? 'bg-white/10 text-hmti-yellow font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white'">
                    Program Kerja
                </a>
                <a href="{{ route('home') }}#kolaborasi" @click="mobileNav = false"
                   class="block px-3 py-2.5 text-sm font-medium rounded-lg transition-all"
                   :class="activeSection === 'kolaborasi' ? 'bg-white/10 text-hmti-yellow font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white'">
                    Kolaborasi
                </a>
                <div class="pt-2 border-t border-white/10">
                    @auth
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg text-hmti-yellow hover:bg-white/10">Admin Panel</a>
                    @else
                    <a href="{{ route('login') }}" class="block px-3 py-2.5 text-sm font-medium rounded-lg text-hmti-yellow hover:bg-white/10">Login Admin</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1 dark-page relative z-10">
        @yield('content')
    </main>

    {{-- Back to top --}}
    <button x-show="scrolled" x-transition @click="window.scrollTo({top:0,behavior:'smooth'})"
            class="fixed bottom-6 right-4 sm:right-6 z-40 w-10 h-10 sm:w-11 sm:h-11 rounded-full bg-hmti-blue text-white shadow-lg shadow-hmti-blue/30 hover:bg-hmti-blue-light transition-all flex items-center justify-center hover:scale-110 safe-area-bottom btn-magnetic">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
    </button>

    {{-- Footer --}}
    <footer class="text-white relative overflow-hidden safe-area-bottom z-10" style="background: rgba(6,12,24,0.8); backdrop-filter: blur(20px); border-top: 1px solid rgba(255,255,255,0.06);">
        <div class="absolute top-0 left-0 w-96 h-96 bg-hmti-yellow/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-hmti-blue-light/10 rounded-full translate-x-1/3 translate-y-1/3 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 sm:gap-10">
                {{-- Brand --}}
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-4 mb-5">
                        <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-14 w-auto rounded-xl shadow-lg">
                        <div>
                            <h3 class="font-extrabold text-xl text-white">HMTI Margonda</h3>
                            <p class="text-hmti-yellow text-xs font-medium tracking-wide">Himpunan Mahasiswa Teknologi Informasi</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-md mb-6">
                        Organisasi mahasiswa di bawah naungan Universitas Bina Sarana Informatika Kampus Margonda, bergerak dalam bidang teknologi informasi dan pengembangan sumber daya manusia.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="mailto:hmti.ubsi.margonda@gmail.com" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-hmti-yellow/20 flex items-center justify-center transition-colors group btn-magnetic" title="Email">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-hmti-yellow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 rounded-lg bg-white/10 hover:bg-hmti-yellow/20 flex items-center justify-center transition-colors group btn-magnetic" title="Instagram">
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-hmti-yellow" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>
                {{-- Quick Links --}}
                <div>
                    <h4 class="font-bold text-hmti-yellow text-sm uppercase tracking-wider mb-4">Navigasi</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('home') }}" class="text-sm text-gray-400 hover:text-white hover:translate-x-1 transition-all inline-block">Beranda</a></li>
                        <li><a href="{{ route('guest.structure') }}" class="text-sm text-gray-400 hover:text-white hover:translate-x-1 transition-all inline-block">Struktur Organisasi</a></li>
                        <li><a href="{{ route('home') }}#program-kerja" class="text-sm text-gray-400 hover:text-white hover:translate-x-1 transition-all inline-block">Program Kerja</a></li>
                        <li><a href="{{ route('home') }}#kolaborasi" class="text-sm text-gray-400 hover:text-white hover:translate-x-1 transition-all inline-block">Kolaborasi</a></li>
                    </ul>
                </div>
                {{-- Contact --}}
                <div>
                    <h4 class="font-bold text-hmti-yellow text-sm uppercase tracking-wider mb-4">Kontak</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-hmti-yellow/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Margonda Raya No.353, Depok, Jawa Barat</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-hmti-yellow/60" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:hmti.ubsi.margonda@gmail.com" class="hover:text-white transition-colors">hmti.ubsi.margonda@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-500">&copy; {{ date('Y') }} HMTI UBSI Margonda. All rights reserved.</p>
                <div class="flex items-center gap-4">
                    <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-8 w-auto object-contain opacity-50 hover:opacity-80 transition-opacity">
                    <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-8 w-auto rounded object-contain opacity-50 hover:opacity-80 transition-opacity">
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
