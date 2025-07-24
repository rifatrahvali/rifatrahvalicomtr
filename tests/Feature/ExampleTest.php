<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_csrf_protection_blocks_post_without_token()
    {
        // Türkçe: CSRF token olmadan POST isteği yapılırsa 419 döner
        $response = $this->post('/blog');
        $response->assertStatus(419);
        // Türkçe: CSRF koruması aktif ve token olmadan işlem engelleniyor
    }

    public function test_homepage_response_time_is_fast()
    {
        $start = microtime(true);
        $response = $this->get('/');
        $duration = microtime(true) - $start;
        $response->assertStatus(200);
        $this->assertLessThan(1.5, $duration, 'Ana sayfa 1.5 saniyeden kısa sürede yüklenmeli.');
        // Türkçe: Ana sayfa response süresi 1.5 saniyeden kısa olmalı (test ortamı için makul bir eşik)
    }

    public function test_blog_index_response_time_is_fast()
    {
        $start = microtime(true);
        $response = $this->get('/blog');
        $duration = microtime(true) - $start;
        $response->assertStatus(200);
        $this->assertLessThan(1.5, $duration, 'Blog ana sayfası 1.5 saniyeden kısa sürede yüklenmeli.');
        // Türkçe: Blog ana sayfası response süresi 1.5 saniyeden kısa olmalı
    }
}
