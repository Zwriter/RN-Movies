<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 60);
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->year('year');
            $table->integer('runtime');
            $table->integer('favorites')->nullable();
            $table->string('plot', 300);
            $table->unsignedBigInteger('poster_id');
            $table->unsignedBigInteger('director_id');
            $table->foreign('poster_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('director_id')->references('id')->on('people')->onDelete('cascade');
            $table->timestamps();

            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
