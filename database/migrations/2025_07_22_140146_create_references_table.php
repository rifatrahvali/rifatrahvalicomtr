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
                Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->json('images');
            $table->string('website_url', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('company_name', 200)->nullable();
            $table->string('position', 150)->nullable();
            $table->unsignedInteger('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            // Türkçe yorum: Referans için gerekli tüm alanlar eklendi.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('references');
    }
};
