<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ActorController extends Controller
{
    public function index()
    {
        return view('actores.index');
    }

    public function data()
    {
        $actores = Actor::withCount(['movies']);

        return DataTables::of($actores)
            ->addColumn('record_select', 'actores.data_table.record_select')

            ->addColumn('profile', function (Actor $actor){   
                return view('actores.data_table.profile' , compact('actor'));
            })

            ->addColumn('actions', 'actores.data_table.actions')

            ->rawColumns(['record_select','actions'])
            ->toJson();

    }// end of data
}
