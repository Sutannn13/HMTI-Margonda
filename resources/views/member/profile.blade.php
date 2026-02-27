@extends('layouts.member')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Profile card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Cover --}}
        <div class="h-24 bg-gradient-to-r from-hmti-blue to-hmti-blue-light"></div>
        <div class="px-6 pb-6">
            <div class="flex items-end gap-4 -mt-10 mb-4">
                <div class="relative">
                    <img src="{{ $user->avatar_url }}" id="avatar-preview"
                         class="w-20 h-20 rounded-2xl object-cover border-4 border-white shadow-md">
                </div>
                <div class="mb-1">
                    <h3 class="text-lg font-bold text-hmti-dark">{{ $user->name }}</h3>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs px-2 py-0.5 rounded-full font-medium
                            {{ $user->role === 'coordinator' ? 'bg-hmti-yellow/20 text-hmti-yellow-dark' : 'bg-hmti-blue/10 text-hmti-blue' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                        @if($user->division)
                        <span class="text-xs text-hmti-gray">Divisi {{ ucfirst(str_replace('_', ' ', $user->division)) }}</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-3 p-4 rounded-xl bg-gray-50 text-center">
                <div>
                    <p class="text-lg font-bold text-hmti-blue">{{ $user->registrations()->count() }}</p>
                    <p class="text-[11px] text-hmti-gray">Kegiatan</p>
                </div>
                <div>
                    <p class="text-lg font-bold text-green-600">{{ $user->registrations()->where('attendance_status', 'attended')->count() }}</p>
                    <p class="text-[11px] text-hmti-gray">Hadir</p>
                </div>
                <div>
                    <p class="text-lg font-bold text-hmti-yellow-dark">{{ $user->registrations()->where('certificate_generated', true)->count() }}</p>
                    <p class="text-[11px] text-hmti-gray">Sertifikat</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Form --}}
    <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-5">
            <h3 class="font-bold text-hmti-dark">Edit Informasi</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="label">Nama Lengkap <span class="text-hmti-red">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input @error('name') border-hmti-red @enderror" required>
                    @error('name')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">NIM</label>
                    <input type="text" value="{{ $user->nim }}" class="input bg-gray-50 cursor-not-allowed" readonly disabled>
                    <p class="text-xs text-hmti-gray mt-1">NIM tidak dapat diubah.</p>
                </div>

                <div>
                    <label class="label">Email</label>
                    <input type="email" value="{{ $user->email }}" class="input bg-gray-50 cursor-not-allowed" readonly disabled>
                </div>

                <div>
                    <label class="label">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="input @error('phone') border-hmti-red @enderror" placeholder="+62 ...">
                    @error('phone')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="label">Divisi</label>
                    <select name="division" class="input">
                        <option value="">-- Pilih Divisi --</option>
                        @foreach(['chairman' => 'Ketua', 'secretary' => 'Sekretaris', 'treasury' => 'Bendahara', 'education' => 'Pendidikan', 'research' => 'Riset', 'public_relations' => 'Humas', 'creative_media' => 'Media Kreatif'] as $val => $label)
                            <option value="{{ $val }}" {{ old('division', $user->division) === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label">Angkatan</label>
                    <input type="text" value="{{ $user->generation }}" class="input bg-gray-50 cursor-not-allowed" readonly disabled>
                </div>
            </div>

            {{-- Avatar upload --}}
            <div>
                <label class="label">Foto Profil</label>
                <div class="flex items-center gap-4">
                    <img src="{{ $user->avatar_url }}" id="avatar-preview-form"
                         class="w-16 h-16 rounded-xl object-cover border border-gray-200">
                    <div>
                        <input type="file" name="avatar" id="avatar-input" accept="image/*" class="hidden"
                               onchange="previewAvatar(event)">
                        <label for="avatar-input" class="btn-outline cursor-pointer text-sm">Pilih Foto</label>
                        <p class="text-xs text-hmti-gray mt-1">JPG, PNG, WEBP. Maks 2MB.</p>
                    </div>
                </div>
                @error('avatar')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Change password --}}
            <div class="pt-4 border-t border-gray-100">
                <h4 class="font-semibold text-sm text-hmti-dark mb-3">Ganti Password <span class="text-xs font-normal text-hmti-gray">(kosongkan jika tidak ingin ganti)</span></h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="label">Password Baru</label>
                        <input type="password" name="password" class="input @error('password') border-hmti-red @enderror" placeholder="Min. 8 karakter">
                        @error('password')<p class="text-xs text-hmti-red mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="input" placeholder="Ulangi password">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function previewAvatar(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('avatar-preview').src = e.target.result;
        document.getElementById('avatar-preview-form').src = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>
@endpush
@endsection
