<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learned_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_id')->constrained('educations')->cascadeOnDelete(); // Türkçe yorum: İlgili eğitim kaydı
            $table->json('core_learnings')->nullable(); // Türkçe yorum: Temel kazanımlar
            $table->json('general_learnings')->nullable(); // Türkçe yorum: Genel kazanımlar
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('learned_educations');
    }
}; 