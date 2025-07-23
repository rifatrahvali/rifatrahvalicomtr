<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learned_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('experience_id')->constrained()->cascadeOnDelete(); // Türkçe yorum: İlgili iş deneyimi
            $table->string('description', 500); // Türkçe yorum: Kazanım açıklaması
            $table->string('activity_field', 150)->nullable(); // Türkçe yorum: Alan
            $table->json('activity_tags')->nullable(); // Türkçe yorum: Etiketler
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('learned_experiences');
    }
}; 