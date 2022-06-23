<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateAppRequest extends FormRequest
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
            'sender_id' => [
                Rule::requiredIf(
                    fn() => in_array(1, $this->post('platforms', []))
                        || in_array(3, $this->post('platforms', []))
                ),
                'nullable',
                'integer'
            ],
            'server_key' => [
                Rule::requiredIf(
                    fn() => in_array(1, $this->post('platforms', []))
                        || in_array(3, $this->post('platforms', []))
                ),
                'nullable',
                'string',
                'size:152',
                'regex:/AAAA[A-Za-z0-9_-]{7}:[A-Za-z0-9_-]{140}/'
            ],
            'bundle' => [
                Rule::requiredIf(fn() => in_array(2, $this->post('platforms', []))),
                'nullable',
                'string'
            ],
            'certificate' => ['nullable', 'file'],
            'private_key' => 'nullable|string',
            'site_name' => [
                Rule::requiredIf(fn() => in_array(3, $this->post('platforms', []))),
                'nullable',
                'string'
            ],
            'site_url' => [
                Rule::requiredIf(fn() => in_array(3, $this->post('platforms', []))),
                'nullable',
                'active_url'
            ],
            'safari_web_id' => 'nullable|string|unique:apps,safari_web_id',
            'web_certificate' => ['nullable', 'file'],
            'web_private_key' => 'nullable|string',
            'web_icon' => ['nullable', 'image', 'mimetypes:image/png'],
            'platforms' => 'required|array'
        ];
    }
}
