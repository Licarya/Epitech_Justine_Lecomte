<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobAlertRequest extends FormRequest
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
            'title' => 'required|max:100',
            'job_type' => 'required',
            'content' => 'required',
            'wage' => 'nullable',
            'companies_id'=>'required',
            'secteur'=>'required',
        ];
    }
}
