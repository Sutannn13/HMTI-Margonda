<?php

namespace App\Console\Commands;

use App\Events\AnnouncementPosted;
use App\Events\ChatMessageSent;
use App\Events\EventUpdated;
use App\Models\Announcement;
use App\Models\ChatMessage;
use App\Models\Event;
use App\Models\User;
use Illuminate\Console\Command;

class TestWebSocket extends Command
{
    protected $signature = 'hmti:test-ws {type=all : Type of event to broadcast (announcement|chat|event|all)}';
    protected $description = 'Broadcast test WebSocket events via Laravel Reverb';

    public function handle(): int
    {
        $type = $this->argument('type');
        $admin = User::where('role', 'admin')->first();

        if (! $admin) {
            $this->error('No admin user found. Run migrations & seeder first.');
            return self::FAILURE;
        }

        $this->info("Broadcasting test events via Reverb...\n");

        if (in_array($type, ['announcement', 'all'])) {
            $announcement = Announcement::create([
                'user_id' => $admin->id,
                'title'   => '[TEST] Pengumuman Percobaan WebSocket',
                'body'    => 'Ini adalah pengumuman percobaan dari artisan command pada ' . now()->format('H:i:s'),
                'priority' => 'normal',
            ]);
            broadcast(new AnnouncementPosted($announcement))->toOthers();
            $this->info('✓ AnnouncementPosted broadcasted on channel "announcements"');
        }

        if (in_array($type, ['chat', 'all'])) {
            $message = ChatMessage::create([
                'user_id' => $admin->id,
                'message' => '[TEST] Pesan percobaan WebSocket — ' . now()->format('H:i:s'),
            ]);
            broadcast(new ChatMessageSent($message))->toOthers();
            $this->info('✓ ChatMessageSent broadcasted on channel "chat"');
        }

        if (in_array($type, ['event', 'all'])) {
            $event = Event::latest()->first();
            if ($event) {
                broadcast(new EventUpdated($event, 'updated'))->toOthers();
                $this->info('✓ EventUpdated broadcasted on channel "events"');
            } else {
                $this->warn('⚠ No events found to broadcast');
            }
        }

        $this->newLine();
        $this->info('Done! Check your browser console for incoming WebSocket messages.');

        return self::SUCCESS;
    }
}
