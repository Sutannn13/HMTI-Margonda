@extends('layouts.admin')
@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota Organisasi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <div class="card-header">
            <h3 class="text-lg font-semibold text-hmti-dark">Form Tambah Anggota</h3>
            <a href="{{ route('admin.organization.index') }}" class="text-sm text-hmti-blue hover:underline">← Kembali</a>
        </div>

        <form method="POST" action="{{ route('admin.organization.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="name">Nama Lengkap *</label>
                    <input type="text" name="name" id="name" class="input" value="{{ old('name') }}" required>
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label" for="nim">NIM</label>
                    <input type="text" name="nim" id="nim" class="input" value="{{ old('nim') }}">
                    @error('nim') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="division">Divisi *</label>
                    <select name="division" id="division" class="input" required>
                        <option value="">Pilih Divisi</option>
                        @foreach(\App\Models\OrganizationMember::DIVISIONS as $key => $label)
                            <option value="{{ $key }}" {{ old('division') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('division') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label" for="position">Jabatan *</label>
                    <select name="position" id="position" class="input" required>
                        <option value="">Pilih Jabatan</option>
                        @foreach(\App\Models\OrganizationMember::POSITIONS as $key => $label)
                            <option value="{{ $key }}" {{ old('position') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('position') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="phone">No. Telepon</label>
                    <input type="text" name="phone" id="phone" class="input" value="{{ old('phone') }}" placeholder="08xxx">
                    @error('phone') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="label" for="email">Email</label>
                    <input type="email" name="email" id="email" class="input" value="{{ old('email') }}">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="label" for="sort_order">Urutan Tampil</label>
                <input type="number" name="sort_order" id="sort_order" class="input w-32" value="{{ old('sort_order', 0) }}" min="0">
                <p class="text-xs text-hmti-gray mt-1">Semakin kecil angka, semakin di atas posisinya.</p>
            </div>

            <div>
                <label class="label" for="avatar">Foto (opsional)</label>
                <input type="file" name="avatar" id="avatar" class="input" accept="image/*">
                @error('avatar') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
                <a href="{{ route('admin.organization.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
