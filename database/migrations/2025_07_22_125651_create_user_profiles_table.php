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
                Schema::create('user_profiles', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // user_id sütunu, users tablosu ile ilişki kurar.
            // Bu, her profilin bir kullanıcıya ait olmasını sağlar.
            // constrained() metodu, 'users' tablosundaki 'id' sütununa referans verir.
            // cascadeOnDelete() metodu, ilgili kullanıcı silindiğinde bu profilin de otomatik olarak silinmesini sağlar.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Kullanıcının profil fotoğrafının (avatar) yolunu saklar. Boş olabilir.
            $table->string('avatar')->nullable();

            // Kullanıcının biyografisini saklar. Uzun metinler için 'text' tipi kullanılır. Boş olabilir.
            $table->text('bio')->nullable();

            // Kullanıcının konum bilgisini saklar. Boş olabilir.
            $table->string('location')->nullable();

            // Kullanıcının kişisel web sitesi URL'sini saklar. Boş olabilir.
            $table->string('website_url')->nullable();

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
