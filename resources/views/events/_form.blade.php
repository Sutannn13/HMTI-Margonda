{{-- Shared form partial for event create/edit --}}
<div class="space-y-4">
    <div>
        <label class="label">Judul Event</label>
        <input type="text" name="title" value="{{ old('title', $event?->title) }}" class="input" required>
        @error('title') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="label">Deskripsi</label>
        <textarea name="description" rows="4" class="input" required>{{ old('description', $event?->description) }}</textarea>
        @error('description') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="label">Tipe</label>
            <select name="type" class="input" required>
                @foreach(['seminar' => 'Seminar', 'workshop' => 'Workshop', 'meeting' => 'Rapat', 'competition' => 'Kompetisi', 'social' => 'Sosial'] as $val => $label)
                    <option value="{{ $val }}" {{ old('type', $event?->type) === $val ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="label">Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $event?->location) }}" class="input" required>
        </div>
        <div>
            <label class="label">Mulai</label>
            <input type="datetime-local" name="start_date" value="{{ old('start_date', $event?->start_date?->format('Y-m-d\TH:i')) }}" class="input" required>
        </div>
        <div>
            <label class="label">Selesai</label>
            <input type="datetime-local" name="end_date" value="{{ old('end_date', $event?->end_date?->format('Y-m-d\TH:i')) }}" class="input" required>
        </div>
        <div>
            <label class="label">Maks. Peserta</label>
            <input type="number" name="max_participants" value="{{ old('max_participants', $event?->max_participants) }}" class="input" placeholder="Kosongkan = unlimited" min="1">
        </div>
        <div>
            <label class="label">Poster</label>
            <input type="file" name="poster" class="input" accept="image/*">
        </div>
    </div>
</div>
