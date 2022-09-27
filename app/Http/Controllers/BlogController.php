<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('blog/list_blog', ['blog' => Blog::all(), 'categories' => Category::all(), 'tags' => Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('blog/create_blog', ['categories' => Category::all(), 'tags' => Tag::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'bail|required|max:25',
            'content' => 'bail|required',
            'category' => 'bail|required|exists:categories,id',
            'tags' => 'bail|required|array|exists:tags,id',
            'image' => 'bail|required|mimes:png,jpeg|unique:blogs,image_path',
        ]);

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

            $status = [
                'status' => true,
                'message' => "Blog saved successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => $ex->getMessage() . $ex->getLine(), // "Blog saved not successful",
            ];
        }

        return redirect(url('blog'))->with(['status' => $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blog/blog_details', ['blog' => Blog::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blog/edit_blog', ['blog' => Blog::findOrFail($id), 'categories' => Category::all(), 'tags' => Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'bail|required|max:25',
            'content' => 'bail|required',
            'category' => 'bail|required|exists:categories,id',
            'tags' => 'bail|required|array|exists:tags,id',
            'image' => 'bail|mimes:png,jpeg|unique:blogs,image_path',
        ]);

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

            $status = [
                'status' => true,
                'message' => "Blog updated successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Blog updation not successful",
            ];
        }

        return redirect(url('blog'))->with(['status' => $status]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Blog::findOrFail($id)->delete();

            $status = [
                'status' => true,
                'message' => "Blog deleted successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Blog deletion not successful",
            ];
        }

        return redirect(url('blog'))->with(['status' => $status]);
    }

    /**
     * This function returns blog list and it's details
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array $data
     */
    public function getBlogList(Request $request)
    {
        // return $request->tag;
        $output['data'] = [];

        $data = Blog::query();

        if (!empty($request->category)) {
            $data = $data->whereIn('category_id', $request->categories);
        }

        if (!empty($request->tag)) {
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

        return response()->json($output);
    }
}
