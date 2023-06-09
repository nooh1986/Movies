<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MovieController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $actors = Actor::all();
        return view('moives.index' , compact('genres' , 'actors'));
    }

    public function data()
    {
        $genre_id = request()->genre_id;
        $actor_id = request()->actor_id;
        $movies = Movie::with(['genres']);

        if ($genre_id) {
            $movies->whereHas('genres', function ($query) use ($genre_id) {
                $query->where('genres.id', $genre_id);
            });
        }

        if ($actor_id) {
            $movies->whereHas('actors', function ($query) use ($actor_id) {
                $query->where('actors.id', $actor_id);
            });
        }

        return DataTables::of($movies)
            ->addColumn('record_select', 'moives.data_table.record_select')

            ->addColumn('poster', function (Movie $movie){   
                return view('moives.data_table.poster' , compact('movie'));
            })

            ->addColumn('genres', function (Movie $movie){   
                return view('moives.data_table.genres' , compact('movie'));
            })

            ->addColumn('vote', 'moives.data_table.vote')

            ->addColumn('actions', 'moives.data_table.actions')

            ->rawColumns(['record_select','vote' ,'actions'])

            ->toJson();

    }// end of data


    public function show(Movie $movie)
    {
        $movie->load(['genres','actors','images']);
        return view('moives.show', compact('movie'));
    }

    public function destroy(Movie $movie)
    {
        $this->delete($movie);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $movie = Movie::FindOrFail($recordId);
            $this->delete($movie);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Movie $movie)
    {
        $movie->delete();

    }// end of delete
}
