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
        Schema::create('facility_rooms', function (Blueprint $table) {
            $table->id()->comment('Первичный ключ');

            $table->foreignId('facility_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID удобства из таблицы facilities');

            $table->foreignId('room_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID номера из таблицы rooms');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_rooms');
    }
};
