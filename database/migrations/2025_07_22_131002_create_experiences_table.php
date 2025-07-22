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
                Schema::create('experiences', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // user_id sütunu, bu deneyimin hangi kullanıcıya ait olduğunu belirtir.
            // cascadeOnDelete() metodu, ana kullanıcı silindiğinde ilgili tüm deneyim kayıtlarının da silinmesini sağlar.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // İş pozisyonunun başlığı (örn: "Senior Software Engineer")
            $table->string('title');

            // Şirket adı
            $table->string('company');

            // Çalışılan konum (örn: "İstanbul, Türkiye"). Boş olabilir.
            $table->string('location')->nullable();

            // Çalışma türü (örn: "Tam Zamanlı", "Yarı Zamanlı", "Staj"). Boş olabilir.
            $table->string('employment_type')->nullable();

            // İş tanımı ve sorumluluklar. Uzun metinler için 'text' tipi kullanılır. Boş olabilir.
            $table->text('description')->nullable();

            // İşe başlangıç tarihi
            $table->date('start_date');

            // İşten ayrılış tarihi. Eğer kullanıcı hala bu pozisyonda çalışıyorsa bu alan boş bırakılır.
            $table->date('end_date')->nullable();

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
