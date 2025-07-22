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
            // Sahte başlık (6 kelime)
            'title' => $title,
            // Başlıktan oluşturulmuş slug
            'slug' => $slug,
            // Sahte içerik (5 paragraf)
            'content' => $this->faker->paragraphs(5, true),
            // Rastgele bir resim yolu
            'image' => 'images/blog/' . $this->faker->image('public/storage/images/blog', 640, 480, null, false),
            // %80 ihtimalle 'published', %20 ihtimalle 'draft'
            'status' => $this->faker->randomElement(['published', 'draft']),
            // Son bir ay içinde rastgele bir yayınlanma tarihi
            'published_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            // user_id ve blog_category_id seeder'da atanacak
        ];
    }
}
