{{-- Top Navbar --}}
<header class="sticky top-0 z-10 bg-white border-b border-gray-200 px-4 py-3">
    <div class="flex items-center justify-between">
        {{-- Left: Hamburger + Page Title --}}
        <div class="flex items-center gap-3">
            <button @click="$store.sidebar.toggle()"
                    class="p-1.5 rounded-lg text-hmti-gray hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h2 class="text-lg font-semibold text-hmti-dark">@yield('page-title', 'Dashboard')</h2>
        </div>

        {{-- Right: Notifications + Profile --}}
        <div class="flex items-center gap-3">
            {{-- Notification bell --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                        class="relative p-2 rounded-lg text-hmti-gray hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span x-show="$store.notifications.unreadCount > 0"
                          class="absolute top-1 right-1 w-4 h-4 bg-hmti-red rounded-full text-white text-[10px] flex items-center justify-center font-bold"
                          x-text="$store.notifications.unreadCount"></span>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                    <div class="px-4 py-2 border-b border-gray-100 flex items-center justify-between">
                        <span class="text-sm font-semibold text-hmti-dark">Notifikasi</span>
                        <button @click="$store.notifications.markAllRead()" class="text-xs text-hmti-blue hover:underline">
                            Tandai semua dibaca
                        </button>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <template x-if="$store.notifications.items.length === 0">
                            <p class="px-4 py-6 text-center text-sm text-hmti-gray">Tidak ada notifikasi</p>
                        </template>
                        <template x-for="(n, i) in $store.notifications.items" :key="i">
                            <div class="px-4 py-2 hover:bg-gray-50 cursor-pointer border-b border-gray-50">
                                <p class="text-sm font-medium text-hmti-dark" x-text="n.title"></p>
                                <p class="text-xs text-hmti-gray mt-0.5" x-text="n.time"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- User avatar --}}
            <div class="flex items-center gap-2">
                <img src="{{ auth()->user()->avatar_url }}" alt="" class="w-8 h-8 rounded-full object-cover border-2 border-hmti-yellow">
                <span class="hidden sm:block text-sm font-medium text-hmti-dark">{{ auth()->user()->name }}</span>
            </div>
        </div>
    </div>
</header>
