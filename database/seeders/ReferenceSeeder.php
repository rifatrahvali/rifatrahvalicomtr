<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reference;

class ReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Örnek referansları tanımla
        $references = [
            [
                'name' => 'Ahmet Yılmaz',
                'title' => 'CEO, Teknoloji A.Ş.',
                'company' => 'Teknoloji A.Ş.',
                'comment' => 'Rıfat Bey ile çalışmak harikaydı. Projemizi zamanında ve beklediğimizden daha iyi bir kalitede teslim etti.',
                'image' => 'images/references/ahmet-yilmaz.jpg',
                'order' => 1,
            ],
            [
                'name' => 'Ayşe Kaya',
                'title' => 'Proje Yöneticisi, Çözüm Ortağı Ltd.',
                'company' => 'Çözüm Ortağı Ltd.',
                'comment' => 'Profesyonel yaklaşımı ve teknik bilgisi sayesinde projemizdeki zorlukların üstesinden kolayca geldik. Kesinlikle tavsiye ederim.',
                'image' => 'images/references/ayse-kaya.jpg',
                'order' => 2,
            ],
        ];

        // Referansları veritabanına ekle
        foreach ($references as $reference) {
            Reference::firstOrCreate(['name' => $reference['name']], $reference);
        }
    }
}
