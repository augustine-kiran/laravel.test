<?php

namespace App\Services;

use App\Models\Blog;

class BlogService
{
    /**
     * Function for creating a new blog
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function createBlog($request)
    {
        try {
            $path = $request->file('image')->store('images');
            $blog = Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category,
                'user_id' => auth()->id(),
                'image_path' => $path,
            ]);

            $blog->tags()->attach($request->tags);

            return [
                'status' => true,
                'message' => "Blog saved successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Blog saved not successful",
            ];
        }
    }

    /**
     * Function for updating a blog details
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function updateBlog($request, $id)
    {
        try {
            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category,
                'user_id' => auth()->id(),
            ];

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images');
                $data['image_path'] = $path;
            }

            $blog = Blog::findOrFail($id);
            $blog->update($data);
            $blog->tags()->sync($request->tags);

            return [
                'status' => true,
                'message' => "Blog updated successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Blog updation not successful",
            ];
        }
    }

    /**
     * Function for deleting a blog
     * 
     * @param $request
     * 
     * @return array $status = ['status' => true/false, 'message' => "message"]
     */
    public function deleteBlog($id)
    {
        try {
            Blog::findOrFail($id)->delete();

            return [
                'status' => true,
                'message' => "Blog deleted successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => "Blog deletion not successful",
            ];
        }
    }

    /**
     * Function for showing blog datatable
     * 
     * @param $request
     * 
     * @return array [
     *      'recordsTotal' => 0,
     *      'recordsFiltered' => 0,
     *      'data' => []
     *  ];
     */
    public function getBlogTableData($request)
    {
        try {
            $output['data'] = [];
            $data = Blog::query();

            if (!empty($request->categories)) {
                $data = $data->whereIn('category_id', $request->categories);
            }

            if (!empty($request->tags)) {
                $data = $data->WhereHas('tags', function ($query) use ($request) {
                    return $query->whereIn('tags.id', $request->tags);
                });
            }

            if (is_numeric($request->comments_count)) {
                $data = $data->has('comments', (int) $request->comments_count);
            }

            $data = $data->skip($request->start)
                ->take($request->length)
                ->get();

            $output['draw'] = $request->draw;
            $output['recordsTotal'] = Blog::count();
            $output['recordsFiltered'] = count($data);

            foreach ($data as $value) {
                $output['data'][] = [
                    $value->id,
                    $value->title,
                    $value->category->name,
                    $value->comments_count,
                    implode(', ', $value->tags()->pluck('name')->all()),
                    '<div class="row">
                        <form><a href="' . url('blog/' . $value->id . '/edit') . '" class="btn btn-primary">Edit</a></form>&nbsp;
                        <form><a href="' . url('blog/' . $value->id) . '" class="btn btn-info">View</a></form>&nbsp;
                        <form action="' . url('blog/' . $value->id) . '" method="POST" onsubmit="return confirm(\'Do you want to delete?\');">' . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger">Delete</button></form>
                    </div>',
                ];
            }

            return $output;
        } catch (\Exception $ex) {
            return [
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ];
        }
    }
}
