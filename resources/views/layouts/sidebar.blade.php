{{-- Sidebar --}}
<aside class="fixed inset-y-0 left-0 z-30 w-64 transform bg-hmti-blue-dark transition-transform duration-200"
       :class="$store.sidebar.open ? 'translate-x-0' : '-translate-x-full'"
       @click.away="if (window.innerWidth < 1024) $store.sidebar.open = false">

    {{-- Logo/Brand --}}
    <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
        <div class="w-10 h-10 rounded-full bg-hmti-yellow flex items-center justify-center">
            <span class="text-hmti-blue-dark font-extrabold text-sm">H</span>
        </div>
        <div>
            <h1 class="text-white font-bold text-lg leading-tight">HMTI</h1>
            <p class="text-gray-400 text-xs">Margonda · UBSI</p>
        </div>
    </div>

    {{-- Nav Links --}}
    <nav class="mt-4 px-3 space-y-1">
        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'sidebar-link-active' : 'sidebar-link' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('members.index') }}"
           class="{{ request()->routeIs('members.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Anggota
        </a>

        <a href="{{ route('events.index') }}"
           class="{{ request()->routeIs('events.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Event
        </a>

        <a href="{{ route('announcements.index') }}"
           class="{{ request()->routeIs('announcements.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            Pengumuman
        </a>

        <a href="{{ route('chat.index') }}"
           class="{{ request()->routeIs('chat.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            Chat Room
        </a>

        @if(auth()->user()->hasElevatedAccess())
            <div class="pt-4 mt-4 border-t border-white/10">
                <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Admin</p>

                <a href="{{ route('reports.index') }}"
                   class="{{ request()->routeIs('reports.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Laporan & Sertifikat
                </a>

                <a href="{{ route('admin.collaboration.index') }}"
                   class="{{ request()->routeIs('admin.collaboration.*') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Kerja Sama
                    @php $pendingCount = \App\Models\CollaborationRequest::where('status','pending')->count(); @endphp
                    @if($pendingCount > 0)
                        <span class="ml-auto text-[10px] px-1.5 py-0.5 rounded-full bg-hmti-red text-white font-bold">{{ $pendingCount }}</span>
                    @endif
                </a>

                {{-- Switch to Member View --}}
                <a href="{{ route('member.dashboard') }}"
                   class="sidebar-link mt-2 opacity-60 hover:opacity-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Portal Anggota
                </a>
            </div>
        @endif
    </nav>

    {{-- Bottom User Info --}}
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10">
        <div class="flex items-center gap-3">
            <img src="{{ auth()->user()->avatar_url }}" alt="" class="w-8 h-8 rounded-full object-cover">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-400 hover:text-hmti-red transition-colors" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Mobile overlay --}}
<div x-show="$store.sidebar.open"
     x-transition.opacity
     @click="$store.sidebar.open = false"
     class="fixed inset-0 z-20 bg-black/50 lg:hidden"></div>
