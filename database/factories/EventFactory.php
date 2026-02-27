<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $title = fake()->sentence(4);
        $start = fake()->dateTimeBetween('-2 months', '+3 months');
        $end = (clone $start)->modify('+' . rand(2, 8) . ' hours');

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'description' => fake()->paragraphs(3, true),
            'type' => fake()->randomElement(['seminar', 'workshop', 'meeting', 'competition', 'social']),
            'location' => fake()->randomElement([
                'Aula UBSI Margonda',
                'Lab Komputer Lt. 3',
                'Ruang Seminar UBSI',
                'Online via Zoom',
                'Gedung Serbaguna',
            ]),
            'start_date' => $start,
            'end_date' => $end,
            'max_participants' => fake()->optional(0.7)->numberBetween(30, 200),
            'poster_path' => null,
            'status' => fake()->randomElement(['upcoming', 'ongoing', 'completed']),
            'created_by' => User::factory(),
        ];
    }

    public function upcoming(): static
    {
        return $this->state(fn () => [
            'status' => 'upcoming',
            'start_date' => fake()->dateTimeBetween('+1 day', '+3 months'),
        ]);
    }

    public function completed(): static
    {
        return $this->state(fn () => [
            'status' => 'completed',
            'start_date' => fake()->dateTimeBetween('-3 months', '-1 day'),
        ]);
    }
}
