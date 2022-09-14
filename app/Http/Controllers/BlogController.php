<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\TagAssigned;
use App\Models\Category;
use App\Models\Image;
use App\Models\Author;
use App\Models\Tags;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('addBlog', ['category' => Category::all(), 'tags' => Tags::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->file('image')->store('images');

        $image = Image::create([
            'path' => $path,
        ]);

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'author_id' => Author::where('username', session('username'))->value('id'),
            'image_id' => $image->id,
        ]);

        TagAssigned::create([
            'tag_id' => $request->tags,
            'blog_id' => $blog->id,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('details', ['blog' => Blog::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::where('id', $id)->first();
        $tags = TagAssigned::where('blog_id', $id)->value('tag_id');
        return view('updateBlog', [
            'blog' => $blog,
            'category' => Category::all(),
            'tags' => Tags::all(),
            'category_id' => $blog->category_id,
            'tag_id' => $tags,
        ]);
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
        $blog = Blog::where('id', $id)->first();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->category_id = $request->category;
        // $blog->author_id = Author::where('username', session('username'))->value('id');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images');
            $image = Image::firstOrCreate([
                'path' => $path,
            ]);
            $blog->image_id = $image->id;
        }

        $blog->save();

        TagAssigned::firstOrCreate([
            'tag_id' => $request->tags,
            'blog_id' => $blog->id,
        ]);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TagAssigned::where('blog_id', $id)->delete();
        Blog::find($id)->delete();
        return redirect('/');
    }
}
