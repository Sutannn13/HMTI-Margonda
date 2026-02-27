@extends('layouts.app')
@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('members._form', ['member' => null])

            <div>
                <label class="label">Password</label>
                <input type="password" name="password" class="input" placeholder="Minimal 8 karakter" required>
                @error('password') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="btn-primary">Simpan</button>
                <a href="{{ route('members.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
