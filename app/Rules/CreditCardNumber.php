<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreditCardNumber implements Rule
{

    private const CREDIT_CARD_REGEX = <<<END
    ^(3[47][0-9]{13}|(6541|6556)[0-9]{12}
    |389[0-9]{11}|3(?:0[0-5]|[68][0-9])[0-9]
    {11}|65[4-9][0-9]{13}|64[4-9][0-9]{13}
    |6011[0-9]{12}|(622(?:12[6-9]|1[3-9][0-9]
    |[2-8][0-9][0-9]|9[01][0-9]|92[0-5])[0-9]
    {10})|63[7-9][0-9]{13}|(?:2131|1800|35\d
    {3})\d{11}|9[0-9]{15}|(6304|6706|6709|
    6771)[0-9]{12,15}|(5018|5020|5038|6304|
    6759|6761|6763)[0-9]{8,15}|(5[1-5][0-9]{14}
    |2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6]
    [0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))|
    (6334|6767)[0-9]{12}|(6334|6767)[0-9]{14}
    |(6334|6767)[0-9]{15}|(4903|4905|4911|4936|
    6333|6759)[0-9]{12}|(4903|4905|4911|4936
    |6333|6759)[0-9]{14}|(4903|4905|4911|4936|
    6333|6759)[0-9]{15}|564182[0-9]{10}|
    564182[0-9]{12}|564182[0-9]{13}|633110[0-9]
    {10}|633110[0-9]{12}|633110[0-9]{13}|(62
    [0-9]{14,17})|4[0-9]{12}(?:[0-9]{3})?|(
    ?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}))$^
    END;


    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = $res = preg_replace("/[^0-9]/", "", $value);
        return preg_match(self::CREDIT_CARD_REGEX, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong card number';
    }
}
