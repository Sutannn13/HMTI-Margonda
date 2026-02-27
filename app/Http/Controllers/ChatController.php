<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::with('user')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        return view('chat.index', compact('messages'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $chatMessage = ChatMessage::create([
            'user_id' => Auth::id(),
            'message' => $validated['message'],
            'type' => 'text',
        ]);

        $chatMessage->load('user');

        broadcast(new ChatMessageSent($chatMessage))->toOthers();

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $chatMessage->id,
                'message' => $chatMessage->message,
                'type' => $chatMessage->type,
                'user' => [
                    'id' => $chatMessage->user->id,
                    'name' => $chatMessage->user->name,
                    'avatar_url' => $chatMessage->user->avatar_url,
                    'role' => $chatMessage->user->role,
                ],
                'created_at' => $chatMessage->created_at->diffForHumans(),
                'timestamp' => $chatMessage->created_at->format('H:i'),
            ],
        ]);
    }

    public function loadMore(Request $request): JsonResponse
    {
        $before = $request->get('before');

        $messages = ChatMessage::with('user')
            ->when($before, fn ($q) => $q->where('id', '<', $before))
            ->latest()
            ->take(30)
            ->get()
            ->reverse()
            ->values()
            ->map(fn ($m) => [
                'id' => $m->id,
                'message' => $m->message,
                'type' => $m->type,
                'user' => [
                    'id' => $m->user->id,
                    'name' => $m->user->name,
                    'avatar_url' => $m->user->avatar_url,
                    'role' => $m->user->role,
                ],
                'created_at' => $m->created_at->diffForHumans(),
                'timestamp' => $m->created_at->format('H:i'),
            ]);

        return response()->json(['messages' => $messages]);
    }
}
