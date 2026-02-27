<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        $divisions = ['chairman', 'secretary', 'treasury', 'education', 'research', 'public_relations', 'creative_media'];
        $generations = ['2022', '2023', '2024', '2025', '2026'];

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'nim' => fake()->unique()->numerify('########'),
            'phone' => fake()->phoneNumber(),
            'avatar' => null,
            'role' => fake()->randomElement(['member', 'member', 'member', 'coordinator', 'admin']),
            'division' => fake()->randomElement($divisions),
            'generation' => fake()->randomElement($generations),
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive', 'alumni']),
            'joined_at' => fake()->dateTimeBetween('-3 years', 'now'),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn () => [
            'role' => 'admin',
            'division' => 'chairman',
        ]);
    }

    public function coordinator(): static
    {
        return $this->state(fn () => [
            'role' => 'coordinator',
        ]);
    }
}
