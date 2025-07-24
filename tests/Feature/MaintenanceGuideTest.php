<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class MaintenanceGuideTest extends TestCase
{
    /** @test */
    public function bakim_ve_guncelleme_rehberi_olusturuldu_ve_icerik_dogru()
    {
        // Türkçe: Bakım rehberi dosyası var mı kontrol edilir
        $this->assertFileExists('documents/maintenance-guide.md');
        $content = file_get_contents('documents/maintenance-guide.md');
        // Türkçe: Temel başlıklar ve örnek içerikler kontrol edilir
        $this->assertStringContainsString('Düzenli Bakım Prosedürleri', $content);
        $this->assertStringContainsString('Güncelleme ve Yükseltme', $content);
        $this->assertStringContainsString('Performans İzleme Rehberi', $content);
        $this->assertStringContainsString('Sorun Giderme Prosedürleri', $content);
        // Türkçe: Rehberde olması gereken ana başlıklar ve örnekler kontrol edilir
    }
} 