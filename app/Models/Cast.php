<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $table = 'cast';
    protected $fillable = ['realname', 'moviename', 'profile_url'];
}
