<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSegmentRequest extends FormRequest
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
            'group' => 'array|required',
            'group.*' => 'array',
            'group.*.*.filter_type_id' => 'required|integer|exists:filter_types,id',
            'group.*.*.predicate_id' => 'required|integer|exists:predicates,id',
            'group.*.*.value' => 'required',
            'group.*.*.tag_key' => 'required_if:group.*.*.filter_type_id,==,7'
        ];
    }
}
