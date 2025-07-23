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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Ayarın anahtar ismi (ör: site_title)
            $table->text('value')->nullable(); // Ayarın değeri (ör: "Rifat Rahvali Blog")
            $table->string('type', 50)->default('string'); // Veri tipi (ör: string, image, email, json)
            $table->string('group', 50)->default('general'); // Ayar grubu (ör: general, seo, email)
            $table->string('description')->nullable(); // Açıklama veya yardım metni
            $table->unsignedBigInteger('updated_by')->nullable(); // Son güncelleyen admin kullanıcı id'si
            $table->timestamps(); // Oluşturulma ve güncellenme zamanları
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
