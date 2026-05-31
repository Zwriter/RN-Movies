<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support dropColumn reliably; recreate table without watched_at
        DB::statement('PRAGMA foreign_keys=OFF');

        Schema::create('user_movie_tmp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('movie_id')->constrained()->cascadeOnDelete();
            $table->boolean('watchlist')->default(false);
            $table->boolean('watched')->default(false);
            $table->boolean('favorite')->default(false);
            $table->timestamps();
            $table->unique(['user_id', 'movie_id']);
            $table->index('watchlist');
            $table->index('watched');
            $table->index('favorite');
        });

        // Copy data from old table to new table (exclude watched_at)
        $columns = ['id','user_id','movie_id','watchlist','watched','favorite','created_at','updated_at'];
        $cols = implode(',', $columns);
        DB::statement("INSERT INTO user_movie_tmp ($cols) SELECT $cols FROM user_movie");

        Schema::dropIfExists('user_movie');
        Schema::rename('user_movie_tmp', 'user_movie');

        DB::statement('PRAGMA foreign_keys=ON');
    }

    public function down(): void
    {
        // Recreate original table with watched_at column
        DB::statement('PRAGMA foreign_keys=OFF');

        Schema::create('user_movie_tmp', function (Blueprint $table) {
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

        $columns = ['id','user_id','movie_id','watchlist','watched','favorite','created_at','updated_at'];
        $cols = implode(',', $columns);
        DB::statement("INSERT INTO user_movie_tmp ($cols) SELECT $cols FROM user_movie");

        Schema::dropIfExists('user_movie');
        Schema::rename('user_movie_tmp', 'user_movie');

        DB::statement('PRAGMA foreign_keys=ON');
    }
};
