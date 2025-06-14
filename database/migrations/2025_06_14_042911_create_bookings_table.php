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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id()->comment('Первичный ключ');

            $table->foreignId('room_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID номера из таблицы rooms');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('ID пользователя из таблицы users');

            $table->timestamp('started_at')->comment('Дата и время начала бронирования');
            $table->timestamp('finished_at')->comment('Дата и время окончания бронирования');
            $table->integer('days')->comment('Количество дней бронирования');
            $table->decimal('price', 8, 2)->comment('Общая стоимость бронирования');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
