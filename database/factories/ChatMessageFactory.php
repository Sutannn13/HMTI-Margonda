<?php

namespace Database\Factories;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChatMessage>
 */
class ChatMessageFactory extends Factory
{
    protected $model = ChatMessage::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'message' => fake()->sentence(rand(3, 15)),
            'type' => 'text',
        ];
    }

    public function system(): static
    {
        return $this->state(fn () => [
            'type' => 'system',
            'message' => fake()->randomElement([
                'bergabung ke ruang obrolan',
                'meninggalkan ruang obrolan',
                'Event baru telah dibuat',
            ]),
        ]);
    }
}
