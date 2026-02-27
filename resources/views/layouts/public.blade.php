<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HMTI Margonda')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-hmti-dark" x-data x-cloak>
    {{-- Minimal navbar --}}
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-hmti-blue flex items-center justify-center">
                    <span class="text-hmti-yellow font-extrabold text-sm">H</span>
                </div>
                <div>
                    <p class="font-bold text-sm leading-tight text-hmti-dark">HMTI Margonda</p>
                    <p class="text-[10px] text-hmti-gray leading-tight">UBSI Margonda</p>
                </div>
            </a>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ route('member.dashboard') }}" class="text-sm text-hmti-blue hover:underline font-medium">
                        ← Portal Saya
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-hmti-blue hover:underline font-medium">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                 class="mb-5 flex items-center gap-3 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm">
                <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="mt-12 border-t border-gray-100 py-6 text-center text-xs text-hmti-gray">
        © {{ date('Y') }} HMTI UBSI Margonda. All rights reserved.
    </footer>
    @stack('scripts')
</body>
</html>
