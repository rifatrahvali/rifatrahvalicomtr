<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reference;

class ReferenceSeeder extends Seeder
{
    public function run(): void
    {
        Reference::factory(5)->create();
        // Türkçe yorum: 5 adet örnek referans kaydı oluşturuluyor.
    }
}
