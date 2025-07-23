<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserProfile>
 */
class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    public function definition(): array
    {
        return [
            'user_id' => 1, // Türkçe: Testlerde user_id zorunlu olduğu için 1 verildi.
            'bio' => $this->faker->sentence(8),
        ];
        // Türkçe: UserProfile için örnek veri üretiliyor.
    }
}
