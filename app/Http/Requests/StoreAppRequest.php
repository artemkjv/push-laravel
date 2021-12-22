<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAppRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'sender_id' => 'required|integer',
            'server_key' => 'required|string|size:152|regex:/AAAA[A-Za-z0-9_-]{7}:[A-Za-z0-9_-]{140}/',
            'platform_id' => 'required|integer|max:3|min:1'
        ];
    }
}
