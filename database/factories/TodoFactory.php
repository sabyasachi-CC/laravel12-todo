<?php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition(): array
    {
        return ['user_id' => User::factory(), 'title' => fake()->sentence(4), 'description' => fake()->optional()->paragraph(), 'status' => true];
    }

    public function inactive(): static
    {
        return $this->state(fn () => ['status' => false]);
    }
}
