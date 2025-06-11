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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id()->comment('Первичный ключ (ID комнаты)');
            $table->string('name')->comment('Название комнаты');
            $table->text('description')->nullable()->comment('Описание комнаты');
            $table->text('poster_url')->nullable()->comment('Ссылка на изображение комнаты');
            $table->decimal('floor_area', 8, 2)->nullable()->comment('Площадь комнаты в квадратных метрах');
            $table->string('type')->comment('Тип комнаты (например, одноместная, люкс и т.д.)');
            $table->decimal('price', 8, 2)->comment('Стоимость комнаты за ночь');
            $table->foreignId('hotel_id')
                ->constrained('hotels')
                ->onDelete('cascade')
                ->comment('ID отеля, к которому принадлежит комната');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
