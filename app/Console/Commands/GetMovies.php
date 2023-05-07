<?php

namespace App\Console\Commands;

use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all populer movies from TMDB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for($i = 1 ; $i<= config('services.tmdb.page_max') ; $i++)
        {
            $response = Http::get(config('services.tmdb.base_url'). '/movie/popular?region=us&api_key=' .config('services.tmdb.api_key').'&language=en-US&page='.$i);
        
            foreach($response->json()['results'] as $result)
            {
                $movie = Movie::create([
                    'e_id'         => $result['id'],
                    'title'        => $result['original_title'],
                    'description'  => $result['overview'],
                    'poster'       => $result['poster_path'],
                    'banner'       => $result['backdrop_path'],
                    'release_data' => $result['release_date'],
                    'vote'         => $result['vote_average'],
                    'vote_count'   => $result['vote_count'],
                ]);
                    
                foreach($result['genre_ids'] as $result1)
                {
                    $genre = Genre::where('e_id', $result1)->first();
                    $movie->genres()->attach($genre->id); 
                }
            }
        }
        
    }
}
