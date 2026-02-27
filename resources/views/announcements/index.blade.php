@php $layout = auth()->check() && auth()->user()->hasElevatedAccess() ? 'layouts.app' : 'layouts.member'; @endphp
@extends($layout)
@section('title', 'Pengumuman')
@section('page-title', 'Papan Pengumuman')

@section('content')
<div class="space-y-4" x-data="announcementBoard()" x-init="init()">
    {{-- Create announcement (admin/coordinator) --}}
    @if(auth()->user()->hasElevatedAccess())
        <div class="card" x-data="{ showForm: false }">
            <button @click="showForm = !showForm" class="btn-secondary w-full sm:w-auto">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Pengumuman
            </button>

            <form x-show="showForm" x-transition @submit.prevent="postAnnouncement" class="mt-4 space-y-3">
                <div>
                    <label class="label">Judul</label>
                    <input type="text" x-model="newAnnouncement.title" class="input" required>
                </div>
                <div>
                    <label class="label">Isi Pengumuman</label>
                    <textarea x-model="newAnnouncement.body" rows="3" class="input" required></textarea>
                </div>
                <div class="flex flex-wrap gap-3">
                    <div>
                        <label class="label">Prioritas</label>
                        <select x-model="newAnnouncement.priority" class="input w-auto">
                            <option value="low">Rendah</option>
                            <option value="normal" selected>Normal</option>
                            <option value="high">Tinggi</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" x-model="newAnnouncement.is_pinned" class="rounded border-gray-300 text-hmti-blue">
                            <span class="text-sm text-hmti-gray">Pin ke atas</span>
                        </label>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary" :disabled="posting">
                        <span x-show="!posting">Kirim</span>
                        <span x-show="posting">Mengirim...</span>
                    </button>
                    <button type="button" @click="showForm = false" class="btn-outline">Batal</button>
                </div>
            </form>
        </div>
    @endif

    {{-- Real-time new announcement indicator --}}
    <template x-if="newItems.length > 0">
        <div class="bg-hmti-yellow/10 border border-hmti-yellow/30 rounded-lg p-3 text-center cursor-pointer"
             @click="showNewItems()">
            <span class="text-sm font-medium text-hmti-yellow-dark" x-text="newItems.length + ' pengumuman baru — klik untuk menampilkan'"></span>
        </div>
    </template>

    {{-- Announcements List --}}
    <div class="space-y-3">
        {{-- Real-time appended items --}}
        <template x-for="item in displayedNewItems" :key="item.id">
            <div class="card border-l-4 animate-pulse-once"
                 :class="{
                    'border-l-hmti-red': item.priority === 'urgent',
                    'border-l-hmti-yellow': item.priority === 'high',
                    'border-l-hmti-blue': item.priority === 'normal',
                    'border-l-gray-300': item.priority === 'low',
                 }">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <img :src="item.author_avatar" class="w-6 h-6 rounded-full" alt="">
                        <span class="text-sm font-medium text-hmti-dark" x-text="item.author"></span>
                        <span class="text-xs text-hmti-gray" x-text="item.created_at"></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <template x-if="item.is_pinned">
                            <span class="text-hmti-yellow" title="Pinned">📌</span>
                        </template>
                        <span class="badge text-[10px]"
                              :class="{
                                'badge-red': item.priority === 'urgent',
                                'badge-yellow': item.priority === 'high',
                                'badge-blue': item.priority === 'normal',
                              }" x-text="item.priority"></span>
                    </div>
                </div>
                <h3 class="font-semibold text-hmti-dark mb-1" x-text="item.title"></h3>
                <p class="text-sm text-hmti-gray whitespace-pre-line" x-text="item.body"></p>
            </div>
        </template>

        {{-- Server-rendered announcements --}}
        @foreach($announcements as $ann)
            <div class="card border-l-4
                {{ $ann->priority === 'urgent' ? 'border-l-hmti-red' :
                   ($ann->priority === 'high' ? 'border-l-hmti-yellow' :
                   ($ann->priority === 'normal' ? 'border-l-hmti-blue' : 'border-l-gray-300')) }}">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-center gap-2">
                        <img src="{{ $ann->author->avatar_url }}" class="w-6 h-6 rounded-full" alt="">
                        <span class="text-sm font-medium text-hmti-dark">{{ $ann->author->name }}</span>
                        <span class="text-xs text-hmti-gray">{{ $ann->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($ann->is_pinned) <span title="Pinned">📌</span> @endif
                        <span class="badge text-[10px]
                            {{ $ann->priority === 'urgent' ? 'badge-red' :
                               ($ann->priority === 'high' ? 'badge-yellow' : 'badge-blue') }}">
                            {{ $ann->priority }}
                        </span>
                        @if(auth()->user()->hasElevatedAccess())
                            <form method="POST" action="{{ route('announcements.destroy', $ann) }}"
                                  x-data @submit.prevent="if(confirm('Hapus pengumuman ini?')) $el.submit()">
                                @csrf @method('DELETE')
                                <button class="text-hmti-gray hover:text-hmti-red text-xs">✕</button>
                            </form>
                        @endif
                    </div>
                </div>
                <h3 class="font-semibold text-hmti-dark mb-1">{{ $ann->title }}</h3>
                <p class="text-sm text-hmti-gray whitespace-pre-line">{{ $ann->body }}</p>
            </div>
        @endforeach
    </div>

    <div class="flex justify-center">{{ $announcements->links() }}</div>
</div>

@push('scripts')
<script>
function announcementBoard() {
    return {
        newItems: [],
        displayedNewItems: [],
        posting: false,
        newAnnouncement: { title: '', body: '', priority: 'normal', is_pinned: false },
        init() {
            if (window.Echo) {
                window.Echo.channel('announcements').listen('AnnouncementPosted', (e) => {
                    this.newItems.push(e);
                });
            }
        },
        showNewItems() {
            this.displayedNewItems = [...this.newItems, ...this.displayedNewItems];
            this.newItems = [];
        },
        async postAnnouncement() {
            this.posting = true;
            try {
                const res = await axios.post('{{ route("announcements.store") }}', this.newAnnouncement);
                if (res.data.success) {
                    this.displayedNewItems.unshift({
                        id: res.data.announcement.id,
                        title: this.newAnnouncement.title,
                        body: this.newAnnouncement.body,
                        priority: this.newAnnouncement.priority,
                        is_pinned: this.newAnnouncement.is_pinned,
                        author: '{{ auth()->user()->name }}',
                        author_avatar: '{{ auth()->user()->avatar_url }}',
                        created_at: 'Baru saja',
                    });
                    this.newAnnouncement = { title: '', body: '', priority: 'normal', is_pinned: false };
                }
            } catch (e) { console.error(e); }
            this.posting = false;
        },
    };
}
</script>
@endpush
@endsection
