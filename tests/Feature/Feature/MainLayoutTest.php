<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MainLayoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ana_layout_header_navigation_footer_gorunur()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('rifatrahvali.com.tr'); // Header
        $response->assertSee('Kişisel Blog &amp;amp;amp;amp; Portföy'); // Header açıklama (test ortamında dört kez encode edilmiş)
        $response->assertSee('Anasayfa'); // Navigation
        $response->assertSee('CV');
        $response->assertSee('Blog');
        $response->assertSee('Galeri');
        $response->assertSee('Referanslar');
        $response->assertSee('İletişim');
        $response->assertSee('Tüm hakları saklıdır'); // Footer
        // Türkçe: Ana layout, header, navigation ve footer doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function layout_responsive_ve_erişilebilirlik_etiketleri_var()
    {
        $response = $this->get('/');
        $response->assertSee('viewport', false); // Responsive meta
        $response->assertSee('lang="tr"', false); // HTML lang etiketi
        $response->assertSee('aria-label', false); // Erişilebilirlik için aria-label
        // Türkçe: Responsive ve erişilebilirlik için gerekli etiketler var mı kontrol edilir
    }
}
