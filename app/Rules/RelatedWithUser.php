<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class RelatedWithUser implements Rule
{
    private $modelName;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($modelName)
    {
        $this->modelName = $modelName;
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
        switch ($user->role){
            case config('roles.user'):
                $entity = $this->modelName::where('id', $value)
                    ->where('user_id', $user->id)
                    ->first();
                break;
            case config('roles.moderator'):
                $entity = DB::table('entityables')
                    ->where('user_id', $user->id)
                    ->where('entityable_type', $this->modelName)
                    ->where('entityable_id', $value)
                    ->first();
                break;
            case config('roles.manager'):
                $entity = $this->modelName::where('id', $value)
                    ->where('user_id', request()->currentUser ? request()->currentUser->id : $user->id)
                    ->first();
                break;
            case config('roles.admin'):
                $entity = $this->modelName::where('id', $value)
                    ->where('user_id', request()->currentUser ? request()->currentUser->id : $user->id)
                    ->first();
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
