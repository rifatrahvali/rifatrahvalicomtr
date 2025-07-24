<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class SecurityDocumentationTest extends TestCase
{
    /** @test */
    public function guvenlik_dokumani_olusturuldu_ve_icerik_dogru()
    {
        // Türkçe: Güvenlik dokümantasyonu dosyası var mı kontrol edilir
        $this->assertFileExists('documents/security-documentation.md');
        $content = file_get_contents('documents/security-documentation.md');
        // Türkçe: Temel başlıklar ve örnek içerikler kontrol edilir
        $this->assertStringContainsString('Güvenlik Checklist', $content);
        $this->assertStringContainsString('Olay Müdahale Prosedürü', $content);
        $this->assertStringContainsString('Güvenlik En İyi Uygulamaları', $content);
        $this->assertStringContainsString('Zafiyet Değerlendirme Raporu', $content);
        // Türkçe: Rehberde olması gereken ana başlıklar ve örnekler kontrol edilir
    }
} 