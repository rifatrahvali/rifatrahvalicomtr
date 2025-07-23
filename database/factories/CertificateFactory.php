<?php
namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->word . ' Sertifikası',
            'issuing_organization' => $this->faker->company,
            'issue_date' => $this->faker->date(),
            'credential_url' => $this->faker->url,
            // Türkçe: Sertifika modeli için sahte veri üretir. Migrationda description alanı yoksa eklenmez.
        ];
    }
} 