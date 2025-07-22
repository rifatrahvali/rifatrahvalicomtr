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
                Schema::create('blog_categories', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // Kategori adı
            $table->string('name');

            // URL dostu, benzersiz slug
            $table->string('slug')->unique();

            // Hiyerarşi için ebeveyn kategorinin ID'si. Null olabilir (ana kategoriler için).
            // Bu sütun, aynı tablodaki 'id' sütununa referans verir.
            $table->foreignId('parent_id')->nullable()->constrained('blog_categories')->cascadeOnDelete();

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};
