<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title', 'genre_id', 'url_trailer', 'length', 'plot', 'year', 'country', 'director', 'uri_poster'
    ];
}
