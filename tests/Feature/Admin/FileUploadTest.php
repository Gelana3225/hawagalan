<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    private function fakeImage(string $name = 'photo.jpg'): UploadedFile
    {
        // Use create() instead of image() to avoid GD extension requirement
        return UploadedFile::fake()->create($name, 100, 'image/jpeg');
    }

    public function test_leader_photo_stored_with_random_name(): void
    {
        Storage::fake('public');

        $file = $this->fakeImage('my-photo.jpg');

        $this->actingAs($this->admin)
             ->post('/admin/leaders', [
                 'name'  => 'Leader',
                 'title' => 'Title',
                 'photo' => $file,
             ]);

        // File should be stored in images/ directory
        $files = Storage::disk('public')->files('images');
        $this->assertCount(1, $files);

        // Stored name should NOT be the original filename
        $this->assertStringNotContainsString('my-photo.jpg', $files[0]);
    }

    public function test_farming_item_image_stored_correctly(): void
    {
        Storage::fake('public');

        $file = $this->fakeImage('crop.jpg');

        $this->actingAs($this->admin)
             ->post('/admin/farming', [
                 'label' => 'Test Crop',
                 'image' => $file,
             ]);

        $files = Storage::disk('public')->files('images');
        $this->assertCount(1, $files);
    }

    public function test_media_upload_stores_file(): void
    {
        Storage::fake('public');

        $file = $this->fakeImage('media.jpg');

        $this->actingAs($this->admin)
             ->post('/admin/media', [
                 'image'    => $file,
                 'alt_text' => 'Test image',
             ]);

        $files = Storage::disk('public')->files('images');
        $this->assertCount(1, $files);

        $this->assertDatabaseHas('media', ['alt_text' => 'Test image']);
    }

    public function test_deleting_media_removes_file(): void
    {
        Storage::fake('public');

        $file = $this->fakeImage('delete-me.jpg');
        $path = $file->store('images', 'public');

        $media = \App\Models\Media::create([
            'filename'  => 'delete-me.jpg',
            'path'      => $path,
            'disk'      => 'public',
            'mime_type' => 'image/jpeg',
            'size'      => 1024,
            'alt_text'  => '',
        ]);

        $this->actingAs($this->admin)
             ->delete("/admin/media/{$media->id}");

        Storage::disk('public')->assertMissing($path);
        $this->assertDatabaseMissing('media', ['id' => $media->id]);
    }

    public function test_invalid_file_type_rejected(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('document.pdf', 100, 'application/pdf');

        $this->actingAs($this->admin)
             ->post('/admin/leaders', [
                 'name'  => 'Leader',
                 'title' => 'Title',
                 'photo' => $file,
             ])
             ->assertSessionHasErrors('photo');
    }
}
