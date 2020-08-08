<?php

namespace App\Custom;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{

    public function rules()
    {
        return [
            'username' => ['required', 'unique:users', 'min:10', 'max:100'],
            'first_name' => 'required|min:2|max:100',
            'last_name' => 'required|min:2|max:100',
            'email' => ['nullable', 'email', 'unique:users'],
            'password' => 'required|string|confirmed|min:8',
        ];
    }
}
