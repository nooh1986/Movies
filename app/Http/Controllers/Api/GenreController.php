<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Http\Resources\MoiveResource;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $data['genres'] = GenreResource::collection($genres);
        return response()->api($data);
    }


    public function movie(Genre $genre)
    {
        $movies = Movie::
        with(['genres'])
        ->where('genres->id' , $genre)->paginate(10);
        $data['movies'] = MoiveResource::collection($movies)->response()->getData(true);
        return response()->api($data);
    }


    public function movies(Genre $genre)
    {
        $movies = Movie::with(['genres'])->whereHas('genres', function ($query) use ($genre) {
            $query->where('id', $genre->id);
        })->paginate(10);

        $data = MoiveResource::collection($movies)->response()->getData(true);
        
        return response()->api($data);
    }
}
