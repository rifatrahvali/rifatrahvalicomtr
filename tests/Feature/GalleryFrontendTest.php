<?php

namespace Tests\Feature;

use App\Models\Gallery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryFrontendTest extends TestCase
{
    use RefreshDatabase;

    public function test_gallery_page_displays_items()
    {
        Gallery::factory()->create(['title' => 'Test Görseli', 'type' => 'image']);
        $response = $this->get('/gallery');
        $response->assertStatus(200);
        $response->assertSee('Test Görseli');
        // Türkçe yorum: Galeri sayfasında eklenen görselin başlığı görüntüleniyor mu?
    }

    public function test_gallery_page_filters_by_category()
    {
        Gallery::factory()->create(['title' => 'Sadece Görsel', 'type' => 'image']);
        Gallery::factory()->create(['title' => 'Sadece Video', 'type' => 'video']);
        $response = $this->get('/gallery?category=image');
        $response->assertStatus(200);
        $response->assertSee('Sadece Görsel');
        $response->assertDontSee('Sadece Video');
        // Türkçe yorum: Kategoriye göre filtreleme çalışıyor mu?
    }

    public function test_gallery_images_have_lazy_loading()
    {
        Gallery::factory()->create(['title' => 'Lazy Görsel', 'type' => 'image', 'path' => 'test.jpg']);
        $response = $this->get('/gallery');
        $response->assertSee('loading="lazy"', false);
        // Türkçe yorum: Görsellerde lazy loading attribute'u var mı?
    }
} 