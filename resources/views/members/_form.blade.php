{{-- Shared form partial for member create/edit --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="label">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name', $member?->name) }}" class="input" required>
        @error('name') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label">NIM</label>
        <input type="text" name="nim" value="{{ old('nim', $member?->nim) }}" class="input" required>
        @error('nim') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label">Email</label>
        <input type="email" name="email" value="{{ old('email', $member?->email) }}" class="input" required>
        @error('email') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label">No. Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $member?->phone) }}" class="input" placeholder="08xx">
        @error('phone') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="label">Role</label>
        <select name="role" class="input" required>
            <option value="member" {{ old('role', $member?->role) === 'member' ? 'selected' : '' }}>Anggota</option>
            <option value="coordinator" {{ old('role', $member?->role) === 'coordinator' ? 'selected' : '' }}>Koordinator</option>
            <option value="admin" {{ old('role', $member?->role) === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
    </div>
    <div>
        <label class="label">Divisi</label>
        <select name="division" class="input">
            <option value="">-- Pilih Divisi --</option>
            @foreach(['chairman' => 'Ketua', 'secretary' => 'Sekretaris', 'treasury' => 'Bendahara', 'education' => 'Pendidikan', 'research' => 'Penelitian', 'public_relations' => 'Humas', 'creative_media' => 'Media Kreatif'] as $val => $label)
                <option value="{{ $val }}" {{ old('division', $member?->division) === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="label">Angkatan</label>
        <input type="text" name="generation" value="{{ old('generation', $member?->generation) }}" class="input" placeholder="2024" maxlength="4">
    </div>
    <div>
        <label class="label">Status</label>
        <select name="status" class="input" required>
            <option value="active" {{ old('status', $member?->status) === 'active' ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ old('status', $member?->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
            <option value="alumni" {{ old('status', $member?->status) === 'alumni' ? 'selected' : '' }}>Alumni</option>
        </select>
    </div>
    <div class="sm:col-span-2">
        <label class="label">Foto Profil</label>
        <input type="file" name="avatar" class="input" accept="image/*">
        @error('avatar') <p class="mt-1 text-xs text-hmti-red">{{ $message }}</p> @enderror
    </div>
</div>
