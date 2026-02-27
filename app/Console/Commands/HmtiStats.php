<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Event;
use App\Models\ChatMessage;
use App\Models\Announcement;
use App\Models\Project;
use Illuminate\Console\Command;

class HmtiStats extends Command
{
    protected $signature = 'hmti:stats';
    protected $description = 'Display HMTI system statistics overview';

    public function handle(): int
    {
        $this->newLine();
        $this->info('╔══════════════════════════════════════╗');
        $this->info('║    HMTI UBSI Margonda — Statistics   ║');
        $this->info('╚══════════════════════════════════════╝');
        $this->newLine();

        // Members
        $this->comment('👥 Members');
        $this->table(
            ['Category', 'Count'],
            [
                ['Total Members', User::count()],
                ['Admin', User::where('role', 'admin')->count()],
                ['Coordinator', User::where('role', 'coordinator')->count()],
                ['Member', User::where('role', 'member')->count()],
                ['Active', User::where('status', 'active')->count()],
                ['Inactive', User::where('status', 'inactive')->count()],
                ['Alumni', User::where('status', 'alumni')->count()],
            ]
        );

        // Division breakdown
        $this->comment('🏢 Division Distribution');
        $divisions = User::selectRaw('division, count(*) as total')
            ->groupBy('division')
            ->orderByDesc('total')
            ->get();
        $this->table(
            ['Division', 'Members'],
            $divisions->map(fn ($d) => [ucfirst(str_replace('_', ' ', $d->division)), $d->total])
        );

        // Events
        $this->comment('📅 Events');
        $this->table(
            ['Status', 'Count'],
            [
                ['Total Events', Event::count()],
                ['Upcoming', Event::where('status', 'upcoming')->count()],
                ['Ongoing', Event::where('status', 'ongoing')->count()],
                ['Completed', Event::where('status', 'completed')->count()],
                ['Cancelled', Event::where('status', 'cancelled')->count()],
            ]
        );

        // Other
        $this->table(
            ['Entity', 'Count'],
            [
                ['Announcements', Announcement::count()],
                ['Chat Messages', ChatMessage::count()],
                ['Projects', Project::count()],
                ['Active Projects', Project::whereIn('status', ['planning', 'in_progress'])->count()],
            ]
        );

        return self::SUCCESS;
    }
}
