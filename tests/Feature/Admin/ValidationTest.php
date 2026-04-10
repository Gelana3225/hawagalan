<?php

namespace Tests\Feature\Admin;

use App\Models\Leader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    public function test_leader_name_is_required(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/leaders', [
                 'title' => 'Some Title',
             ])
             ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('leaders', 0);
    }

    public function test_leader_title_is_required(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/leaders', [
                 'name' => 'Some Name',
             ])
             ->assertSessionHasErrors('title');

        $this->assertDatabaseCount('leaders', 0);
    }

    public function test_service_name_is_required(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/services', [
                 'description' => 'Some description',
             ])
             ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('services', 0);
    }

    public function test_farming_item_label_is_required(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/farming', [
                 'alt_text' => 'Some alt text',
             ])
             ->assertSessionHasErrors('label');

        $this->assertDatabaseCount('farming_items', 0);
    }

    public function test_tourism_attraction_name_is_required(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/tourism', [
                 'description' => 'Some description',
             ])
             ->assertSessionHasErrors('name');

        $this->assertDatabaseCount('tourism_attractions', 0);
    }

    public function test_news_post_title_is_required(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/news', [
                 'body' => 'Some body text',
             ])
             ->assertSessionHasErrors('title');

        $this->assertDatabaseCount('news_posts', 0);
    }

    public function test_news_post_body_is_required(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/news', [
                 'title' => 'Some title',
             ])
             ->assertSessionHasErrors('body');

        $this->assertDatabaseCount('news_posts', 0);
    }

    public function test_leader_name_max_length_enforced(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/leaders', [
                 'name'  => str_repeat('a', 256),
                 'title' => 'Title',
             ])
             ->assertSessionHasErrors('name');
    }
}
