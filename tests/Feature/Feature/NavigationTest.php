<?php

namespace Tests\Feature;

use Tests\TestCase;

class NavigationTest extends TestCase
{
    /** @test */
    public function ana_menu_ve_footer_linkleri_gorunur()
    {
        $response = $this->get('/blog');
        $response->assertSee('Anasayfa');
        $response->assertSee('CV');
        $response->assertSee('Blog');
        $response->assertSee('Galeri');
        $response->assertSee('Referanslar');
        $response->assertSee('İletişim');
        $response->assertSee('nav-link');
        // Türkçe: Ana menü ve footer linkleri doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function aktif_link_vurgusu_dogru_gorunur()
    {
        $response = $this->get('/blog');
        $response->assertSee('nav-active');
        // Türkçe: Aktif link vurgusu doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function breadcrumb_dogru_gorunur()
    {
        $response = $this->get('/blog/test-yazi');
        $response->assertSee('breadcrumb');
        $response->assertSee('Anasayfa');
        $response->assertSee('Blog');
        $response->assertSee('Test yazı');
        // Türkçe: Breadcrumb bileşeni doğru şekilde render ediliyor mu kontrol edilir
    }
}
