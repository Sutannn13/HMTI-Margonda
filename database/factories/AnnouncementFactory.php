<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(6),
            'body' => fake()->paragraphs(rand(2, 5), true),
            'priority' => fake()->randomElement(['low', 'normal', 'normal', 'high', 'urgent']),
            'is_pinned' => fake()->boolean(15),
        ];
    }

    public function urgent(): static
    {
        return $this->state(fn () => [
            'priority' => 'urgent',
            'is_pinned' => true,
        ]);
    }
}
