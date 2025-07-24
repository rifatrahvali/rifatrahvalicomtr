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

    public function test_gallery_images_have_seo_alt_text()
    {
        $gallery = Gallery::factory()->create([
            'title' => 'SEO Test Görseli',
            'type' => 'image',
            'path' => 'seo-test.jpg',
            'alt_text' => 'SEO için özel alt metin',
        ]);
        $response = $this->get('/gallery');
        $response->assertSee('alt="SEO için özel alt metin"', false);
        // Türkçe yorum: Görselin alt attribute'u SEO için özel alt metin ile geliyor mu?
    }

    public function test_gallery_images_have_seo_alt_and_lazy_loading_together()
    {
        $gallery = Gallery::factory()->create([
            'title' => 'SEO Lazy Görsel',
            'type' => 'image',
            'path' => 'seo-lazy.jpg',
            'alt_text' => 'SEO ve Lazy Alt',
        ]);
        $response = $this->get('/gallery');
        $response->assertSee('alt="SEO ve Lazy Alt"', false);
        $response->assertSee('loading="lazy"', false);
        // Türkçe yorum: Görselde hem alt attribute'u hem de lazy loading birlikte var mı?
    }

    public function test_gallery_page_performance_with_many_items()
    {
        \App\Models\Gallery::factory()->count(100)->create(['type' => 'image']);
        $start = microtime(true);
        $response = $this->get('/gallery');
        $duration = microtime(true) - $start;
        $response->assertStatus(200);
        $this->assertLessThan(2.0, $duration, 'Galeri sayfası 100 görselle 2 saniyeden kısa sürede yüklenmeli.');
        // Türkçe: Galeri sayfası çok sayıda görselle hızlı yüklenmeli (2 sn altında)
    }
} 