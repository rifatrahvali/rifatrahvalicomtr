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
                Schema::create('abouts', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // user_id sütunu, bu hakkımda bilgisinin hangi kullanıcıya ait olduğunu belirtir.
            // unique() metodu ile her kullanıcının sadece bir hakkımda kaydı olması sağlanır (bire-bir ilişki).
            // cascadeOnDelete() metodu, ana kullanıcı silindiğinde ilgili hakkımda kaydının da silinmesini sağlar.
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();

            // Hakkımda bölümünün başlığı
            $table->string('title');

            // Hakkımda bölümünün detaylı açıklaması. 'text' tipi uzun metinler için uygundur.
            $table->text('description');

            // Kullanıcının CV dosyasının URL'si. Boş olabilir.
            $table->string('cv_url')->nullable();

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
