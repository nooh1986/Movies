<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\MoiveResource;

class MoiveController extends Controller
{
    public function index()
    {
        $movies = Movie::paginate(10);
        $data['movies'] = MoiveResource::collection($movies)->response()->getData(true);
        return response()->api($data);
    }


    public function images(Movie $movie)
    {
        $data = ImageResource::collection($movie->images);
        return response()->api($data);
    }


    public function actors(Movie $movie)
    {
        $data = ActorResource::collection($movie->actors);
        return response()->api($data);
    }


    public function related_movie(Movie $movie)
    {
        $movies = Movie::whereHas('genres' , function($q) use ($movie){
            return $q->whereIn('name',$movie->genres()->pluck('name')); 
        })
        ->where('id' , '!=' , $movie->id )
        ->paginate(10);

        $data = MoiveResource::collection($movies);
        return response()->api($data);
    }
}
