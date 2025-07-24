<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

class UserGuideManualTest extends TestCase
{
    /** @test */
    public function kullanici_rehberi_dokumani_olusturuldu_ve_icerik_dogru()
    {
        // Türkçe: Kullanıcı rehberi dosyası var mı kontrol edilir
        $this->assertFileExists('documents/user-guide-manual.md');
        $content = file_get_contents('documents/user-guide-manual.md');
        // Türkçe: Temel başlıklar ve örnek içerikler kontrol edilir
        $this->assertStringContainsString('Admin Panel Kullanımı', $content);
        $this->assertStringContainsString('İçerik Yönetimi', $content);
        $this->assertStringContainsString('Sorun Giderme', $content);
        $this->assertStringContainsString('Sıkça Sorulan Sorular', $content);
        $this->assertStringContainsString('Ekran Görüntüsü', $content);
        // Türkçe: Rehberde olması gereken ana başlıklar ve örnekler kontrol edilir
    }
} 