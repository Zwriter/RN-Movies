<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('genre_movie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movieID');
            $table->unsignedBigInteger('genreID');
            $table->foreign('movieID')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('genreID')->references('id')->on('genres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genre_movie');
    }
};