<?php

namespace Tests\Feature\Todos;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_todo(): void
    {
        $u = User::factory()->create();
        $this->actingAs($u)->post(route('todos.store'), ['title' => 'Learn Laravel', 'description' => 'Study policies'])->assertRedirect(route('todos.index'));
        $this->assertDatabaseHas('todos', ['user_id' => $u->id, 'title' => 'Learn Laravel']);
    }

    public function test_user_cannot_update_another_users_todo(): void
    {
        $a = User::factory()->create();
        $b = User::factory()->create();
        $todo = Todo::factory()->for($b)->create();
        $this->actingAs($a)->put(route('todos.update', $todo), ['title' => 'Hijack'])->assertForbidden();
        $this->assertDatabaseHas('todos', ['id' => $todo->id, 'title' => $todo->title]);
    }

    public function test_user_can_delete_own_todo(): void
    {
        $u = User::factory()->create();
        $todo = Todo::factory()->for($u)->create();
        $this->actingAs($u)->delete(route('todos.destroy', $todo))->assertRedirect(route('todos.index'));
        $this->assertSoftDeleted($todo);
    }
}
