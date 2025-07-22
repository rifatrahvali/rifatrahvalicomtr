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
                Schema::create('educations', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // user_id sütunu, bu eğitim bilgisinin hangi kullanıcıya ait olduğunu belirtir.
            // cascadeOnDelete() metodu, ana kullanıcı silindiğinde ilgili tüm eğitim kayıtlarının da silinmesini sağlar.
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Okulun adı (örn: "Boğaziçi Üniversitesi")
            $table->string('school');

            // Alınan derece veya unvan (örn: "Lisans", "Yüksek Lisans", "Doktora")
            $table->string('degree');

            // Çalışma alanı veya bölüm (örn: "Bilgisayar Mühendisliği")
            $table->string('field_of_study');

            // Eğitimle ilgili ek notlar veya açıklamalar. Boş olabilir.
            $table->text('description')->nullable();

            // Eğitime başlangıç tarihi
            $table->date('start_date');

            // Eğitimden mezuniyet veya ayrılış tarihi. Eğer kullanıcı hala devam ediyorsa bu alan boş bırakılır.
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
        Schema::dropIfExists('educations');
    }
};
