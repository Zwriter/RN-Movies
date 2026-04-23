<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'year', 
        'runtime', 
        'favorites', 
        'plot', 
        'posterURI', 
        'director_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movie) {
            if (empty($movie->slug)) {
                $movie->slug = \Illuminate\Support\Str::slug($movie->title);
            }
        });

        static::updating(function ($movie) {
            if ($movie->isDirty('title') && empty($movie->slug)) {
                $movie->slug = \Illuminate\Support\Str::slug($movie->title);
            }
        });
    }

    public function getRatingAttribute()
    {
        return $this->reviews->avg('rating') ?? 0;
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'genre_movie');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class,'movie_person');
    }

    public function poster()
    {
        return $this->hasOne(Image::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
