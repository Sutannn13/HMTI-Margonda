@extends('layouts.app')
@section('title', 'Edit Event')
@section('page-title', 'Edit Event')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <form method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            @include('events._form', ['event' => $event])
            <div>
                <label class="label">Status</label>
                <select name="status" class="input" required>
                    @foreach(['upcoming', 'ongoing', 'completed', 'cancelled'] as $s)
                        <option value="{{ $s }}" {{ old('status', $event->status) === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-3 pt-4">
                <button type="submit" class="btn-primary">Perbarui</button>
                <a href="{{ route('events.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
