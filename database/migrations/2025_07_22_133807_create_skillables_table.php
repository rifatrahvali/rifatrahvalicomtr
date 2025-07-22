<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
                Schema::create('skillables', function (Blueprint $table) {
            // skill_id sütunu, bu kaydın hangi beceriye ait olduğunu belirtir.
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();

            // morphs('skillable') metodu, iki sütun oluşturur:
            // 1. skillable_id (unsignedBigInteger): İlişkili modelin ID'sini tutar (örn: Experience ID'si).
            // 2. skillable_type (string): İlişkili modelin sınıf adını tutar (örn: 'App\Models\Experience').
            $table->morphs('skillable');

            // Bir becerinin, belirli bir modele (örn: bir iş deneyimi) sadece bir kez eklenebilmesini sağlamak için
            // bu üç sütunu birlikte benzersiz (unique) yapıyoruz.
            $table->unique(['skill_id', 'skillable_id', 'skillable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skillables');
    }
};
