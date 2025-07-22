<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temel yetenekleri tanımla
        $skills = [
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'JavaScript'],
            ['name' => 'Vue.js'],
            ['name' => 'MySQL'],
            ['name' => 'Docker'],
            ['name' => 'HTML5'],
            ['name' => 'CSS3'],
        ];

        // Yetenekleri veritabanına ekle
        // firstOrCreate metodu, yinelenen kayıtları önler.
        foreach ($skills as $skill) {
            Skill::firstOrCreate($skill);
        }
    }
}
