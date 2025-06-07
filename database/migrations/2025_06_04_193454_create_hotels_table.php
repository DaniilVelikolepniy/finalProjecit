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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id()->nullable(false);
            $table->timestamps();
            $table->tinyText('name')->nullable(false)->comment('Название отеля (до 255 байт)');
            $table->text('description')->nullable(true)->comment('Описание отеля');
            $table->text('poster_url')->nullable(true)->comment('Ссылка на изображение отеля');
            $table->text('address')->nullable(true)->comment('Ссылка на изображение отеля');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
