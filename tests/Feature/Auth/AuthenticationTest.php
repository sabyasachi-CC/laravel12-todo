<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(): void
    {
        $r = $this->post(route('register.store'), ['first_name' => 'Jane', 'last_name' => 'Doe', 'email' => 'jane@example.com', 'password' => 'password123', 'password_confirmation' => 'password123']);
        $r->assertRedirect(route('todos.index'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'jane@example.com']);
    }

    public function test_user_can_login(): void
    {
        $u = User::factory()->create(['email' => 'jane@example.com', 'password' => 'password123']);
        $r = $this->post(route('login.store'), ['email' => $u->email, 'password' => 'password123']);
        $r->assertRedirect(route('todos.index'));
        $this->assertAuthenticatedAs($u);
    }

    public function test_inactive_user_is_rejected(): void
    {
        $u = User::factory()->inactive()->create(['email' => 'inactive@example.com', 'password' => 'password123']);
        $this->post(route('login.store'), ['email' => $u->email, 'password' => 'password123'])->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
