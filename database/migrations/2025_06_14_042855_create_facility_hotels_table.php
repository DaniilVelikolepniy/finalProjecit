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
        Schema::create('facility_hotels', function (Blueprint $table) {
            $table->id()->comment('Первичный ключ');
            $table->foreignId('facility_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID удобства из таблицы facilities');

            $table->foreignId('hotel_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID отеля из таблицы hotels');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_hotels');
    }
};
