<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Tags;
use App\Models\Image;
use App\Models\Category;
use App\Models\TagAssigned;
use DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data = Blog::all('id');
        // return DataTables::of($data)
        //     ->addColumn(
        //         'id',
        //         function ($row) {
        //             return "ok";
        //         }
        //     )
        //     ->removeColumn('comments_count')
        //     ->removeColumn('comments')
        //     ->removeColumn('created_at')
        //     ->removeColumn('updated_at')
        // ->addColumn('action', function ($row) {

        //     $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

        //     return $btn;
        // })
        // ->rawColumns(['action'])
        // ->make(true);
        if ($request->ajax()) {
            $data = Blog::all('id');
            // return $data;
            return DataTables::of($data)
                ->addColumn(
                    'id',
                    function ($row) {
                        return "ok";
                    }
                )
                ->removeColumn('id')
                ->removeColumn('comments_count')
                ->removeColumn('comments')
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->make(true);
        }

        return view('blog/list_blog', ['blog' => Blog::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('blog/create_blog', ['categories' => Category::all(), 'tags' => Tags::all()]);
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
            'image' => 'bail|required|mimes:png,jpeg|unique:images,path',
        ]);

        try {
            $path = $request->file('image')->store('images');
            $image = Image::create([
                'path' => $path,
            ]);

            $blog = Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'category_id' => $request->category,
                'user_id' => auth()->id(),
                'image_id' => $image->id,
            ]);
            $tags = [];

            foreach ($request->tags as $value) {
                $tags[] = [
                    'tag_id' => $value,
                    'blog_id' => $blog->id,
                ];
            }

            $blog->tagsAssigned()->createMany($tags);

            return [
                'status' => true,
                'message' => "Blog saved successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => $ex->getMessage(),
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('blog/blog_details', ['blog' => Blog::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('blog/edit_blog', ['blog' => Blog::find($id), 'categories' => Category::all(), 'tags' => Tags::all()]);
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
            'image' => 'bail|mimes:png,jpeg|unique:images,path',
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
                $image = Image::create([
                    'path' => $path,
                ]);
                $data['image_id'] = $image->id;
            }

            $blog = Blog::find($id);
            $blog->tagsAssigned()->delete();
            $blog->update($data);

            $tags = [];

            foreach ($request->tags as $value) {
                $tags[] = [
                    'tag_id' => $value,
                    'blog_id' => $id,
                ];
            }

            $blog->tagsAssigned()->createMany($tags);

            return [
                'status' => true,
                'message' => "Blog updated successfully",
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => $ex->getMessage() . ' - ' . $ex->getLine(),
            ];
        }
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
            Blog::find($id)->delete();

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
}
