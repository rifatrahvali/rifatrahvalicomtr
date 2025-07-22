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
                Schema::create('certificates', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // user_id sütunu, bu sertifikanın hangi kullanıcıya ait olduğunu belirtir.
            // cascadeOnDelete() metodu, ana kullanıcı silindiğinde ilgili tüm sertifika kayıtlarının da silinmesini sağlar.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Sertifikanın veya kursun adı
            $table->string('name');

            // Sertifikayı veren kurum veya kuruluş
            $table->string('issuing_organization');

            // Sertifikanın alındığı tarih
            $table->date('issue_date');

            // Sertifikanın son geçerlilik tarihi. Eğer süresiz ise bu alan boş bırakılır.
            $table->date('expiration_date')->nullable();

            // Sertifika kimlik numarası veya kodu. Boş olabilir.
            $table->string('credential_id')->nullable();

            // Sertifikanın doğrulanabileceği URL adresi. Boş olabilir.
            $table->string('credential_url')->nullable();

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
