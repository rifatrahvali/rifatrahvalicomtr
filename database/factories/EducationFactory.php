<?php
namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    protected $model = Education::class;
    protected $table = 'educations'; // Türkçe: Doğru tablo adı

    public function definition()
    {
        return [
            'user_id' => 1,
            'school' => $this->faker->company . ' Üniversitesi',
            'degree' => $this->faker->randomElement(['Lisans', 'Yüksek Lisans', 'Doktora']),
            'start_date' => $this->faker->year,
            'end_date' => $this->faker->optional()->year,
            'description' => $this->faker->sentence(8),
        ];
        // Türkçe: Education modeli için factory, doğru tablo adı 'educations' ile çalışır.
    }
} 