<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApplicationPerformanceMonitoringTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Türkçe: Test ortamında Telescope'u aktif ediyoruz
        config(['telescope.enabled' => true]);
        // Türkçe: Test ortamında TelescopeServiceProvider'ı manuel olarak register ediyoruz
        $this->app->register(\App\Providers\TelescopeServiceProvider::class);
        // Türkçe: Kayıt işlemini başlatıyoruz
        \Laravel\Telescope\Telescope::startRecording();
    }

    /** @test */
    public function telescope_paneli_localde_erisilebilir()
    {
        // Türkçe: Test ortamında Telescope paneline erişim kontrol edilir
        $response = $this->get('/telescope');
        $response->assertStatus(200);
        // Türkçe: Panelin erişilebilir olduğu doğrulanır
    }

    /** @test */
    public function bir_http_request_telescope_loguna_yazilir()
    {
        // Türkçe: Basit bir istek atılır ve Telescope logunda kaydedildiği kontrol edilir
        $this->get('/');
        $this->assertDatabaseHas('telescope_entries', [
            'type' => 'request',
        ]);
        // Türkçe: HTTP isteğinin Telescope tarafından loglandığı doğrulanır
    }
} 