<?php

namespace App\Models;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Image;
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


    public function actors()
    {
        return $this->belongsToMany(Actor::class , 'actor_movie');
    }


    public function images()
    {
        return $this->hasMany(Image::class);
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
