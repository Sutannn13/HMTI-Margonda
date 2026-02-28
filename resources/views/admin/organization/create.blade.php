@extends('layouts.admin')
@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota Organisasi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="relative rounded-2xl p-6 overflow-hidden" style="background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.1);">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
        <div class="flex items-center justify-between mb-6 pb-4" style="border-bottom: 1px solid rgba(255,255,255,0.06);">
            <h3 class="text-lg font-semibold text-white">Form Tambah Anggota</h3>
            <a href="{{ route('admin.organization.index') }}" class="text-sm text-hmti-yellow hover:text-white transition-colors">← Kembali</a>
        </div>

        <form method="POST" action="{{ route('admin.organization.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="name">Nama Lengkap *</label>
                    <input type="text" name="name" id="name" class="input w-full" value="{{ old('name') }}" required style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    @error('name') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="nim">NIM</label>
                    <input type="text" name="nim" id="nim" class="input w-full" value="{{ old('nim') }}" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    @error('nim') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="division">Divisi *</label>
                    <select name="division" id="division" class="input w-full" required style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                        <option value="">Pilih Divisi</option>
                        @foreach(\App\Models\OrganizationMember::DIVISIONS as $key => $label)
                            <option value="{{ $key }}" {{ old('division') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('division') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="position">Jabatan *</label>
                    <select name="position" id="position" class="input w-full" required style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                        <option value="">Pilih Jabatan</option>
                        @foreach(\App\Models\OrganizationMember::POSITIONS as $key => $label)
                            <option value="{{ $key }}" {{ old('position') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('position') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="phone">No. Telepon</label>
                    <input type="text" name="phone" id="phone" class="input w-full" value="{{ old('phone') }}" placeholder="08xxx" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    @error('phone') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="email">Email</label>
                    <input type="email" name="email" id="email" class="input w-full" value="{{ old('email') }}" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                    @error('email') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="sort_order">Urutan Tampil</label>
                <input type="number" name="sort_order" id="sort_order" class="input w-32" value="{{ old('sort_order', 0) }}" min="0" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                <p class="text-xs text-blue-300/40 mt-1">Semakin kecil angka, semakin di atas posisinya.</p>
            </div>

            <div>
                <label class="text-xs font-semibold text-blue-300/60 uppercase tracking-wider mb-1 block" for="avatar">Foto (opsional)</label>
                <input type="file" name="avatar" id="avatar" class="input w-full" accept="image/*" style="background: rgba(255,255,255,0.06); border-color: rgba(255,255,255,0.12); color: #f1f5f9;">
                @error('avatar') <p class="mt-1 text-xs text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4" style="border-top: 1px solid rgba(255,255,255,0.06);">
                <button type="submit" class="btn-primary btn-shiny">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan
                </button>
                <a href="{{ route('admin.organization.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white/70 bg-white/10 border border-white/15 hover:bg-white/20 transition-colors">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
