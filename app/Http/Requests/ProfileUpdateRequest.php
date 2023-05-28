<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . auth()->user()->id,
        ];

        return $rules;

    }//end of rules
    
}
