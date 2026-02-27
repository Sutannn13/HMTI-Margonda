<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Portal Anggota') — HMTI Margonda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50" x-data x-cloak>

    <div class="flex h-full">
        {{-- Member Sidebar --}}
        <aside class="hidden lg:flex lg:flex-col w-64 bg-white border-r border-gray-200 shrink-0">
            {{-- Brand --}}
            <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-hmti-blue flex items-center justify-center">
                    <span class="text-hmti-yellow font-extrabold text-base">H</span>
                </div>
                <div>
                    <h1 class="text-hmti-dark font-bold text-sm leading-tight">HMTI Margonda</h1>
                    <p class="text-hmti-gray text-xs">Portal Anggota</p>
                </div>
            </div>

            {{-- User greeting card --}}
            <div class="mx-3 mt-4 p-3 rounded-xl bg-hmti-blue/5 border border-hmti-blue/10">
                <div class="flex items-center gap-3">
                    <img src="{{ auth()->user()->avatar_url }}" class="w-10 h-10 rounded-full object-cover border-2 border-white shadow" alt="">
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-hmti-dark truncate">{{ auth()->user()->name }}</p>
                        <span class="inline-block mt-0.5 text-[10px] px-2 py-0.5 rounded-full font-medium
                            {{ auth()->user()->role === 'coordinator' ? 'bg-hmti-yellow/20 text-hmti-yellow-dark' : 'bg-hmti-blue/10 text-hmti-blue' }}">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                </div>
                @if(auth()->user()->division)
                <p class="text-xs text-hmti-gray mt-2">
                    <span class="text-hmti-blue">●</span>
                    Divisi {{ ucfirst(str_replace('_', ' ', auth()->user()->division)) }}
                </p>
                @endif
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 mt-5 space-y-0.5 overflow-y-auto">
                <p class="px-3 text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Menu Utama</p>

                <a href="{{ route('member.dashboard') }}"
                   class="member-nav {{ request()->routeIs('member.dashboard') ? 'member-nav-active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Beranda
                </a>

                <a href="{{ route('member.events') }}"
                   class="member-nav {{ request()->routeIs('member.events') ? 'member-nav-active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Kegiatan
                </a>

                <a href="{{ route('member.my-events') }}"
                   class="member-nav {{ request()->routeIs('member.my-events') ? 'member-nav-active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Kegiatan Saya
                </a>

                <a href="{{ route('announcements.index') }}"
                   class="member-nav {{ request()->routeIs('announcements.*') ? 'member-nav-active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    Pengumuman
                </a>

                <a href="{{ route('chat.index') }}"
                   class="member-nav {{ request()->routeIs('chat.*') ? 'member-nav-active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Chat Room
                </a>

                <div class="pt-4 mt-2">
                    <p class="px-3 text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Akun</p>

                    <a href="{{ route('member.profile') }}"
                       class="member-nav {{ request()->routeIs('member.profile') ? 'member-nav-active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil Saya
                    </a>

                    <a href="{{ route('collaboration.create') }}"
                       class="member-nav {{ request()->routeIs('collaboration.*') ? 'member-nav-active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Ajukan Kerja Sama
                    </a>
                </div>
            </nav>

            {{-- Footer --}}
            <div class="p-3 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-hmti-gray hover:bg-hmti-red/5 hover:text-hmti-red transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile top bar --}}
        <div class="lg:hidden fixed top-0 left-0 right-0 z-40 bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <button @click="$store.sidebar.open = !$store.sidebar.open" class="text-hmti-gray">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="font-bold text-hmti-dark text-sm">HMTI Margonda</span>
            </div>
            <img src="{{ auth()->user()->avatar_url }}" class="w-8 h-8 rounded-full border border-gray-200">
        </div>

        {{-- Mobile Sidebar Drawer --}}
        <div x-show="$store.sidebar.open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="transform -translate-x-full"
             x-transition:enter-end="transform translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="transform translate-x-0"
             x-transition:leave-end="transform -translate-x-full"
             class="lg:hidden fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 overflow-y-auto">
            <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-hmti-blue flex items-center justify-center">
                    <span class="text-hmti-yellow font-extrabold text-base">H</span>
                </div>
                <div>
                    <h1 class="text-hmti-dark font-bold text-sm">HMTI Margonda</h1>
                    <p class="text-hmti-gray text-xs">Portal Anggota</p>
                </div>
            </div>
            <nav class="px-3 mt-4 space-y-0.5">
                <a href="{{ route('member.dashboard') }}" class="member-nav {{ request()->routeIs('member.dashboard') ? 'member-nav-active' : '' }}">Beranda</a>
                <a href="{{ route('member.events') }}" class="member-nav {{ request()->routeIs('member.events') ? 'member-nav-active' : '' }}">Kegiatan</a>
                <a href="{{ route('member.my-events') }}" class="member-nav {{ request()->routeIs('member.my-events') ? 'member-nav-active' : '' }}">Kegiatan Saya</a>
                <a href="{{ route('announcements.index') }}" class="member-nav">Pengumuman</a>
                <a href="{{ route('chat.index') }}" class="member-nav">Chat Room</a>
                <a href="{{ route('member.profile') }}" class="member-nav {{ request()->routeIs('member.profile') ? 'member-nav-active' : '' }}">Profil Saya</a>
                <a href="{{ route('collaboration.create') }}" class="member-nav">Ajukan Kerja Sama</a>
            </nav>
        </div>
        <div x-show="$store.sidebar.open" x-transition.opacity @click="$store.sidebar.open = false"
             class="lg:hidden fixed inset-0 z-40 bg-black/40"></div>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
            {{-- Top header --}}
            <header class="hidden lg:flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200 shrink-0">
                <div>
                    <h2 class="text-lg font-bold text-hmti-dark">@yield('page-title', 'Portal Anggota')</h2>
                    <p class="text-xs text-hmti-gray">{{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    {{-- Notification Bell --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="relative p-2 rounded-full hover:bg-gray-100 text-hmti-gray transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </button>
                        <div x-show="open" x-transition @click.away="open = false"
                             class="absolute right-0 mt-2 w-72 bg-white rounded-xl shadow-lg border border-gray-200 z-50 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-100 font-semibold text-sm text-hmti-dark">Notifikasi</div>
                            <div class="px-4 py-8 text-center text-sm text-hmti-gray">Tidak ada notifikasi baru.</div>
                        </div>
                    </div>
                    {{-- Quick admin switch --}}
                    @if(auth()->user()->hasElevatedAccess())
                    <a href="{{ route('dashboard') }}" class="text-xs px-3 py-1.5 rounded-lg bg-hmti-blue text-white hover:bg-hmti-blue-light transition-colors font-medium">
                        Panel Admin →
                    </a>
                    @endif
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-6 lg:p-8 mt-14 lg:mt-0">
                {{-- Flash messages --}}
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         class="mb-5 flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm">
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="mb-5 flex items-center gap-3 p-4 rounded-xl bg-red-50 border border-red-200 text-hmti-red text-sm">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
