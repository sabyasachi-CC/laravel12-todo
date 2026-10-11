<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_normal_user_cannot_access_admin(): void
    {
        $u = User::factory()->create();
        $this->actingAs($u)->get(route('admin.users.index'))->assertForbidden();
    }

    public function test_admin_can_access_users(): void
    {
        $u = User::factory()->admin()->create();
        $this->actingAs($u)->get(route('admin.users.index'))->assertOk();
    }
}
