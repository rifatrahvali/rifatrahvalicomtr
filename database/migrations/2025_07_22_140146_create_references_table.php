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
            // Otomatik artan primary key (id)
            $table->id();

            // Referans veren kişinin adı
            $table->string('name');

            // Referans veren kişinin unvanı, null olabilir
            $table->string('title')->nullable();

            // Referans veren kişinin şirketi, null olabilir
            $table->string('company')->nullable();

            // Referans yorumu
            $table->text('comment');

            // Referans veren kişinin resmi (URL'i tutulacak), null olabilir
            $table->string('image')->nullable();

            // Referansların sıralaması için kullanılacak sütun. Varsayılan 0.
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
        Schema::dropIfExists('references');
    }
};
