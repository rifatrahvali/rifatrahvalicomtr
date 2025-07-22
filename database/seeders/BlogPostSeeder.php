<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;
use App\Models\BlogCategory;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mevcut kullanıcıları ve kategorileri al
        $users = User::all();
        $categories = BlogCategory::all();

        // Eğer kullanıcı veya kategori yoksa, seeder'ı çalıştırma
        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('Kullanıcı veya kategori bulunamadı, BlogPostSeeder atlanıyor.');
            return;
        }

        // 15 adet örnek blog gönderisi oluştur
        for ($i = 0; $i < 15; $i++) {
            BlogPost::factory()->create([
                // Rastgele bir kullanıcıyı yazar olarak ata
                'user_id' => $users->random()->id,
                // Rastgele bir kategoriyi ata
                'blog_category_id' => $categories->random()->id,
            ]);
        }
    }
}
