<?php

namespace App\Services;

use App\Models\Comments;

class CommentService
{
    /**
     * Function for creating a new comment
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function createComment($request)
    {
        try {
            Comments::create([
                'blog_id' => $request->blog_id,
                'comment' => $request->comment,
                'user_id' => auth()->id(),
            ]);

            return [
                'status' => true,
                'message' => "Comment saved successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => $ex->getMessage(),
            ];
        }
    }

    /**
     * Function for deleting a category
     * 
     * @param $id
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function deleteComment($id)
    {
        try {
            $comment = Comments::find($id);
            $blog_id = $comment->blog_id;
            $comment->delete();

            return [
                'status' => true,
                'message' => "Comment deleted successfully",
                'result' => $blog_id,
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Comment deletion not successful",
            ];
        }
    }
}
