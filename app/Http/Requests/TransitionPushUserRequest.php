<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransitionPushUserRequest extends FormRequest
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
            'push_type' => 'required|string',
            'push_id' => 'required|integer'
        ];
    }
}
