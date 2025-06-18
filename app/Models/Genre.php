<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genre';

    protected $fillable = ['name'];

    public function movie(){
        return $this->belongsToMany(Movie::class, 'movie_genre');
    }
}
