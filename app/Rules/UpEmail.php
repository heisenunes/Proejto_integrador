<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UpEmail implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // return substr($value, strpos($value, '@') + 1) === 'up.pt';
        return substr($value, -5) ==='up.pt';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.custom.up_email');
    }
}
