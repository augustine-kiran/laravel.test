<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class TagValidation
{
    /**
     * Validate request for tag creation
     * 
     * @param $request
     * @return $redirect with errors
     */
    public static function validateCreateTag($request)
    {
        Validator::make($request->all(), [
            'tag_name' => 'bail|required|unique:tags,name|max:25',
        ])->validate();
    }

    /**
     * Validate request for tag updation
     * 
     * @param $request, id
     * @return $redirect with errors
     */
    public static function validateUpdateTag($request, $id)
    {
        Validator::make($request->all(), [
            'tag_name' => 'bail|required|unique:tags,name,' . $id . '|max:25',
        ])->validate();
    }
}
