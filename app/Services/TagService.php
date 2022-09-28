<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    /**
     * Function for creating a new tag
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function createTag($request)
    {
        try {
            Tag::create([
                'name' => $request->tag_name,
            ]);

            return [
                'status' => true,
                'message' => "Tag saved successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Tag saved not successful",
            ];
        }
    }

    /**
     * Function for updating a tag
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function updateTag($request, $id)
    {
        try {
            Tag::findOrFail($id)->update([
                'name' => $request->tag_name,
            ]);

            return [
                'status' => true,
                'message' => "Tag updated successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Tag updation not successful",
            ];
        }
    }

    /**
     * Function for deleting a tag
     * 
     * @param $id
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function deleteTag($id)
    {
        try {
            $tag = Tag::findOrFail($id);

            if ($tag->blog()->exists()) {
                return [
                    'status' => false,
                    'message' => "Cannot delete tag due to blogs are exist in this tag",
                ];
            }

            $tag->delete();

            return [
                'status' => true,
                'message' => "Tag deleted successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Tag deletion not successful",
            ];
        }
    }
}
