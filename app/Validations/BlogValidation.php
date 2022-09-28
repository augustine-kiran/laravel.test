<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class BlogValidation
{
    /**
     * Validate request for blog creation
     * 
     * @param $request
     * @return $redirect with errors
     */
    public static function createBlogValidation($request)
    {
        Validator::make($request->all(), [
            'title' => 'bail|required|max:25|min:3',
            'content' => 'bail|required|min:3',
            'category' => 'bail|required|exists:categories,id',
            'tags' => 'bail|required|array|exists:tags,id',
            'image' => 'bail|required|mimes:png,jpeg|unique:blogs,image_path',
        ])->validate();
    }

    /**
     * Validate request for blog updation
     * 
     * @param $request
     * @return $redirect with errors
     */
    public static function updateBlogValidation($request)
    {
        Validator::make($request->all(), [
            'title' => 'bail|required|max:25|min:3',
            'content' => 'bail|required|min:3',
            'category' => 'bail|required|exists:categories,id',
            'tags' => 'bail|required|array|exists:tags,id',
            'image' => 'bail|mimes:png,jpeg|unique:blogs,image_path',
        ])->validate();
    }
}
