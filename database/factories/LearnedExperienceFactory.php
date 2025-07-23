<?php
namespace Database\Factories;

use App\Models\LearnedExperience;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

class LearnedExperienceFactory extends Factory
{
    protected $model = LearnedExperience::class;

    public function definition()
    {
        return [
            'experience_id' => Experience::factory(),
            'description' => $this->faker->sentence(8),
            'activity_field' => $this->faker->word,
            'activity_tags' => $this->faker->words(3),
        ];
        // Türkçe: LearnedExperience modeli için factory, deneyim, açıklama, alan ve etiketler üretir.
    }
} 