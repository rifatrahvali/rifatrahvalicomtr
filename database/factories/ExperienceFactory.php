<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'employment_type' => $this->faker->randomElement(['Tam Zamanlı', 'Yarı Zamanlı', 'Staj']),
            'description' => $this->faker->sentence(10),
            'start_date' => $this->faker->date(),
            'end_date' => null,
        ];
    }
}
// Türkçe yorum: Bu factory, testler için sahte iş deneyimi verisi üretir. 