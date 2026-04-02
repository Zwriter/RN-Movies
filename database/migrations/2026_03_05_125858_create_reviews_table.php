<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->integer('rating');
            $table->text('review');
            $table->unsignedBigInteger('movieID');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('movieID')->references('id')->on('movies')->onDelete('cascade');
            $table->timestamps();

            $table->index(['user', 'movieID']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};