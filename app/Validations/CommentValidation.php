<?php

namespace App\Validations;

use Illuminate\Support\Facades\Validator;

class CommentValidation
{
    /**
     * Validate request for comment creation
     * 
     * @param $request
     * @return $redirect with errors
     */
    public static function validateCreateComment($request)
    {
        Validator::make($request->all(), [
            'blog_id' => 'required|numeric|exists:blogs,id',
            'comment' => 'required:min:2',
        ])->validate();
    }
}
