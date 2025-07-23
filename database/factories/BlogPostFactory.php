<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        $slug = Str::slug($title);
        return [
            'user_id' => 1, // Türkçe yorum: Testlerde user_id zorunlu olduğu için varsayılan olarak 1 verildi.
            'title' => $title,
            'slug' => $slug,
            'content' => $this->faker->paragraphs(5, true),
            'image' => 'images/blog/' . $this->faker->image('public/storage/images/blog', 640, 480, null, false),
            'status' => $this->faker->randomElement(['published', 'draft']),
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'blog_category_id' => \App\Models\BlogCategory::factory(),
            // user_id ve blog_category_id seeder'da atanacak
        ];
        // Türkçe yorum: Blog yazısı için sahte veri üretir.
    }
}
