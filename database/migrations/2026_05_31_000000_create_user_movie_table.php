<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_movie', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->boolean('watchlist')->default(false);
            $table->boolean('watched')->default(false);
            $table->boolean('favorite')->default(false);
            $table->timestamp('watched_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'movie_id']);
            $table->index('watchlist');
            $table->index('watched');
            $table->index('favorite');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_movie');
    }
};
