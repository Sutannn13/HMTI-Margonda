@extends('layouts.guest')
@section('title', 'Struktur Organisasi')

@section('content')
{{-- Header --}}
<section class="relative overflow-hidden bg-gradient-to-br from-hmti-blue-dark via-hmti-blue to-hmti-blue-light py-16 lg:py-20">
    <div class="absolute inset-0 opacity-10">
        <img src="{{ asset('images/hmti2.jpeg') }}" alt="" class="w-full h-full object-cover">
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex items-center justify-center gap-4 mb-6">
            <img src="{{ asset('images/logo ubsi.png') }}" alt="UBSI" class="h-12 w-auto object-contain opacity-80">
            <img src="{{ asset('images/logo hmti.jpg') }}" alt="HMTI" class="h-12 w-auto rounded-lg object-contain opacity-80">
        </div>
        <h1 class="text-3xl lg:text-5xl font-extrabold text-white mb-3">Struktur Organisasi</h1>
        <p class="text-hmti-yellow font-semibold text-lg">HMTI Margonda — UBSI</p>
        <p class="text-gray-300 text-sm mt-2">Periode {{ date('Y') }}/{{ date('Y') + 1 }}</p>
    </div>
</section>

{{-- KWSB Section - Leadership --}}
<section class="py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-hmti-blue/10 text-hmti-blue uppercase tracking-wider">
                Pimpinan Inti
            </span>
            <h2 class="text-3xl font-extrabold text-hmti-blue mt-4">KWSB</h2>
            <p class="text-hmti-gray mt-2">Ketua, Wakil Ketua, Sekretaris & Bendahara</p>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        @if($kwsb->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 max-w-5xl mx-auto">
            @foreach($kwsb as $member)
            <div class="text-center group">
                <div class="relative mx-auto w-36 h-36 mb-4">
                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-hmti-blue to-hmti-blue-light opacity-20 group-hover:opacity-40 transition-opacity"></div>
                    <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}"
                         class="w-36 h-36 rounded-full object-cover border-4 border-white shadow-lg group-hover:shadow-xl transition-shadow">
                </div>
                <h3 class="font-bold text-lg text-hmti-dark">{{ $member->name }}</h3>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold mt-2
                    {{ $member->position === 'ketua' ? 'bg-hmti-blue text-white' :
                       ($member->position === 'wakil' ? 'bg-hmti-blue-light text-white' :
                       ($member->position === 'sekretaris' ? 'bg-hmti-yellow text-hmti-blue-dark' :
                       'bg-green-500 text-white')) }}">
                    {{ $member->position_label }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-center text-hmti-gray">Data belum tersedia.</p>
        @endif
    </div>
</section>

{{-- Divisi Cards --}}
<section class="py-16 lg:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold bg-hmti-yellow/20 text-hmti-yellow-dark uppercase tracking-wider">
                Divisi Organisasi
            </span>
            <h2 class="text-3xl font-extrabold text-hmti-blue mt-4">Divisi-Divisi HMTI Margonda</h2>
            <div class="w-20 h-1 bg-hmti-yellow mx-auto rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Kominfo --}}
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-white">Divisi Kominfo</h3>
                            <p class="text-yellow-100 text-xs">Komunikasi & Informasi</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($kominfo as $member)
                    <div class="flex items-center gap-4 {{ !$loop->last ? 'pb-4 border-b border-gray-100' : '' }}">
                        <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                        <div>
                            <p class="font-semibold text-hmti-dark">{{ $member->name }}</p>
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                {{ $member->position === 'kadiv' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $member->position_label }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @if($kominfo->count() === 0)
                    <p class="text-center text-hmti-gray text-sm">Data belum tersedia.</p>
                    @endif
                </div>
            </div>

            {{-- Litbang --}}
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-white">Divisi Litbang</h3>
                            <p class="text-green-100 text-xs">Penelitian & Pengembangan</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($litbang as $member)
                    <div class="flex items-center gap-4 {{ !$loop->last ? 'pb-4 border-b border-gray-100' : '' }}">
                        <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                        <div>
                            <p class="font-semibold text-hmti-dark">{{ $member->name }}</p>
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                {{ $member->position === 'kadiv' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $member->position_label }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @if($litbang->count() === 0)
                    <p class="text-center text-hmti-gray text-sm">Data belum tersedia.</p>
                    @endif
                </div>
            </div>

            {{-- PSDM --}}
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-shadow">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-white">Divisi PSDM</h3>
                            <p class="text-purple-100 text-xs">Pengembangan SDM</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    @foreach($psdm as $member)
                    <div class="flex items-center gap-4 {{ !$loop->last ? 'pb-4 border-b border-gray-100' : '' }}">
                        <img src="{{ $member->avatar_url }}" alt="{{ $member->name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                        <div>
                            <p class="font-semibold text-hmti-dark">{{ $member->name }}</p>
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                {{ $member->position === 'kadiv' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $member->position_label }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @if($psdm->count() === 0)
                    <p class="text-center text-hmti-gray text-sm">Data belum tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
