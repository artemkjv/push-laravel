<?php

namespace App\Http\Requests;

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
            'app_id' => 'required|exists:apps,uuid',
            'platform_id' => 'required|exists:platforms,id',
            'country' => 'required|string|exists:countries,code',
            'language' => 'required|string|exists:languages,code',
            'timezone' => 'required|string|exists:timezones,name',
            'uuid' => 'nullable|uuid',
            'app_version' => 'nullable|string',
            'device_model' => 'nullable|string'
        ];
    }

}
