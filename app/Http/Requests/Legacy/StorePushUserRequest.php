<?php

namespace App\Http\Requests\Legacy;

use App\Http\Requests\BaseRequest\JsonRequest;

class StorePushUserRequest extends JsonRequest
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
            'registration_id' => 'required',
            'internal_id' => 'nullable|uuid',
            'app_id' => 'required|exists:apps,uuid',
            'platform_type' => 'required|exists:platforms,name',
            'country' => 'required|string|exists:countries,code',
            'language' => 'required|string|exists:languages,code',
            'timezone' => 'required|string|exists:timezones,name',
            'device_model' => 'nullable|string'
        ];
    }
}
