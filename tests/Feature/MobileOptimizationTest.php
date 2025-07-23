<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MobileOptimizationTest extends TestCase
{
    /** @test */
    public function homepage_contains_responsive_meta_and_manifest()
    {
        $response = $this->get('/');
        $response->assertSee('<meta name="viewport" content="width=device-width, initial-scale=1">', false);
        $response->assertSee('<link rel="manifest" href="/manifest.json">', false);
        // Türkçe: Ana sayfada responsive viewport ve manifest linki kontrol edilir.
    }

    /** @test */
    public function homepage_registers_service_worker()
    {
        $response = $this->get('/');
        $response->assertSee('navigator.serviceWorker.register', false);
        // Türkçe: Service worker kaydının ana sayfada olup olmadığı kontrol edilir.
    }

    /** @test */
    public function gallery_images_have_picture_and_srcset()
    {
        $response = $this->get('/gallery');
        $response->assertSee('<picture>', false);
        $response->assertSee('srcset=', false);
        // Türkçe: Galeri sayfasında picture etiketi ve srcset kullanımı kontrol edilir.
    }

    /** @test */
    public function blog_detail_image_has_picture_and_srcset()
    {
        // Varsayılan bir blog postu oluşturulmuş olmalı
        $post = \App\Models\BlogPost::factory()->create(['image' => 'test.jpg']);
        $response = $this->get('/blog/' . $post->slug);
        $response->assertSee('<picture>', false);
        $response->assertSee('srcset=', false);
        // Türkçe: Blog detayında ana görselde picture ve srcset kontrol edilir.
    }

    /** @test */
    public function mobile_menu_is_accessible_and_toggleable()
    {
        $response = $this->get('/');
        $response->assertSee('id="mobile-menu-toggle"', false);
        $response->assertSee('id="mobile-menu-list"', false);
        // Türkçe: Mobil menü butonu ve menü listesi ana sayfada bulunuyor mu kontrol edilir.
    }
} 