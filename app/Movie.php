<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'genre',
        'year',
        'director',
        'yt_video_id',
        'length',
        'plot',
        'country',
        'uri_poster'
    ];
}
