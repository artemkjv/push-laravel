<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RelatedWithUser implements Rule
{
    private $table;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table)
    {
        $this->table = $table;
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
        $user = request()->user();
        if(is_null($user->admin)){
            $entity = DB::table($this->table)
                ->where('id', $value)
                ->where('user_id', $user->id)
                ->first();
        } else{
            $entity = null;
        }
        return !is_null($entity);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute should be related with current user.';
    }
}
