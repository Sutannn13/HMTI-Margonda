<?php

namespace App\Events;

use App\Models\Announcement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AnnouncementPosted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Announcement $announcement,
    ) {}

    public function broadcastOn(): Channel
    {
        return new Channel('announcements');
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->announcement->id,
            'title' => $this->announcement->title,
            'body' => $this->announcement->body,
            'priority' => $this->announcement->priority,
            'is_pinned' => $this->announcement->is_pinned,
            'author' => $this->announcement->author->name,
            'author_avatar' => $this->announcement->author->avatar_url,
            'created_at' => $this->announcement->created_at->diffForHumans(),
        ];
    }
}
