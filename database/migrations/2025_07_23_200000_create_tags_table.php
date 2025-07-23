<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Etiketler tablosu
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Türkçe yorum: Etiket adı benzersiz olmalı
            $table->string('slug', 120)->unique(); // Türkçe yorum: URL dostu slug
            $table->timestamps();
        });
        // Blog yazısı ve etiket arasındaki çoktan-çoğa ilişki için pivot tablo
        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['blog_post_id', 'tag_id']); // Türkçe yorum: Aynı etiket bir yazıya bir kez eklenebilir
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('blog_post_tag');
        Schema::dropIfExists('tags');
    }
}; 