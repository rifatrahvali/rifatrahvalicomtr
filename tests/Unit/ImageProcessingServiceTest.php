<?php

namespace Tests\Unit;

use App\Services\Media\ImageProcessingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageProcessingServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_optimizes_image_and_creates_resized_and_webp_versions()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('test.jpg', 800, 600);
        $path = $file->storeAs('uploads/original', 'test.jpg', 'public');
        $service = new ImageProcessingService();
        $result = $service->optimize($path, 'public');
        $this->assertArrayHasKey('thumbnails', $result);
        $this->assertArrayHasKey('medium', $result);
        $this->assertArrayHasKey('large', $result);
        $this->assertArrayHasKey('webp', $result);
        $this->assertTrue(Storage::disk('public')->exists($result['thumbnails']));
        $this->assertTrue(Storage::disk('public')->exists($result['medium']));
        $this->assertTrue(Storage::disk('public')->exists($result['large']));
        $this->assertTrue(Storage::disk('public')->exists($result['webp']));
        // Türkçe: optimize fonksiyonu ile farklı boyutlarda ve WebP formatında görseller oluşturuluyor mu kontrol edilir.
    }
} 