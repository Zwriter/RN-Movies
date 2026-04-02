<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'sex',
        'img',
        'birthDay',
    ];
    protected $casts = [
        'birthDay' => 'date',
    ];

    public function movies()
    {
         return $this->belongsToMany(Movie::class,'movie-person');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
