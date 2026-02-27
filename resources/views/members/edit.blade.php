@extends('layouts.app')
@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <form method="POST" action="{{ route('members.update', $member) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('members._form', ['member' => $member])

            <div>
                <label class="label">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="input" placeholder="Password baru">
                @error('password') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="btn-primary">Perbarui</button>
                <a href="{{ route('members.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
