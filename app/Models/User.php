<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function getRoleAttribute(): string
    {
        return $this->is_admin ? 'admin' : 'user';
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isUser(): bool
    {
        return ! $this->is_admin;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'user');
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'user_movie')
            ->withPivot('watchlist', 'watched', 'favorite')
            ->withTimestamps();
    }

    public function watchlistMovies()
    {
        return $this->movies()->wherePivot('watchlist', true);
    }

    public function watchedMovies()
    {
        return $this->movies()->wherePivot('watched', true)->orderByDesc('user_movie.updated_at');
    }

    public function favoriteMovies()
    {
        return $this->movies()->wherePivot('favorite', true);
    }

    public function movieStatus(Movie $movie)
    {
        return $this->movies()->wherePivot('movie_id', $movie->id)->first();
    }
}
