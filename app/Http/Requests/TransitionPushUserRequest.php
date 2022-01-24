<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest\JsonRequest;
use Illuminate\Foundation\Http\FormRequest;

class TransitionPushUserRequest extends JsonRequest
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
            'sent_push_id' => 'required|integer'
        ];
    }
}
