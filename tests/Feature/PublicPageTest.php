<?php

namespace Tests\Feature;

use App\Models\FarmingItem;
use App\Models\Leader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_public_routes_return_200(): void
    {
        foreach (['/', '/farming', '/tourism', '/biography'] as $uri) {
            $this->get($uri)->assertStatus(200);
        }
    }

    public function test_home_page_renders(): void
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_home_page_renders_leaders_from_db(): void
    {
        Leader::factory()->create(['name' => 'Test Leader', 'is_visible' => true]);

        $this->get('/')->assertSee('Test Leader');
    }

    public function test_farming_page_renders_items_from_db(): void
    {
        FarmingItem::factory()->create(['label' => 'Buna Test', 'is_visible' => true]);

        $this->get('/farming')->assertSee('Buna Test');
    }

    public function test_hidden_leaders_not_shown(): void
    {
        Leader::factory()->create(['name' => 'Hidden Leader', 'is_visible' => false]);

        $this->get('/')->assertDontSee('Hidden Leader');
    }

    public function test_biography_page_renders(): void
    {
        $this->get('/biography')->assertStatus(200);
    }

    public function test_tourism_page_renders(): void
    {
        $this->get('/tourism')->assertStatus(200);
    }
}
