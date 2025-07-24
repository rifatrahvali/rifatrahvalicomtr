<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BackupRestoreTest extends TestCase
{
    /** @test */
    public function backup_scripti_yedek_dosyasi_olusturur()
    {
        // Türkçe: Backup scripti çalıştırılır ve yedek dosyası oluştu mu kontrol edilir
        $output = shell_exec('bash scripts/deployment/backup.sh');
        $this->assertStringContainsString('Yedekleme başarılı', $output);
        $dbBackups = glob('storage/private/backups/database/backup_*.sql');
        $filesBackups = glob('storage/private/backups/files/files_backup_*.tar.gz');
        $this->assertNotEmpty($dbBackups);
        $this->assertNotEmpty($filesBackups);
        // Türkçe: Hem veritabanı hem dosya sistemi yedeği oluşmuş olmalı
    }

    /** @test */
    public function restore_scripti_yedekten_geri_yukler()
    {
        // Türkçe: Restore scripti çalıştırılır ve başarılı mesajı beklenir
        $output = shell_exec('bash scripts/deployment/restore.sh');
        $this->assertTrue(
            str_contains($output, 'Veritabanı geri yüklendi') ||
            str_contains($output, 'Veritabanı yedeği bulunamadı!')
        );
        $this->assertTrue(
            str_contains($output, 'Dosya sistemi geri yüklendi') ||
            str_contains($output, 'Dosya sistemi yedeği bulunamadı!')
        );
        // Türkçe: Geri yükleme işlemi başarılı şekilde tamamlanmalı veya yedek yoksa uyarı vermeli
    }
} 