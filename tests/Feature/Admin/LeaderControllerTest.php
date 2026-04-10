<?php

namespace Tests\Feature\Admin;

use App\Models\Leader;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LeaderControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    public function test_admin_can_view_leaders_index(): void
    {
        $this->actingAs($this->admin)
             ->get('/admin/leaders')
             ->assertStatus(200);
    }

    public function test_admin_can_create_leader(): void
    {
        $this->actingAs($this->admin)
             ->post('/admin/leaders', [
                 'name'  => 'New Leader',
                 'title' => 'Head of Department',
             ])
             ->assertRedirect('/admin/leaders');

        $this->assertDatabaseHas('leaders', ['name' => 'New Leader']);
    }

    public function test_admin_can_update_leader(): void
    {
        $leader = Leader::factory()->create(['name' => 'Old Name']);

        $this->actingAs($this->admin)
             ->put("/admin/leaders/{$leader->id}", [
                 'name'  => 'Updated Name',
                 'title' => $leader->title,
             ])
             ->assertRedirect('/admin/leaders');

        $this->assertDatabaseHas('leaders', ['name' => 'Updated Name']);
    }

    public function test_admin_can_delete_leader(): void
    {
        $leader = Leader::factory()->create();

        $this->actingAs($this->admin)
             ->delete("/admin/leaders/{$leader->id}")
             ->assertRedirect('/admin/leaders');

        $this->assertDatabaseMissing('leaders', ['id' => $leader->id]);
    }

    public function test_admin_can_upload_leader_photo(): void
    {
        Storage::fake('public');

        // Use create() to avoid GD extension requirement
        $file = UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg');

        $this->actingAs($this->admin)
             ->post('/admin/leaders', [
                 'name'  => 'Leader With Photo',
                 'title' => 'Title',
                 'photo' => $file,
             ]);

        $leader = Leader::where('name', 'Leader With Photo')->first();
        $this->assertNotNull($leader);
        $this->assertNotNull($leader->photo);
        Storage::disk('public')->assertExists($leader->photo);
    }

    public function test_deleting_leader_removes_photo(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('photo.jpg', 100, 'image/jpeg');
        $path = $file->store('images', 'public');

        $leader = Leader::factory()->create(['photo' => $path]);

        $this->actingAs($this->admin)
             ->delete("/admin/leaders/{$leader->id}");

        Storage::disk('public')->assertMissing($path);
    }

    public function test_guest_cannot_create_leader(): void
    {
        $this->post('/admin/leaders', [
            'name'  => 'Unauthorized',
            'title' => 'Title',
        ])->assertRedirect('/login');

        $this->assertDatabaseMissing('leaders', ['name' => 'Unauthorized']);
    }
}
