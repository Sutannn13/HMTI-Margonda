@php $layout = auth()->check() && auth()->user()->hasElevatedAccess() ? 'layouts.app' : 'layouts.member'; @endphp
@extends($layout)
@section('title', 'Chat Room')
@section('page-title', 'Chat Room HMTI')

@section('content')
<div class="h-[calc(100vh-10rem)]" x-data="chatRoom()" x-init="init()">
    <div class="card h-full flex flex-col !p-0 overflow-hidden">
        {{-- Chat Header --}}
        <div class="px-4 py-3 border-b border-gray-200 bg-white flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-hmti-blue flex items-center justify-center">
                    <svg class="w-5 h-5 text-hmti-yellow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold text-hmti-dark text-sm">Ruang Obrolan HMTI</h3>
                    <p class="text-xs text-hmti-gray">Semua anggota dapat mengobrol di sini</p>
                </div>
            </div>
            <span class="badge-green text-xs" x-show="connected">
                <span class="w-2 h-2 rounded-full bg-green-500 inline-block mr-1 animate-pulse"></span> Live
            </span>
        </div>

        {{-- Messages --}}
        <div class="flex-1 overflow-y-auto p-4 space-y-3" x-ref="messagesContainer" id="chat-messages">
            {{-- Load More --}}
            <div class="text-center" x-show="hasMore">
                <button @click="loadMore()" class="text-xs text-hmti-blue hover:underline" :disabled="loadingMore">
                    <span x-show="!loadingMore">Muat pesan lama</span>
                    <span x-show="loadingMore">Memuat...</span>
                </button>
            </div>

            {{-- Server-rendered messages --}}
            @foreach($messages as $msg)
                <div class="flex gap-3 {{ $msg->user_id === auth()->id() ? 'flex-row-reverse' : '' }}">
                    @if($msg->type === 'system')
                        <div class="w-full text-center">
                            <span class="text-xs text-hmti-gray italic">{{ $msg->user->name }} {{ $msg->message }}</span>
                        </div>
                    @else
                        <img src="{{ $msg->user->avatar_url }}" class="w-8 h-8 rounded-full shrink-0" alt="">
                        <div class="max-w-[70%] {{ $msg->user_id === auth()->id() ? 'bg-hmti-blue text-white' : 'bg-gray-100 text-hmti-dark' }} rounded-2xl px-4 py-2.5 {{ $msg->user_id === auth()->id() ? 'rounded-br-sm' : 'rounded-bl-sm' }}">
                            <div class="flex items-center gap-2 mb-0.5">
                                <span class="text-xs font-semibold {{ $msg->user_id === auth()->id() ? 'text-hmti-yellow' : 'text-hmti-blue' }}">
                                    {{ $msg->user->name }}
                                </span>
                                @if($msg->user->role === 'admin')
                                    <span class="text-[9px] px-1 py-0.5 rounded {{ $msg->user_id === auth()->id() ? 'bg-hmti-yellow/20 text-hmti-yellow' : 'bg-hmti-red/10 text-hmti-red' }}">Admin</span>
                                @endif
                            </div>
                            <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
                            <p class="text-[10px] mt-1 {{ $msg->user_id === auth()->id() ? 'text-blue-200' : 'text-hmti-gray' }}">
                                {{ $msg->created_at->format('H:i') }}
                            </p>
                        </div>
                    @endif
                </div>
            @endforeach

            {{-- Real-time messages --}}
            <template x-for="msg in newMessages" :key="msg.id">
                <div class="flex gap-3" :class="msg.user.id == currentUserId ? 'flex-row-reverse' : ''">
                    <template x-if="msg.type === 'system'">
                        <div class="w-full text-center">
                            <span class="text-xs text-hmti-gray italic" x-text="msg.user.name + ' ' + msg.message"></span>
                        </div>
                    </template>
                    <template x-if="msg.type !== 'system'">
                        <div class="contents">
                            <img :src="msg.user.avatar_url" class="w-8 h-8 rounded-full shrink-0" alt="">
                            <div class="max-w-[70%] rounded-2xl px-4 py-2.5"
                                 :class="msg.user.id == currentUserId ? 'bg-hmti-blue text-white rounded-br-sm' : 'bg-gray-100 text-hmti-dark rounded-bl-sm'">
                                <div class="flex items-center gap-2 mb-0.5">
                                    <span class="text-xs font-semibold"
                                          :class="msg.user.id == currentUserId ? 'text-hmti-yellow' : 'text-hmti-blue'"
                                          x-text="msg.user.name"></span>
                                    <template x-if="msg.user.role === 'admin'">
                                        <span class="text-[9px] px-1 py-0.5 rounded"
                                              :class="msg.user.id == currentUserId ? 'bg-hmti-yellow/20 text-hmti-yellow' : 'bg-hmti-red/10 text-hmti-red'">Admin</span>
                                    </template>
                                </div>
                                <p class="text-sm leading-relaxed" x-text="msg.message"></p>
                                <p class="text-[10px] mt-1"
                                   :class="msg.user.id == currentUserId ? 'text-blue-200' : 'text-hmti-gray'"
                                   x-text="msg.timestamp"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        {{-- Input Area --}}
        <div class="border-t border-gray-200 bg-white p-3">
            <form @submit.prevent="sendMessage()" class="flex gap-2">
                <input type="text" x-model="messageText"
                       class="input flex-1" placeholder="Ketik pesan..."
                       @keydown.enter.prevent="sendMessage()"
                       :disabled="sending" maxlength="1000">
                <button type="submit" class="btn-primary" :disabled="sending || !messageText.trim()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function chatRoom() {
    return {
        currentUserId: {{ auth()->id() }},
        newMessages: [],
        messageText: '',
        sending: false,
        connected: false,
        hasMore: true,
        loadingMore: false,

        init() {
            // Scroll to bottom
            this.$nextTick(() => this.scrollToBottom());

            if (window.Echo) {
                this.connected = true;
                window.Echo.channel('chat').listen('ChatMessageSent', (e) => {
                    this.newMessages.push(e);
                    this.$nextTick(() => this.scrollToBottom());
                });
            }
        },

        async sendMessage() {
            if (!this.messageText.trim() || this.sending) return;
            this.sending = true;
            try {
                const res = await axios.post('{{ route("chat.store") }}', { message: this.messageText });
                if (res.data.success) {
                    this.newMessages.push(res.data.message);
                    this.messageText = '';
                    this.$nextTick(() => this.scrollToBottom());
                }
            } catch (e) { console.error(e); }
            this.sending = false;
        },

        async loadMore() {
            this.loadingMore = true;
            const firstId = document.querySelector('#chat-messages [data-id]')?.dataset?.id;
            try {
                const res = await axios.get('{{ route("chat.load-more") }}', { params: { before: firstId } });
                if (res.data.messages.length === 0) this.hasMore = false;
            } catch (e) { console.error(e); }
            this.loadingMore = false;
        },

        scrollToBottom() {
            const container = this.$refs.messagesContainer;
            if (container) container.scrollTop = container.scrollHeight;
        },
    };
}
</script>
@endpush
@endsection
