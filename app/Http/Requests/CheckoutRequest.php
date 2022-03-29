<?php

namespace App\Http\Requests;

use App\Rules\CreditCardExpiration;
use App\Rules\CreditCardNumber;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'company_name' => 'required|string',
            'billing_email' => 'required|email',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'card_number' => ['required', 'string', new CreditCardNumber()],
            'card_expiration' => ['required', 'string', new CreditCardExpiration()],
            'card_cvv' => 'required|integer|digits:3',
            'street_address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'postcode' => 'required|string',
        ];
    }
}
