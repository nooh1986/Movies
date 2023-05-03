<?php

namespace App\Console\Commands;

use App\Models\Genre;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all genre from TMDB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get(config('services.tmdb.base_url'). '/genre/movie/list?api_key=' .config('services.tmdb.api_key'));
        //dd($response->json()['genres']);
        foreach($response->json()['genres'] as $genre)
        {
            Genre::create([
                'e_id' => $genre['id'],
                'name' => $genre['name']
            ]);
        }
    }
}
