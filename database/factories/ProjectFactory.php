<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-6 months', '+1 month');

        return [
            'name' => fake()->randomElement([
                'Website HMTI Redesign',
                'Sistem Informasi Anggota',
                'Aplikasi Absensi Digital',
                'Platform E-Learning Internal',
                'Bot Telegram HMTI',
                'Portal Berita Kampus',
                'Sistem Voting Online',
                'Dashboard Keuangan',
            ]) . ' ' . fake()->randomNumber(2),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['planning', 'in_progress', 'completed', 'on_hold']),
            'lead_id' => User::factory(),
            'start_date' => $start,
            'end_date' => fake()->optional(0.6)->dateTimeBetween($start, '+6 months'),
        ];
    }
}
