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
                Schema::create('blog_posts', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // Yazının yazarını belirten yabancı anahtar (users tablosuna referans)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Yazının kategorisini belirten yabancı anahtar (blog_categories tablosuna referans)
            $table->foreignId('blog_category_id')->constrained()->cascadeOnDelete();

            // Yazı başlığı
            $table->string('title');

            // URL dostu, benzersiz slug
            $table->string('slug')->unique();

            // Yazı içeriği
            $table->longText('content');

            // Yazının kapak görseli (URL'i tutulacak), null olabilir
            $table->string('image')->nullable();

            // Yazının durumu (taslak, yayınlandı vb.). Varsayılan 'draft'.
            $table->enum('status', ['draft', 'published'])->default('draft');

            // Yazının yayınlanma tarihi, null olabilir
            $table->timestamp('published_at')->nullable();

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
