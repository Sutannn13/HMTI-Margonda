@extends('layouts.app')
@section('title', 'Buat Event')
@section('page-title', 'Buat Event Baru')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card">
        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @include('events._form', ['event' => null])
            <div class="flex gap-3 pt-4">
                <button type="submit" class="btn-primary">Buat Event</button>
                <a href="{{ route('events.index') }}" class="btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
