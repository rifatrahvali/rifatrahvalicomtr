<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DesignSystemTest extends TestCase
{
    /** @test */
    public function butonlar_ve_card_bilesenleri_gorunur()
    {
        $response = $this->get('/');
        $response->assertSee('Birincil Buton');
        $response->assertSee('btn');
        $response->assertSee('Card Bileşeni');
        $response->assertSee('badge-success');
        // Türkçe: Buton ve card bileşenleri doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function alert_ve_utility_classlari_gorunur()
    {
        $response = $this->get('/');
        $response->assertSee('alert-success');
        $response->assertSee('Başarılı işlem!');
        $response->assertSee('u-shadow');
        $response->assertSee('u-radius');
        // Türkçe: Alert ve utility class'ları doğru şekilde render ediliyor mu kontrol edilir
    }

    /** @test */
    public function animasyon_classlari_gorunur()
    {
        $response = $this->get('/');
        $response->assertSee('u-fade-in');
        $response->assertSee('u-slide-up');
        $response->assertSee('u-hover-scale');
        // Türkçe: Animasyon class'ları doğru şekilde render ediliyor mu kontrol edilir
    }
}
