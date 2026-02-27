@extends('layouts.public')
@section('title', 'Ajukan Kerja Sama — HMTI Margonda')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

    {{-- Left: Info --}}
    <div class="lg:col-span-2 space-y-6">
        <div>
            <span class="inline-block text-xs px-3 py-1 rounded-full bg-hmti-blue/10 text-hmti-blue font-semibold mb-3">Kerja Sama & Kolaborasi</span>
            <h1 class="text-2xl font-extrabold text-hmti-dark leading-tight">Bergabung bersama HMTI Margonda</h1>
            <p class="text-hmti-gray mt-3 text-sm leading-relaxed">
                HMTI UBSI Margonda membuka peluang kolaborasi dengan berbagai pihak — institusi pendidikan, perusahaan teknologi, komunitas, maupun individu — untuk menciptakan program yang bermanfaat bagi anggota dan masyarakat luas.
            </p>
        </div>

        <div class="space-y-3">
            @foreach([
                ['icon' => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z', 'title' => 'Sponsor Acara', 'desc' => 'Festival, seminar, kompetisi teknologi'],
                ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Workshop & Pelatihan', 'desc' => 'Transfer ilmu ke anggota HMTI'],
                ['icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Rekrutmen & Internship', 'desc' => 'Temukan talenta dari anggota kami'],
                ['icon' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z', 'title' => 'Riset & Proyek Bersama', 'desc' => 'Kolaborasi penelitian dan pengembangan'],
            ] as $item)
            <div class="flex items-start gap-3 p-3 rounded-xl bg-white border border-gray-100 shadow-sm">
                <div class="w-9 h-9 rounded-lg bg-hmti-blue/10 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-hmti-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-hmti-dark">{{ $item['title'] }}</p>
                    <p class="text-xs text-hmti-gray">{{ $item['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-hmti-blue rounded-2xl p-5 text-white text-sm">
            <p class="font-semibold mb-1">Kontak Langsung</p>
            <p class="text-blue-200 text-xs">Email: hmti@ubsi.ac.id</p>
            <p class="text-blue-200 text-xs mt-0.5">Kampus UBSI Margonda, Depok</p>
        </div>
    </div>

    {{-- Right: Form --}}
    <div class="lg:col-span-3">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-lg font-bold text-hmti-dark mb-1">Formulir Pengajuan</h2>
            <p class="text-xs text-hmti-gray mb-6">Isi formulir berikut dan tim kami akan menghubungi Anda dalam 1–3 hari kerja.</p>

            <form action="{{ route('collaboration.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="label">Nama Lengkap <span class="text-hmti-red">*</span></label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()?->name) }}"
                               class="input @error('name') border-hmti-red @enderror" required placeholder="Nama Anda">
                        @error('name')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Instansi / Organisasi</label>
                        <input type="text" name="organization" value="{{ old('organization') }}"
                               class="input" placeholder="Nama perusahaan / org. (opsional)">
                    </div>
                    <div>
                        <label class="label">Email <span class="text-hmti-red">*</span></label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}"
                               class="input @error('email') border-hmti-red @enderror" required placeholder="nama@email.com">
                        @error('email')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">No. Telepon / WhatsApp</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()?->phone) }}"
                               class="input" placeholder="+62 ...">
                    </div>
                </div>

                <div>
                    <label class="label">Jenis Kolaborasi <span class="text-hmti-red">*</span></label>
                    <select name="proposal_type" class="input @error('proposal_type') border-hmti-red @enderror" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="event_sponsor" {{ old('proposal_type') === 'event_sponsor' ? 'selected' : '' }}>Sponsor Acara</option>
                        <option value="workshop" {{ old('proposal_type') === 'workshop' ? 'selected' : '' }}>Workshop / Seminar</option>
                        <option value="recruitment" {{ old('proposal_type') === 'recruitment' ? 'selected' : '' }}>Rekrutmen / Internship</option>
                        <option value="research" {{ old('proposal_type') === 'research' ? 'selected' : '' }}>Kolaborasi Riset</option>
                        <option value="social_project" {{ old('proposal_type') === 'social_project' ? 'selected' : '' }}>Proyek Sosial</option>
                        <option value="other" {{ old('proposal_type') === 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('proposal_type')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">Deskripsi Proposal <span class="text-hmti-red">*</span></label>
                    <textarea name="message" rows="5"
                              class="input resize-none @error('message') border-hmti-red @enderror" required
                              placeholder="Jelaskan ide kolaborasi Anda secara singkat (min. 30 karakter)...">{{ old('message') }}</textarea>
                    @error('message')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn-primary w-full justify-center py-3">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    Kirim Proposal
                </button>

                <p class="text-[11px] text-hmti-gray text-center">Data yang Anda kirimkan akan dijaga kerahasiaannya.</p>
            </form>
        </div>
    </div>
</div>
@endsection
