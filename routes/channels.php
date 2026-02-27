<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Public channels (no auth required for listening)
// 'announcements' – public channel
// 'chat' – public channel
// 'events' – public channel
