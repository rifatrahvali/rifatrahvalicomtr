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
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Benzersiz ID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kullanıcıya ait olduğunu belirtir ve kullanıcı silindiğinde kursları da siler
            $table->string('name'); // Kursun adı
            $table->string('organization'); // Kursu veren kurum
            $table->date('completion_date'); // Tamamlanma tarihi
            $table->string('credential_url')->nullable(); // Sertifika URL'si (isteğe bağlı)
            $table->timestamps(); // Oluşturulma ve güncellenme zamanları
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
