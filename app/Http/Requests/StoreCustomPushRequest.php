<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCustomPushRequest extends FormRequest
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
            'apps' => 'required|array',
            'segments' => 'required|array',
            'open_url' => 'nullable|url',
            'deeplink' => 'nullable|string',
            'title' => 'required|array',
            'body' => 'required|array',
            'title.1' => 'required|string',
            'body.1' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png|dimensions:max_width=100,max_height=100,ratio=1/1',
            'time_to_live' => 'nullable|integer',
            'time_to_send' => 'date_format:Y-m-d\TH:i',
            'is_test' => 'nullable'
        ];
    }
}
