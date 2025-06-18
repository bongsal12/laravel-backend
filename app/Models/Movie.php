<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Movie extends Model
{
    protected $table = 'movie';
    protected $fillable = ['title', 'slug', 'overview', 'release_date', 'rating', 'runtime', 'is_movie', 'thumbnail_url', 'bg_url', 'director', 'writer', 'vdo_url', 'is_trending'];

    public function genre(){
        return $this->belongsToMany(Genre::class, 'movie_genre');
    }
}
