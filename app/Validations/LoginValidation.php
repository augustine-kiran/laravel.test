<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class LoginValidation
{
    /**
     * Validate request for user login
     * 
     * @param $request
     * @return $redirect with errors
     */
    public static function validateLogin($request)
    {
        Validator::make($request->all(), [
            'username' => 'required|min:6|max:25',
            'password' => 'required|min:6|max:25',
        ])->validate();
    }
}
