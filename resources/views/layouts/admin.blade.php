<!DOCTYPE html>
<html lang="id" class="h-full" style="background-color: #060e1a;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#060e1a">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(session('success'))<meta name="flash-success" content="{{ session('success') }}">@endif
    @if(session('error'))<meta name="flash-error" content="{{ session('error') }}">@endif
    <title>@yield('title', 'Admin') - HMTI Margo Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full overflow-hidden"
      x-data="{
          sidebarOpen: window.innerWidth >= 1024,
          isMobile: window.innerWidth < 1024,
          init() {
              const onResize = () => {
                  this.isMobile = window.innerWidth < 1024;
                  if (!this.isMobile) this.sidebarOpen = true;
                  else this.sidebarOpen = false;
              };
              window.addEventListener('resize', onResize);
          }
      }"
      x-cloak
      style="background-color: #060e1a; background-image: linear-gradient(135deg, #060e1a 0%, #0a1628 20%, #0f2042 50%, #0d1f3c 80%, #070f1e 100%); min-height: 100dvh;">

    {{-- Scroll Progress Bar --}}
    <div id="scroll-progress"></div>

    {{-- Interactive Cursor Glow --}}
    <div id="cursor-glow"></div>

    {{-- Ambient Glow Orbs --}}
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute top-[10%] left-[5%] w-[450px] h-[450px] rounded-full animate-float-slow" style="background: radial-gradient(circle, rgba(26,58,160,0.08) 0%, transparent 70%); filter: blur(80px);"></div>
        <div class="absolute top-[50%] right-[10%] w-[350px] h-[350px] rounded-full animate-blob" style="background: radial-gradient(circle, rgba(245,197,24,0.04) 0%, transparent 70%); filter: blur(60px);"></div>
        <div class="absolute bottom-[5%] left-[40%] w-[500px] h-[500px] rounded-full animate-blob-delay" style="background: radial-gradient(circle, rgba(56,189,248,0.03) 0%, transparent 70%); filter: blur(90px);"></div>
    </div>

    <div class="flex h-screen overflow-hidden relative z-10">

        {{-- ================================
             MOBILE SIDEBAR BACKDROP OVERLAY
             ================================ --}}
        <div x-show="sidebarOpen && isMobile"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 z-20 lg:hidden"
             style="background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);">
        </div>

        {{-- ================================
             SIDEBAR
             ================================ --}}
        <aside class="fixed inset-y-0 left-0 z-30 w-64 transform transition-transform duration-300 ease-out glass-ultra shadow-2xl"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- Glass shine line at top --}}
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>

            {{-- Brand + Mobile Close --}}
            <div class="flex items-center justify-between gap-3 px-5 py-5 border-b border-white/8">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-hmti-yellow flex items-center justify-center shrink-0 shadow-lg shadow-hmti-yellow/20">
                        <span class="text-hmti-blue-dark font-extrabold text-base">H</span>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-base leading-tight">Admin HMTI</h1>
                        <p class="text-gray-400 text-xs">Margonda · UBSI</p>
                    </div>
                </div>
                {{-- Mobile close button --}}
                <button @click="sidebarOpen = false"
                        class="lg:hidden p-1.5 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-colors shrink-0"
                        aria-label="Tutup sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Navigation --}}
            <nav class="mt-4 px-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                   @click="if(isMobile) sidebarOpen = false"
                   class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.organization.index') }}"
                   @click="if(isMobile) sidebarOpen = false"
                   class="{{ request()->routeIs('admin.organization.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Struktur Organisasi
                </a>

                <a href="{{ route('admin.collaboration.index') }}"
                   @click="if(isMobile) sidebarOpen = false"
                   class="{{ request()->routeIs('admin.collaboration.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Kolaborasi
                    @php $pendingCollab = \App\Models\CollaborationRequest::where('status', 'pending')->count(); @endphp
                    @if($pendingCollab > 0)
                    <span class="ml-auto bg-hmti-yellow text-hmti-blue-dark text-[10px] font-bold px-1.5 py-0.5 rounded-full animate-pulse">{{ $pendingCollab }}</span>
                    @endif
                </a>

                <div class="pt-4 mt-4 border-t border-white/8">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Keuangan</p>

                    <a href="{{ route('admin.kas.index') }}"
                       @click="if(isMobile) sidebarOpen = false"
                       class="{{ request()->routeIs('admin.kas.index') ? 'sidebar-link-active' : 'sidebar-link' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Uang Kas
                    </a>

                    <a href="{{ route('admin.kas.report') }}"
                       @click="if(isMobile) sidebarOpen = false"
                       class="{{ request()->routeIs('admin.kas.report') ? 'sidebar-link-active' : 'sidebar-link' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Laporan Kas
                    </a>
                </div>

                <div class="pt-4 mt-4 border-t border-white/8">
                    <a href="{{ route('home') }}" class="sidebar-link opacity-60 hover:opacity-100" target="_blank">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        Lihat Website
                    </a>
                </div>
            </nav>

            {{-- Bottom User --}}
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/8">
                <div class="flex items-center gap-3">
                    <img src="{{ auth()->user()->avatar_url }}" alt="" class="w-8 h-8 rounded-full object-cover ring-2 ring-hmti-yellow/20 shrink-0">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="p-1.5 rounded-lg text-gray-400 hover:text-white hover:bg-white/10 transition-colors shrink-0" title="Logout">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ================================
             MAIN CONTENT AREA
             ================================ --}}
        <div class="flex-1 flex flex-col overflow-hidden transition-all duration-300"
             :class="sidebarOpen && !isMobile ? 'lg:ml-64' : ''">

            {{-- Top bar --}}
            <header class="sticky top-0 z-10 px-4 py-3 glass-ultra relative"
                    style="border-bottom: 1px solid rgba(255,255,255,0.06); box-shadow: 0 4px 30px rgba(0,0,0,0.1);">
                {{-- Glass shine --}}
                <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
                <div class="flex items-center justify-between gap-3">
                    {{-- Left: Hamburger + Page Title --}}
                    <div class="flex items-center gap-3 min-w-0">
                        <button @click="sidebarOpen = !sidebarOpen"
                                class="p-2 rounded-xl text-gray-400 hover:bg-white/10 hover:text-white transition-all duration-200 shrink-0"
                                aria-label="Toggle sidebar">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div class="min-w-0">
                            <h2 class="text-base sm:text-lg font-bold text-white truncate">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-[11px] text-blue-300/70 -mt-0.5 hidden sm:block">{{ now()->translatedFormat('l, d F Y') }}</p>
                        </div>
                    </div>

                    {{-- Right: Actions --}}
                    <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                        {{-- Quick link to website (hidden on very small screens) --}}
                        <a href="{{ route('home') }}" target="_blank"
                           class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-300/80 bg-white/5 border border-white/10 hover:bg-hmti-yellow hover:text-hmti-blue-dark hover:border-hmti-yellow rounded-lg transition-all duration-200 btn-magnetic">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            Website
                        </a>

                        {{-- Notification Bell --}}
                        @php $pendingCollabCount = \App\Models\CollaborationRequest::where('status', 'pending')->count(); @endphp
                        <div x-data="{ notifOpen: false }" class="relative">
                            <button @click="notifOpen = !notifOpen"
                                    class="relative p-2 rounded-xl text-gray-400 hover:bg-white/10 hover:text-white transition-all duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                @if($pendingCollabCount > 0)
                                <span class="absolute -top-0.5 -right-0.5 w-5 h-5 bg-hmti-red text-white text-[10px] font-bold rounded-full flex items-center justify-center animate-pulse">{{ $pendingCollabCount }}</span>
                                @endif
                            </button>

                            {{-- Notification Dropdown — Mobile-safe width --}}
                            <div x-show="notifOpen" @click.away="notifOpen = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 rounded-2xl shadow-2xl overflow-hidden z-50 glass-ultra"
                                 style="width: min(320px, calc(100vw - 2rem));">
                                <div class="px-4 py-3" style="background: linear-gradient(135deg, rgba(245,197,24,0.1) 0%, rgba(26,58,107,0.2) 100%); border-bottom: 1px solid rgba(255,255,255,0.08);">
                                    <p class="text-sm font-bold text-white">Notifikasi</p>
                                    <p class="text-[11px] text-blue-300/70">Pemberitahuan sistem terbaru</p>
                                </div>
                                <div class="max-h-64 overflow-y-auto divide-y divide-white/5">
                                    @if($pendingCollabCount > 0)
                                    <a href="{{ route('admin.collaboration.index') }}" @click="notifOpen = false" class="flex items-start gap-3 px-4 py-3 hover:bg-white/5 transition-colors">
                                        <div class="w-9 h-9 rounded-lg bg-orange-500/20 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-white">{{ $pendingCollabCount }} Pengajuan Kolaborasi</p>
                                            <p class="text-[11px] text-blue-300/60">Menunggu ditinjau oleh admin</p>
                                        </div>
                                    </a>
                                    @endif
                                    @php $lateCount = \App\Models\KasPayment::where('is_late', true)->where('is_paid', false)->count(); @endphp
                                    @if($lateCount > 0)
                                    <a href="{{ route('admin.kas.index') }}" @click="notifOpen = false" class="flex items-start gap-3 px-4 py-3 hover:bg-white/5 transition-colors">
                                        <div class="w-9 h-9 rounded-lg bg-red-500/20 flex items-center justify-center shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-white">{{ $lateCount }} Anggota Terlambat Bayar</p>
                                            <p class="text-[11px] text-blue-300/60">Ada kas yang sudah kena sanksi</p>
                                        </div>
                                    </a>
                                    @endif
                                    @if($pendingCollabCount === 0 && $lateCount === 0)
                                    <div class="px-4 py-8 text-center">
                                        <svg class="w-10 h-10 text-green-500/30 mx-auto mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <p class="text-xs text-blue-300/60">Semua aman!</p>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- User avatar --}}
                        <div class="flex items-center gap-2 pl-2 border-l border-white/10">
                            <img src="{{ auth()->user()->avatar_url }}" alt="" class="w-8 h-8 rounded-full object-cover ring-2 ring-hmti-yellow/30 shrink-0">
                            <span class="hidden md:block text-xs font-medium text-white max-w-[100px] truncate">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main id="main-scroll" class="flex-1 overflow-x-hidden overflow-y-auto p-4 lg:p-6 custom-scrollbar">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
