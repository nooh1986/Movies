<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GenreController extends Controller
{
    public function index()
    {
        return view('genres.index');

    }// end of index

    public function data()
    {
        $genres = Genre::select();

        return DataTables::of($genres)
            ->addColumn('record_select', 'genres.data_table.record_select')
            ->editColumn('created_at', function (Genre $genre) {
                return $genre->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'genres.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function destroy(Genre $genre)
    {
        $this->delete($genre);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $genre = Genre::FindOrFail($recordId);
            $this->delete($genre);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Genre $genre)
    {
        $genre->delete();

    }// end of delete
}
