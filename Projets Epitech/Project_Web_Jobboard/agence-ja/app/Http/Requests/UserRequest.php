<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'role' => 'required|min:1|max:2',
            'password' => 'required|min:8|max:32|confirmed',
            'password_confirmation' => 'required|min:8|max:32',
            'email' => 'required|email|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'age' => 'required',
        ];
    }
}