<?php

namespace App\Http\Requests;

use App\Rules\RelatedWithUser;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAutoPushRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'apps' => 'required|array',
            'segments' => 'required|array',
            'template_id' => ['required', 'integer', new RelatedWithUser('templates')],
            'status' => 'required|string',
            'time_to_live' => 'nullable|integer',
            'interval_value' => 'required|integer',
            'interval_type' => 'required|string'
        ];
    }
}
