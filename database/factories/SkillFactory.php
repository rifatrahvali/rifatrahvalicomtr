<?php
namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            // Türkçe: Skill modeli için sahte veri üretir. Migrationda type alanı yoksa eklenmez.
        ];
    }
} 