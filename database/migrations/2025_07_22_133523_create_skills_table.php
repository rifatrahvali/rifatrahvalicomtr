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
                Schema::create('skills', function (Blueprint $table) {
            // Otomatik artan primary key (id)
            $table->id();

            // Beceri adı. Her beceri benzersiz olmalıdır.
            $table->string('name')->unique();

            // created_at ve updated_at sütunlarını ekler
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
