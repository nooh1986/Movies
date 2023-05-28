<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('profile.password.edit');
    }


    public function update(Request $request)
    {
        $request->validate([
            'old_password' => ['required', new Password],
            'password' => 'required|confirmed'
        ]);

        $request->merge(['password' => bcrypt($request->password)]);

        auth()->user()->update($request->all());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('home');
    }
}
