<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PushAppRequest extends FormRequest
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
            'auto_pushes' => 'nullable|array|exists:auto_pushes,id',
            'custom_pushes' => 'nullable|array|exists:custom_pushes,id',
            'weekly_pushes' => 'nullable|array'
        ];
    }
}
