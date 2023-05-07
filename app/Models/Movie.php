<?php

namespace App\Models;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function genres()
    {
        return $this->belongsToMany(Genre::class , 'movie_genre');
    }


    protected $appends = ['poster_path' , 'banner_path'];

    public function getPosterPathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500' . $this->poster;
    }

    public function getBannerPathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500' . $this->banner;
    }
}
