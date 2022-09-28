<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class UserValidation
{
    /**
     * Validate request for category creation
     * 
     * @param $request
     * @return $redirect with errors
     */
    public static function validateCreateUser($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:25|min:6',
            'username' => 'required|max:25|min:6',
            'password' => 'required|confirmed|max:25|min:6',
        ])->validate();
    }
}
