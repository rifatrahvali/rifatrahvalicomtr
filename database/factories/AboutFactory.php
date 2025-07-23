<?php
namespace Database\Factories;

use App\Models\About;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    protected $model = About::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'cv_url' => $this->faker->optional()->url,
            'order' => $this->faker->numberBetween(1, 5),
            'is_active' => $this->faker->boolean(90),
        ];
        // Türkçe: About modeli için factory, user_id, başlık, açıklama, cv_url, sıralama ve aktiflik alanlarını üretir.
    }
} 