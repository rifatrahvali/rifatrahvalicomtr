<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EnvConfigCacheTest extends TestCase
{
    /** @test */
    public function env_degiskenleri_dogru_yukleniyor()
    {
        // Türkçe: .env dosyasındaki APP_ENV ve APP_DEBUG değişkenleri doğru yüklenmeli
        $this->assertEquals('testing', env('APP_ENV'));
        $this->assertEquals(true, env('APP_DEBUG'));
        // Türkçe: Test ortamında env değişkenlerinin doğru yüklendiği doğrulanır
    }

    /** @test */
    public function config_cache_olusturulup_temizlenebilir()
    {
        // Türkçe: Config cache oluşturma ve temizleme işlemleri test edilir
        Artisan::call('config:cache');
        $this->assertFileExists(base_path('bootstrap/cache/config.php'));
        Artisan::call('config:clear');
        $this->assertFileDoesNotExist(base_path('bootstrap/cache/config.php'));
        // Türkçe: Config cache dosyasının oluştuğu ve temizlendiği doğrulanır
    }
} 