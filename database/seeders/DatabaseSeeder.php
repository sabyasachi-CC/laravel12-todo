<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->admin()->create(['first_name' => 'System', 'last_name' => 'Admin', 'email' => 'admin@example.com', 'password' => 'password']);
        $user = User::factory()->create(['first_name' => 'Demo', 'last_name' => 'User', 'email' => 'user@example.com', 'password' => 'password']);
        Todo::factory()->count(5)->for($user)->create();
        User::factory()->count(3)->create()->each(fn (User $u) => Todo::factory()->count(3)->for($u)->create());
    }
}
