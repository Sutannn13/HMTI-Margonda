<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HMTI Margo') - Himpunan Mahasiswa Teknologi Informasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full" x-data x-cloak>

    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content --}}
        <div class="flex flex-1 flex-col overflow-hidden"
             :class="$store.sidebar.open ? 'lg:ml-64' : ''">

            {{-- Top Navbar --}}
            @include('layouts.navbar')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         x-transition.opacity
                         class="mb-4 rounded-lg bg-green-50 border border-green-200 p-4 flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-green-800">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         x-transition.opacity
                         class="mb-4 rounded-lg bg-red-50 border border-red-200 p-4 flex items-center gap-3">
                        <svg class="w-5 h-5 text-hmti-red shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-red-800">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Global Real-time Notification Listener --}}
    <div x-data="{
        init() {
            if (window.Echo) {
                window.Echo.channel('announcements')
                    .listen('AnnouncementPosted', (e) => {
                        $store.notifications.add({
                            title: e.title,
                            body: e.body.substring(0, 100) + '...',
                            priority: e.priority,
                            time: e.created_at,
                        });
                    });
            }
        }
    }"></div>

    {{-- Toast Notifications --}}
    <div class="fixed top-4 right-4 z-50 space-y-2 w-80">
        <template x-for="(notification, index) in $store.notifications.items" :key="index">
            <div x-transition:enter="transform ease-out duration-300"
                 x-transition:enter-start="translate-x-full opacity-0"
                 x-transition:enter-end="translate-x-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="bg-white rounded-lg shadow-lg border-l-4 p-4 cursor-pointer"
                 :class="{
                    'border-hmti-red': notification.priority === 'urgent',
                    'border-hmti-yellow': notification.priority === 'high',
                    'border-hmti-blue': notification.priority === 'normal' || notification.priority === 'low',
                 }"
                 @click="$store.notifications.remove(notification)">
                <p class="font-semibold text-sm text-hmti-dark" x-text="notification.title"></p>
                <p class="text-xs text-hmti-gray mt-1" x-text="notification.body"></p>
            </div>
        </template>
    </div>

    @stack('scripts')
</body>
</html>
