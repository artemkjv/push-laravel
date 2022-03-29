<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreditCardExpiration implements Rule
{
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
        $dateArray = explode('/', $value);
        $expMonth = array_shift($dateArray);
        $expYear = array_shift($dateArray);
        $expires = \DateTime::createFromFormat('my', $expMonth.$expYear);
        $now = new \DateTime();
        return $expires > $now;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Card has been expired';
    }
}
