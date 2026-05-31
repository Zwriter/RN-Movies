<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'URL',
        'title',
    ];

    public function person()
    {
        return $this->hasMany(Person::class, 'imageURL');
    }

    public function movie()
    {
        return $this->hasMany(Movie::class, 'poster_id');
    }

    public function genre()
    {
        return $this->hasMany(Genre::class, 'posterURL');
    }
}
