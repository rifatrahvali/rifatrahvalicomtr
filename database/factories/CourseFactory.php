<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // Türkçe: Kursun ait olduğu kullanıcıyı otomatik oluşturur
            'name' => $this->faker->sentence(2), // Türkçe: Kurs adı için iki kelimelik sahte veri
            'organization' => $this->faker->company, // Türkçe: Kursu veren kurum adı
            'completion_date' => $this->faker->date(), // Türkçe: Kursun tamamlanma tarihi
            'credential_url' => $this->faker->url, // Türkçe: Sertifika veya kurs doğrulama linki
        ];
    }
}
