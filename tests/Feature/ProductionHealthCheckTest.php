<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ProductionHealthCheckTest extends TestCase
{
    /** @test */
    public function health_endpoint_200_doner()
    {
        // Türkçe: /health endpoint'i 200 döndürmeli
        $response = $this->get('/health');
        $response->assertStatus(200);
        $response->assertJson(['status' => 'ok']);
        // Türkçe: Health endpoint'in çalıştığı doğrulanır
    }

    /** @test */
    public function http_request_https_yonlendirmesi_var()
    {
        // Türkçe: HTTP istekleri HTTPS'e yönlendirilmeli (Nginx/Apache config ile)
        $response = $this->get('http://example.com/health', ['X-Forwarded-Proto' => 'http']);
        $response->assertRedirect('https://example.com/health');
        // Türkçe: HTTP'den HTTPS'e yönlendirme çalışıyor mu kontrol edilir
    }
} 