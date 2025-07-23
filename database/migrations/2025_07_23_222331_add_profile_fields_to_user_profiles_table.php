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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('first_name')->nullable(); // Türkçe: Kullanıcının adı
            $table->string('last_name')->nullable(); // Türkçe: Kullanıcının soyadı
            $table->string('title')->nullable(); // Türkçe: Kullanıcının unvanı
            $table->string('phone')->nullable(); // Türkçe: Kullanıcının telefon numarası
            $table->string('website')->nullable(); // Türkçe: Kullanıcının web sitesi
            $table->string('address')->nullable(); // Türkçe: Kullanıcının adresi
            $table->string('profile_image')->nullable(); // Türkçe: Kullanıcının profil fotoğrafı
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'title', 'phone', 'website', 'address', 'profile_image']);
            // Türkçe: Eklenen alanlar geri alındı.
        });
    }
};
