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

    public function test_http_request_redirects_to_https()
    {
        // Türkçe: HTTP ile gelen istek otomatik olarak HTTPS'e yönlendirilir mi?
        $response = $this->get('http://localhost/');
        $response->assertRedirect('https://localhost/');
        // Türkçe: HTTP istekler otomatik olarak HTTPS'e yönlendirilmelidir.
    }

    public function test_hsts_header_is_set()
    {
        // Türkçe: HTTPS ile gelen istekte HSTS header var mı?
        $response = $this->get('/', ['HTTPS' => 'on']);
        $response->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        // Türkçe: HSTS header'ı eklenmiş olmalı.
    }

    public function test_security_headers_are_set()
    {
        $response = $this->get('/');
        $response->assertHeader('Content-Security-Policy');
        $response->assertHeader('X-Frame-Options', 'DENY');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        // Türkçe: Tüm önemli güvenlik header'ları response'ta olmalı.
    }

    public function test_input_sanitizer_removes_xss_and_html()
    {
        $dirty = '<script>alert(1)</script><b>kalın</b> <img src=x onerror=alert(2)>';
        $clean = \App\Services\Security\InputSanitizer::clean($dirty);
        $this->assertStringNotContainsString('<script>', $clean);
        $this->assertStringNotContainsString('onerror', $clean);
        $this->assertStringNotContainsString('<img', $clean);
        $this->assertStringNotContainsString('<b>', $clean); // HTMLPurifier varsa b etiketi de gider
        // Türkçe: InputSanitizer, XSS ve zararlı HTML içeriğini temizlemeli.
    }
}
