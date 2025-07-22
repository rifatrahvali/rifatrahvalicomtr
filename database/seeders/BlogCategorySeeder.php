<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ana kategorileri oluştur
        $parent1 = BlogCategory::firstOrCreate(
            ['slug' => 'teknoloji'],
            ['name' => 'Teknoloji']
        );

        $parent2 = BlogCategory::firstOrCreate(
            ['slug' => 'yazilim-gelistirme'],
            ['name' => 'Yazılım Geliştirme']
        );

        // Alt kategorileri oluştur
        BlogCategory::firstOrCreate(
            ['slug' => 'web-gelistirme'],
            [
                'name' => 'Web Geliştirme',
                'parent_id' => $parent2->id, // 'Yazılım Geliştirme' kategorisinin altına ekle
            ]
        );

        BlogCategory::firstOrCreate(
            ['slug' => 'mobil-gelistirme'],
            [
                'name' => 'Mobil Geliştirme',
                'parent_id' => $parent2->id,
            ]
        );

        BlogCategory::firstOrCreate(
            ['slug' => 'laravel-framework'],
            [
                'name' => 'Laravel Framework',
                'parent_id' => $parent2->id,
            ]
        );
    }
}
