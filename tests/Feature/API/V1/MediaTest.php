<?php

namespace Tests\Feature\API\V1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Media;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    public function test_image_upload_and_processing()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('test.jpg', 600, 400);
        $response = $this->actingAs($user)->postJson('/api/v1/media/upload', [
            'file' => $file,
            'alt' => 'Test görseli',
        ]);
        $response->assertStatus(201)
            ->assertJson(['success' => true])
            ->assertJsonStructure(['data' => ['id', 'original_name', 'file_name', 'path', 'webp_path', 'mime_type', 'size', 'width', 'height', 'type', 'optimized']]);
        $media = Media::first();
        Storage::disk('public')->assertExists($media->path);
        Storage::disk('public')->assertExists($media->webp_path);
        Storage::disk('public')->assertExists('uploads/thumbnails/' . $media->file_name);
        Storage::disk('public')->assertExists('uploads/medium/' . $media->file_name);
        Storage::disk('public')->assertExists('uploads/large/' . $media->file_name);
        $this->assertEquals('Test görseli', $media->alt);
        // Türkçe yorum: Görsel yüklenir, optimize edilir, farklı boyutlarda ve WebP olarak kaydedilir.
    }

    public function test_invalid_file_type_is_rejected()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('test.txt', 10, 'text/plain');
        $response = $this->actingAs($user)->postJson('/api/v1/media/upload', [
            'file' => $file,
        ]);
        $response->assertStatus(422);
        // Türkçe yorum: Geçersiz dosya tipi reddedilir.
    }

    public function test_file_size_limit()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('big.jpg', 9000, 'image/jpeg');
        $response = $this->actingAs($user)->postJson('/api/v1/media/upload', [
            'file' => $file,
        ]);
        $response->assertStatus(422);
        // Türkçe yorum: Maksimum dosya boyutu aşıldığında hata döner.
    }

    public function test_malicious_file_upload_is_blocked()
    {
        \Storage::fake('public');
        $user = \App\Models\User::factory()->create();
        // JPEG uzantılı ama içeriği zararlı bir dosya (ör: .php script)
        $file = \Illuminate\Http\UploadedFile::fake()->createWithContent('evil.jpg', '<?php echo "hacked"; ?>');
        $response = $this->actingAs($user)->postJson('/api/v1/media/upload', [
            'file' => $file,
        ]);
        $response->assertStatus(500);
        // Türkçe: Magic bytes kontrolü ile zararlı dosya yüklenememeli.
    }

    public function test_file_name_manipulation_is_prevented()
    {
        \Storage::fake('public');
        $user = \App\Models\User::factory()->create();
        // .jpg uzantılı ama içeriği PDF olan dosya
        $file = \Illuminate\Http\UploadedFile::fake()->createWithContent('fake.jpg', '%PDF-1.4 test pdf');
        $response = $this->actingAs($user)->postJson('/api/v1/media/upload', [
            'file' => $file,
        ]);
        $response->assertStatus(500);
        // Türkçe: Dosya uzantısı ile içerik uyuşmazsa yükleme engellenmeli.
    }
} 