<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTariffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'is_default' => 'nullable',
            'max_apps' => 'required|integer',
            'max_segments' => 'required|integer',
            'max_templates' => 'required|integer',
            'max_pushes' => 'required|integer',
            'max_push_users' => 'required|integer'
        ];
    }
}