<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class CategoryValidation
{
    /**
     * Validate request for category creation
     * 
     * @param $request
     * @return $redirect with errors
     */
    public static function validateCreateCategory($request)
    {
        Validator::make($request->all(), [
            'category_name' => 'bail|required|unique:categories,name|max:25',
        ])->validate();
    }

    /**
     * Validate request for category updation
     * 
     * @param $request, $id
     * @return $redirect with errors
     */
    public static function validateUpdateCategory($request, $id)
    {
        Validator::make($request->all(), [
            'category_name' => 'bail|required|unique:categories,name,' . $id . '|max:25',
        ])->validate();
    }
}
