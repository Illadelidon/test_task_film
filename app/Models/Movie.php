<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'is_published', 'poster_url'];

    // Зв'язок багато до багатьох з жанрами
    public function genres()
    {
        return $this->belongsToMany(Genre::class,'movie_genre' );
    }
}
