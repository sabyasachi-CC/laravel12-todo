<?php

namespace Tests\Feature\Api;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_todo_via_api(): void
    {
        $u = User::factory()->create();
        $token = $u->createToken('test')->plainTextToken;
        $r = $this->withToken($token)->postJson('/api/v1/todos', ['title' => 'API Todo', 'description' => 'Test']);
        $r->assertCreated()->assertJsonPath('success', true)->assertJsonPath('data.title', 'API Todo');
    }

    public function test_user_cannot_access_another_users_todo_via_api(): void
    {
        $a = User::factory()->create();
        $b = User::factory()->create();
        $todo = Todo::factory()->for($b)->create();
        $token = $a->createToken('test')->plainTextToken;
        $this->withToken($token)->getJson('/api/v1/todos/'.$todo->id)->assertForbidden();
    }
}
