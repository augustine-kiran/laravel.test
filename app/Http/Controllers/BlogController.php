<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Tags;
use App\Models\Image;
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
        if ($request->ajax()) {

            // return gettype($request->search['value']);





            $output['data'] = [];

            $data = Blog::where('title', 'like', '%' . $request->search['value'] . '%')
                ->orWhere('title', 'like', '%' . $request->search['value'] . '%')
                ->orWhereHas('category', function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->search['value'] . '%');
                })
                ->orWhereHas('tags', function ($query) use ($request) {
                    return $query->where('name', 'like', '%' . $request->search['value'] . '%');
                });

            if (is_numeric($request->search['value'])) {
                $data = $data->orHas('comments', '=', (int) $request->search['value']);
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
                    '<a href="' . url('blog/' . $value->id . '/edit') . '" class="btn btn-primary">Edit</a>
                    <a href="' . url('blog/' . $value->id) . '" class="btn btn-info">View</a>',
                ];
            }

            return response()->json($output);
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

            $status = [
                'status' => true,
                'message' => "Blog saved successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Blog saved not successful",
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
            Blog::find($id)->delete();

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
}
