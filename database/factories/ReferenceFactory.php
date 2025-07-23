<?php

namespace Database\Factories;

use App\Models\Reference;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferenceFactory extends Factory
{
    protected $model = Reference::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'images' => json_encode([$this->faker->imageUrl(400, 300, 'business')]),
            'website_url' => $this->faker->url(),
            'description' => $this->faker->sentence(8),
            'company_name' => $this->faker->company(),
            'position' => $this->faker->jobTitle(),
            'order_index' => $this->faker->numberBetween(0, 10),
            'is_active' => true,
        ];
        // Türkçe yorum: Reference için örnek veri üretiliyor.
    }
} 