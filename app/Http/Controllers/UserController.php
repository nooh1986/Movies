<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function data()
    {
        $users = User::select();

        return DataTables::of($users)
            ->addColumn('record_select', 'users.data_table.record_select')

            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })

            ->addColumn('actions', 'users.data_table.actions')
            
            ->rawColumns(['record_select','actions'])
            
            ->toJson();

    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $requset)
    {
        $user = $requset->validated();
        $user['password'] = bcrypt($requset->password);

        User::create($user);

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $requset , User $user)
    {
        $user->update($requset->validated());
        
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $this->delete($user);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    }

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId)
        {
            $user = User::FindOrFail($recordId);
            $this->delete($user);
        }

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));
    }

    private function delete(User $user)
    {
        $user->delete();
    } 
}
