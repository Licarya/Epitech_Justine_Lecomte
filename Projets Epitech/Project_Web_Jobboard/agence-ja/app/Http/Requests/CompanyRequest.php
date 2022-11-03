<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            'name' => 'nullable',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user()->id)],
            'description' => 'nullable',
            'country' => 'nullable|max:45',
            'city' => 'nullable|max:45',
            'postal_code' => 'nullable|max:5',
            'address1' => 'nullable|max:100',
            'address2' => 'nullable|max:100',
        ];
    }
}
