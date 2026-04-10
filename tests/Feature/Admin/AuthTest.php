<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
    }

    public function test_guest_cannot_access_admin_leaders(): void
    {
        $this->get('/admin/leaders')->assertRedirect('/login');
    }

    public function test_guest_cannot_access_admin_sections(): void
    {
        $this->get('/admin/sections')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
             ->get('/admin/dashboard')
             ->assertStatus(200);
    }

    public function test_valid_login_redirects_to_dashboard(): void
    {
        $user = User::factory()->create([
            'email'    => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'email'    => 'admin@test.com',
            'password' => 'password',
        ])->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_login_fails(): void
    {
        User::factory()->create([
            'email'    => 'admin@test.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'email'    => 'admin@test.com',
            'password' => 'wrong-password',
        ])->assertSessionHasErrors();
    }
}
