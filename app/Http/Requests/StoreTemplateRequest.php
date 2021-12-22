<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTemplateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'open_url' => 'nullable|url',
            'deeplink' => 'nullable|string',
            'title' => 'required|array',
            'body' => 'required|array',
            'title.1' => 'required|string',
            'body.1' => 'required|string'
        ];
    }
}
