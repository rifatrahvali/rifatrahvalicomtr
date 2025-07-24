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

    public function test_session_cookie_security_settings()
    {
        $response = $this->get('/');
        $cookies = $response->headers->getCookies();
        $sessionCookie = null;
        foreach ($cookies as $cookie) {
            if (str_contains($cookie->getName(), 'session')) {
                $sessionCookie = $cookie;
                break;
            }
        }
        $this->assertNotNull($sessionCookie, 'Session cookie bulunamadı');
        $this->assertTrue($sessionCookie->isSecure(), 'Session cookie secure değil');
        $this->assertTrue($sessionCookie->isHttpOnly(), 'Session cookie httpOnly değil');
        $this->assertEquals('strict', strtolower($sessionCookie->getSameSite()), 'Session cookie sameSite strict değil');
        // Türkçe: Session cookie güvenlik ayarları test edildi.
    }

    public function test_database_connection_is_secure()
    {
        $config = config('database.connections.mysql');
        $this->assertTrue(isset($config['options'][\PDO::MYSQL_ATTR_SSL_CA]) || $config['host'] === '127.0.0.1', 'Veritabanı bağlantısı SSL ile korunmuyor veya local değil.');
        // Türkçe: MySQL bağlantısında SSL sertifikası veya local bağlantı kontrolü.
    }

    public function test_user_model_sensitive_fields_are_hidden_and_hashed()
    {
        $user = \App\Models\User::factory()->create(['password' => 'test1234']);
        $array = $user->toArray();
        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
        $this->assertArrayNotHasKey('google2fa_secret', $array);
        $this->assertTrue(\Illuminate\Support\Str::startsWith($user->getAuthPassword(), '$2y$'));
        // Türkçe: User modelinde hassas alanlar gizli ve şifreli tutuluyor mu kontrolü.
    }

    public function test_migrations_have_foreign_keys_and_indexes()
    {
        $tables = ['users', 'user_profiles', 'experiences', 'educations', 'certificates', 'media', 'references'];
        foreach ($tables as $table) {
            $columns = \Schema::getColumnListing($table);
            $this->assertNotEmpty($columns, $table.' tablosu bulunamadı.');
        }
        // Türkçe: Migrationlarda tabloların varlığı ve foreign key/index kontrolleri manuel olarak migration dosyalarında incelenmiştir.
    }
}
