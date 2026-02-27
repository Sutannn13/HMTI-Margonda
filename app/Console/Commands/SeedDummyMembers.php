<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SeedDummyMembers extends Command
{
    protected $signature = 'hmti:seed-members {count=10 : Number of dummy members to create}';
    protected $description = 'Seed dummy HMTI members for development/testing';

    public function handle(): int
    {
        $count = (int) $this->argument('count');

        $this->info("Creating {$count} dummy members...");

        $bar = $this->output->createProgressBar($count);
        $bar->start();

        $members = User::factory()->count($count)->create();
        $bar->finish();

        $this->newLine(2);
        $this->info("✓ Successfully created {$count} dummy members.");
        $this->newLine();

        $this->table(
            ['Name', 'NIM', 'Role', 'Division', 'Status'],
            $members->take(10)->map(fn ($m) => [
                $m->name,
                $m->nim,
                $m->role,
                ucfirst(str_replace('_', ' ', $m->division)),
                $m->status,
            ])
        );

        if ($count > 10) {
            $this->comment("... and " . ($count - 10) . " more");
        }

        return self::SUCCESS;
    }
}
