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
                Schema::create('galleries', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // Galeri öğesi başlığı
            $table->string('title');

            // Galeri öğesi açıklaması, null olabilir
            $table->text('description')->nullable();

            // Dosya yolu (resim veya video URL'i)
            $table->string('path');

            // Öğenin türü (örn: 'image', 'video'). Varsayılan 'image'.
            $table->enum('type', ['image', 'video'])->default('image');

            // Öğelerin sıralaması için kullanılacak sütun. Varsayılan 0.
            $table->unsignedInteger('order')->default(0);

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
