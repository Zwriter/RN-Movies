<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('genre', 30);
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('description', 600)->nullable();
            $table->unsignedBigInteger('posterURL');
            $table->foreign('posterURL')->references('id')->on('images')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genres');
    }
};