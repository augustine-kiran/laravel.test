<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    /**
     * Function for creating a new category
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function createCategory($request)
    {
        try {
            Category::create([
                'name' => $request->category_name,
            ]);

            return [
                'status' => true,
                'message' => "Category saved successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Category saved not successful",
            ];
        }
    }

    /**
     * Function for updating a category
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function updateCategory($request, $id)
    {
        try {
            Category::findOrFail($id)->update([
                'name' => $request->category_name,
            ]);

            return [
                'status' => true,
                'message' => "Category updated successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Category updation not successful",
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
    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);

            if ($category->blog()->exists()) {
                return [
                    'status' => false,
                    'message' => "Cannot delete category due to blogs are exist in this category",
                ];
            }

            $category->delete();

            return [
                'status' => true,
                'message' => "Category deleted successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Category deletion not successful",
            ];
        }
    }
}
