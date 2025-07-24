<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseMigrationSeedingTest extends TestCase
{
    /** @test */
    public function migration_ve_seed_islemleri_basarili()
    {
        // Türkçe: Tüm migration ve seed işlemleri test ortamında başarıyla çalışmalı
        Artisan::call('migrate:fresh --seed');
        $this->assertTrue(Schema::hasTable('users'));
        $this->assertTrue(Schema::hasTable('migrations'));
        // Türkçe: Migration sonrası önemli tablolar oluşmuş olmalı
        $user = DB::table('users')->first();
        $this->assertNotNull($user);
        // Türkçe: Seed sonrası en az bir kullanıcı olmalı
    }
} 