<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HMTI Margonda') - Himpunan Mahasiswa Teknologi Informasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-hmti-light text-hmti-dark min-h-screen flex flex-col" x-data x-cloak>
    {{-- Navbar --}}
    <nav class="bg-white/95 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Left: UBSI Logo + Brand --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-10 w-auto object-contain">
                    <div class="hidden sm:block">
                        <p class="font-bold text-sm leading-tight text-hmti-dark">HMTI Margonda</p>
                        <p class="text-[10px] text-hmti-gray leading-tight">Universitas Bina Sarana Informatika</p>
                    </div>
                </a>

                {{-- Center: Nav links --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-hmti-blue' : 'text-hmti-gray hover:text-hmti-blue' }} transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('guest.structure') }}" class="text-sm font-medium {{ request()->routeIs('guest.structure') ? 'text-hmti-blue' : 'text-hmti-gray hover:text-hmti-blue' }} transition-colors">
                        Struktur Organisasi
                    </a>
                    <a href="{{ route('home') }}#kolaborasi" class="text-sm font-medium text-hmti-gray hover:text-hmti-blue transition-colors">
                        Kolaborasi
                    </a>
                </div>

                {{-- Right: HMTI Logo + Login --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary text-xs px-3 py-1.5">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-hmti-blue font-semibold hover:underline">
                            Login Admin
                        </a>
                    @endauth
                    <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-10 w-auto rounded-lg object-contain">
                </div>
            </div>
        </div>

        {{-- Mobile nav --}}
        <div class="md:hidden border-t border-gray-100 px-4 py-2 flex gap-4">
            <a href="{{ route('home') }}" class="text-sm font-medium {{ request()->routeIs('home') ? 'text-hmti-blue' : 'text-hmti-gray' }}">Beranda</a>
            <a href="{{ route('guest.structure') }}" class="text-sm font-medium {{ request()->routeIs('guest.structure') ? 'text-hmti-blue' : 'text-hmti-gray' }}">Struktur Organisasi</a>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-hmti-blue-dark text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-12 w-auto rounded-lg">
                        <div>
                            <h3 class="font-bold text-lg text-white">HMTI Margonda</h3>
                            <p class="text-gray-400 text-xs">Himpunan Mahasiswa Teknologi Informasi</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Organisasi mahasiswa di bawah naungan Universitas Bina Sarana Informatika kampus Margonda,
                        bergerak dalam bidang teknologi informasi dan pengembangan sumber daya manusia.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-hmti-yellow mb-3">Link Cepat</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('guest.structure') }}" class="hover:text-white transition-colors">Struktur Organisasi</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-hmti-yellow mb-3">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Universitas Bina Sarana Informatika</li>
                        <li>Kampus Margonda, Depok</li>
                        <li>hmti.margonda@bsi.ac.id</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-500">&copy; {{ date('Y') }} HMTI UBSI Margonda. All rights reserved.</p>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-8 w-auto object-contain opacity-60">
                    <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-8 w-auto rounded object-contain opacity-60">
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
