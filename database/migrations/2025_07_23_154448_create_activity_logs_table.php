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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // İşlemi yapan admin kullanıcı id'si
            $table->string('action'); // Yapılan işlemin kısa adı (ör: login, user_create, settings_update)
            $table->text('description')->nullable(); // İşlemin detaylı açıklaması
            $table->string('ip_address', 45)->nullable(); // İşlemi yapan kullanıcının IP adresi
            $table->string('user_agent')->nullable(); // Kullanıcının tarayıcı bilgisi
            $table->timestamp('created_at')->useCurrent(); // İşlemin zamanı
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
