@extends('layouts.auth')
@section('title', 'Login Admin')

@section('form')
    {{-- Mobile branding --}}
    <div class="lg:hidden text-center mb-8">
        <div class="flex items-center justify-center gap-4 mb-4">
            <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-12 w-auto object-contain">
            <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-12 w-auto rounded-lg object-contain">
        </div>
        <h1 class="text-2xl font-bold text-white">HMTI Margonda</h1>
        <p class="text-hmti-yellow text-sm mt-1">Panel Admin</p>
    </div>

    <div class="rounded-2xl shadow-2xl p-8 relative overflow-hidden" style="background: rgba(255,255,255,0.06); backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.12); box-shadow: 0 25px 50px rgba(0,0,0,0.4);">
        {{-- Glass shine --}}
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <div class="text-center mb-6">
            <div class="w-14 h-14 mx-auto rounded-full flex items-center justify-center mb-3" style="background: rgba(245,197,24,0.15); border: 1px solid rgba(245,197,24,0.25);">
                <svg class="w-7 h-7 text-hmti-yellow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white">Login Admin</h2>
            <p class="text-blue-300/60 text-sm mt-1">Masuk ke panel administrasi HMTI</p>
        </div>

        @if(session('error'))
            <div class="mb-4 p-3 rounded-lg text-sm text-red-300" style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2);">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="input w-full" placeholder="admin@hmti.ac.id" required autofocus
                       style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                @error('email')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="password">Password</label>
                <div x-data="{ show: false }" class="relative">
                    <input :type="show ? 'text' : 'password'" name="password" id="password"
                           class="input w-full pr-10" placeholder="••••••••" required
                           style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    <button type="button" @click="show = !show"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-300/40 hover:text-hmti-yellow transition-colors">
                        <svg x-show="!show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <svg x-show="show" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-white/20 bg-white/10 text-hmti-yellow focus:ring-hmti-yellow">
                    <span class="text-sm text-blue-300/60">Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="btn-shiny w-full py-2.5 rounded-xl font-bold text-sm transition-all" style="background: linear-gradient(135deg, #f5c518, #d4a80e); color: #0f2447; border: none; box-shadow: 0 8px 20px rgba(245,197,24,0.3);">
                <svg class="w-4 h-4 inline mr-1 -mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm text-hmti-yellow hover:text-white font-medium transition-colors">
                &larr; Kembali ke halaman utama
            </a>
        </div>
    </div>

    <p class="mt-4 text-center text-xs text-blue-300/30">
        Demo: admin@hmti.ac.id / password
    </p>
@endsection
