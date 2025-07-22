<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Örnek galeri öğelerini tanımla
        $galleries = [
            [
                'title' => 'Proje Ekran Görüntüsü 1',
                'description' => 'Uygulamanın ana sayfa görünümü.',
                'path' => 'images/gallery/screenshot-1.jpg',
                'type' => 'image',
                'order' => 1,
            ],
            [
                'title' => 'Proje Tanıtım Videosu',
                'description' => 'Projenin özelliklerini tanıtan kısa bir video.',
                'path' => 'videos/gallery/intro.mp4',
                'type' => 'video',
                'order' => 2,
            ],
            [
                'title' => 'Ofis Fotoğrafı',
                'description' => 'Çalışma ortamımızdan bir kare.',
                'path' => 'images/gallery/office.jpg',
                'type' => 'image',
                'order' => 3,
            ],
        ];

        // Galeri öğelerini veritabanına ekle
        foreach ($galleries as $gallery) {
            Gallery::firstOrCreate(['path' => $gallery['path']], $gallery);
        }
    }
}
