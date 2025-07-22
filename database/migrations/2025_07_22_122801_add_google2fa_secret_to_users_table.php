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
        // Bu fonksiyon, veritabanı şemasını güncelleyerek 'users' tablosuna yeni bir sütun ekler.
        Schema::table('users', function (Blueprint $table) {
            // 'google2fa_secret' sütunu, kullanıcının 2FA gizli anahtarını saklamak için kullanılır.
            // nullable() metodu, bu sütunun boş olabileceğini belirtir, çünkü 2FA varsayılan olarak aktif olmayabilir.
            // after('password') metodu, bu sütunun 'password' sütunundan sonra gelmesini sağlar.
            $table->text('google2fa_secret')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
        public function down(): void
    {
        // Bu fonksiyon, göçü geri alırken 'users' tablosundan 'google2fa_secret' sütununu kaldırır.
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google2fa_secret');
        });
    }
};
