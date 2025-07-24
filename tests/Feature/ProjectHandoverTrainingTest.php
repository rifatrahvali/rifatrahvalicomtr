<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class ProjectHandoverTrainingTest extends TestCase
{
    /** @test */
    public function proje_teslimi_ve_egitim_rehberi_olusturuldu_ve_icerik_dogru()
    {
        // Türkçe: Proje teslimi ve eğitim rehberi dosyası var mı kontrol edilir
        $this->assertFileExists('documents/project-handover-training.md');
        $content = file_get_contents('documents/project-handover-training.md');
        // Türkçe: Temel başlıklar ve örnek içerikler kontrol edilir
        $this->assertStringContainsString('Kod Walkthrough', $content);
        $this->assertStringContainsString('Admin Panel Eğitimi', $content);
        $this->assertStringContainsString('Deployment Prosedürü Eğitimi', $content);
        $this->assertStringContainsString('Sıkça Sorulan Sorular', $content);
        $this->assertStringContainsString('Eğitim Oturumu Notları', $content);
        // Türkçe: Rehberde olması gereken ana başlıklar ve örnekler kontrol edilir
    }
} 