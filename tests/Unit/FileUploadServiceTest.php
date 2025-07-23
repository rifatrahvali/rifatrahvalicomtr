<?php

namespace Tests\Unit;

use App\Services\Media\FileUploadService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileUploadServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_uploads_and_optimizes_image_file()
    {
        Storage::fake('public');
        $service = new FileUploadService();
        $file = UploadedFile::fake()->image('test.jpg', 600, 400);
        $media = $service->upload($file, null, 'public');
        $this->assertNotNull($media->id);
        $this->assertEquals('image', $media->type);
        $this->assertTrue(Storage::disk('public')->exists($media->path));
        $this->assertTrue($media->optimized);
        $this->assertNotNull($media->webp_path);
        // Türkçe: Görsel dosyası yüklendiğinde Media kaydı oluşur, optimize edilir ve WebP yolu atanır.
    }

    /** @test */
    public function it_uploads_non_image_file()
    {
        Storage::fake('public');
        $service = new FileUploadService();
        $file = UploadedFile::fake()->create('test.pdf', 100, 'application/pdf');
        $media = $service->upload($file, null, 'public');
        $this->assertNotNull($media->id);
        $this->assertEquals('file', $media->type);
        $this->assertTrue(Storage::disk('public')->exists($media->path));
        $this->assertFalse($media->optimized);
        $this->assertNull($media->webp_path);
        // Türkçe: Görsel olmayan dosya yüklendiğinde Media kaydı oluşur, optimize edilmez ve WebP yolu atanmaz.
    }
} 