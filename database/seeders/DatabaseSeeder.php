<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder'ları mantıksal bir sırayla çağır
        $this->call([
            // 1. Roller ve İzinler
            RoleSeeder::class,
            PermissionSeeder::class,

            // 2. Temel Kullanıcılar
            UserSeeder::class,

            // 3. İçerik ve Diğer Modeller
            SkillSeeder::class,
            BlogCategorySeeder::class,
            BlogPostSeeder::class,
            GallerySeeder::class,
            ReferenceSeeder::class,
        ]);
    }
}
