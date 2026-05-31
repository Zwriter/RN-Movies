<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieSearchController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\GenreController as AdminGenreController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/', \App\Livewire\Welcome::class)->name('movies.top-rated');

Route::get('/movies', \App\Livewire\Movies::class)->name('movies.index');
Route::get('/movies/search', [MovieSearchController::class, 'search'])->name('movies.search');
Route::get('/movies/{movie}', \App\Livewire\Movie::class)->name('movies.show');

Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/movies/{movie}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::post('/movies/{movie}/watchlist', [MovieController::class, 'toggleWatchlist'])->name('movies.watchlist.toggle');
    Route::post('/movies/{movie}/favorites', [MovieController::class, 'toggleFavorite'])->name('movies.favorites.toggle');
    Route::post('/movies/{movie}/watched', [MovieController::class, 'markWatched'])->name('movies.watched.toggle');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('movies', AdminMovieController::class)->except(['show']);
    Route::resource('genres', AdminGenreController::class)->except(['show']);
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);
    Route::resource('users', AdminUserController::class)->except(['create', 'store', 'show']);
});

