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
        return $this->belongsToOne(Person::class);
    }

    public function movie()
    {
        return $this->belongsToOne(Movie::class);
    }

    public function genre()
    {
        return $this->belongsToOne(Genre::class);
    }
}
