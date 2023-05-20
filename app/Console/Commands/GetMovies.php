<?php

namespace App\Console\Commands;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Image;
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
                $movie = Movie::updateOrCreate(
                [
                    'e_id'         => $result['id'],
                    'title'        => $result['original_title'],
                ],
                [    
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
            
                $this->attachActors($movie);

                $this->attachImages($movie);
                
            }    
            
        }
    }    

    private function attachActors(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url') . '/movie/' . $movie->e_id . '/credits?api_key=' . config('services.tmdb.api_key'));

        foreach ($response->json()['cast'] as $index => $cast) {

            if ($cast['known_for_department'] != 'Acting') continue;

            if ($index == 12) break;

            $actor = Actor::where('e_id', $cast['id'])->first();

            if (!$actor) {

                $actor = Actor::create([
                    'e_id' => $cast['id'],
                    'name' => $cast['name'],
                    'profile' => $cast['profile_path'],
                ]);

            }//end of if

            $movie->actors()->syncWithoutDetaching($actor->id);    

        }//end of for each

    }// end of attachActors

    public function attachImages(Movie $movie)
    {
        $response = Http::get(config('services.tmdb.base_url') . '/movie/' . $movie->e_id . '/images?api_key=' . config('services.tmdb.api_key'));

        foreach ($response->json()['backdrops'] as $index => $img)
        {
            if($index == 8)
            {
                break;
            }
            Image::create([
                'movie_id' => $movie->id,
                'name' => $img['file_path']
            ]);
        }
    }
}
