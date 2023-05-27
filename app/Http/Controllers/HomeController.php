<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $latestMovies = Movie::limit(10)->orderBy('release_data', 'desc')->get();
        
        
        return view('home' , compact('latestMovies'));
    }


    public function statistics()
    {
        $genreCount = number_format(Genre::count() , 1) ;
        $movieCount = number_format(Movie::count() , 1) ;
        $actorCount = number_format(Actor::count() , 1) ;

        return response()->json([
            'genreCount' => $genreCount,
            'movieCount' => $movieCount,
            'actorCount' => $actorCount
        ]);
    }
}
