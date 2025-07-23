<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Gallery>
 */
class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->sentence(6),
            'path' => 'gallery/' . $this->faker->uuid . '.jpg',
            'type' => 'image',
            'order' => $this->faker->numberBetween(0, 10),
        ];
        // Türkçe yorum: Gallery için örnek veri üretiliyor.
    }
} 