<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class MonitoringMetricsTest extends TestCase
{
    /** @test */
    public function metrics_endpoint_prometheus_formatinda_doner()
    {
        // Türkçe: /metrics endpoint'i Prometheus formatında metrik döndürmeli
        $response = $this->get('/metrics');
        $response->assertStatus(200);
        $contentType = $response->headers->get('Content-Type');
        $this->assertStringStartsWith('text/plain', $contentType); // Türkçe: Content-Type 'text/plain' ile başlamalı
        $content = $response->getContent();
        $this->assertStringContainsString('app_uptime_seconds', $content);
        $this->assertStringContainsString('app_memory_usage_bytes', $content);
        $this->assertStringContainsString('app_request_count', $content);
        // Türkçe: Prometheus metrik isimleri ve açıklamaları kontrol edilir
    }
} 