<?php

namespace App\Http\Requests\ApiToken;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'expires_at' => 'required|date_format:Y-m-d',
            'actions' => 'required|array',
            'actions.*' => 'int|exists:api_pages,id'
        ];
    }
}
