<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $latestMovies = Movie::limit(5)->orderBy('release_data', 'desc')->get();
        $mostRateds = Movie::limit(5)->orderBy('vote_count', 'desc')->get();
        $latestUsers = User::limit(5)->orderBy('created_at', 'desc')->get();

        return view('home' , compact('latestMovies','mostRateds','latestUsers'));
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
