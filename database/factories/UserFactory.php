<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return ['first_name' => fake()->firstName(), 'last_name' => fake()->lastName(), 'email' => fake()->unique()->safeEmail(), 'phone' => fake()->optional()->phoneNumber(), 'address' => fake()->optional()->address(), 'status' => true, 'type' => 'user', 'password' => 'password'];
    }

    public function admin(): static
    {
        return $this->state(fn () => ['type' => 'admin']);
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['status' => false]);
    }
}
