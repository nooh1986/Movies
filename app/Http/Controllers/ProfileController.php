<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    
    public function edit()
    {
        return view('profile.edit');
    }


    public function update(ProfileUpdateRequest $request)
    {
        $data = $request->validated();

        auth()->user()->update($data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('home');
    }

    
}
