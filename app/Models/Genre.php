<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre',
        'title',
        'description',
        'img',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class,'genre-movie');
    }

    public function images()
    {
        return $this->hasOne(Image::class);
    }
}
