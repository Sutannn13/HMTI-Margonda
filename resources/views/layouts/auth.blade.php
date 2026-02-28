<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login') - HMTI Margo Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-hmti-blue-dark">
    <div class="min-h-full flex">
        {{-- Left: Branding Panel --}}
        <div class="hidden lg:flex lg:w-1/2 flex-col justify-center items-center p-12 relative overflow-hidden">
            <div class="absolute inset-0">
                <img src="{{ asset('images/hmti1.jpeg') }}" alt="HMTI" class="w-full h-full object-cover scale-105">
                <div class="absolute inset-0 bg-gradient-to-br from-hmti-blue-dark/95 via-hmti-blue/85 to-hmti-blue-dark/90"></div>
            </div>
            {{-- Animated decorations --}}
            <div class="absolute top-20 left-10 w-72 h-72 bg-hmti-yellow/10 rounded-full animate-blob blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-56 h-56 bg-white/5 rounded-full animate-float-slow blur-2xl"></div>
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>

            <div class="relative z-10 text-center animate-fade-in-up">
                <div class="flex items-center justify-center gap-6 mb-8">
                    <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-20 w-auto object-contain opacity-90 drop-shadow-lg">
                    <div class="w-px h-16 bg-gradient-to-b from-transparent via-white/40 to-transparent"></div>
                    <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-20 w-auto rounded-xl object-contain opacity-90 drop-shadow-lg">
                </div>
                <h1 class="text-4xl font-black text-white mb-3">HMTI Margonda</h1>
                <p class="text-hmti-yellow font-bold text-lg mb-2">Himpunan Mahasiswa Teknologi Informasi</p>
                <p class="text-gray-300 text-sm">Universitas Bina Sarana Informatika · Margonda</p>
            </div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-hmti-yellow via-hmti-red to-hmti-yellow animate-shimmer"></div>
        </div>

        {{-- Right: Form --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative overflow-hidden">
            <div class="absolute top-10 right-10 w-40 h-40 bg-hmti-yellow/5 rounded-full animate-float blur-2xl lg:hidden"></div>
            <div class="w-full max-w-md relative z-10 animate-fade-in-up">
                @yield('form')
            </div>
        </div>
    </div>
</body>
</html>
