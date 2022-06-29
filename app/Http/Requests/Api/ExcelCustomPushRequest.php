<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\BaseRequest\JsonRequest;

class ExcelCustomPushRequest extends JsonRequest
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
            'open_url' => 'nullable|string',
            'deeplink' => 'nullable|string',
            'title' => 'required|array',
            'body' => 'required|array',
            'tag_key' => 'nullable|string',
            'tag_value' => 'nullable|string',
            'country_id' => 'nullable|int|exists:countries,id',
            'title.1' => 'required|string',
            'body.1' => 'required|string',
            'image' => 'nullable|string',
            'icon' => 'nullable|string',
            'time_to_live' => 'nullable|integer',
            'time_to_send' => 'date_format:Y-m-d\TH:i',
        ];
    }
}
