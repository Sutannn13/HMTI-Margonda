<?php

namespace App\Events;

use App\Models\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public Event $event,
        public string $action = 'updated',
    ) {}

    public function broadcastOn(): Channel
    {
        return new Channel('events');
    }

    public function broadcastWith(): array
    {
        return [
            'action' => $this->action,
            'event' => [
                'id' => $this->event->id,
                'title' => $this->event->title,
                'type' => $this->event->type,
                'status' => $this->event->status,
                'start_date' => $this->event->start_date->format('d M Y H:i'),
                'location' => $this->event->location,
            ],
        ];
    }
}
