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
            'sender_id' => 'required_unless:platform_id,2|nullable|integer',
            'server_key' => 'required_unless:platform_id,2|string|size:152|regex:/AAAA[A-Za-z0-9_-]{7}:[A-Za-z0-9_-]{140}/',
            'bundle' => 'required_if:platform_id,2|nullable|string',
            'certificate' => 'required_if:platform_id,2|nullable|file',
            'private_key' => 'nullable|string',
            'site_name' => 'required_if:platform_id,3|nullable|string',
            'site_url' => 'required_if:platform_id,3|nullable|active_url',
            'safari_web_id' => 'nullable|string|unique:apps,safari_web_id',
            'web_certificate' => 'nullable|file',
            'web_private_key' => 'nullable|string',
            'web_icon' => 'required_if:platform_id,3|nullable|image|mimetypes:image/png',
            'platform_id' => 'required|integer|max:3|min:1'
        ];
    }
}
