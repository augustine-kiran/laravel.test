<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\TagAssigned;
use App\Models\Category;
use App\Models\Image;
use App\Models\Author;
use App\Models\Tags;
use App\Models\Comments;

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
    public function create(Request $request)
    {
        $author_id = Author::where('username', session('username'))->value('id');
        Comments::create([
            'blog_id' => $request->blog_id,
            'author_id' => $author_id,
            'comment' => $request->comment,
        ]);
        return redirect('blog/' . $request->blog_id);
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

        foreach ($request->tags as $key => $value) {
            TagAssigned::create([
                'tag_id' => $value,
                'blog_id' => $blog->id,
            ]);
        }

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
        return view('details', ['blog' => Blog::where('id', $id)->first()]);
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
        $tags = TagAssigned::where('blog_id', $id)->pluck('tag_id')->all();
        return view('updateBlog', [
            'blog' => $blog,
            'category' => Category::all(),
            'tags' => Tags::all(),
            'category_id' => $blog->category_id,
            'tag_ids' => $tags,
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

        TagAssigned::where('blog_id', $blog->id)->delete();
        foreach ($request->tags as $key => $value) {
            TagAssigned::firstOrCreate([
                'tag_id' => $value,
                'blog_id' => $blog->id,
            ]);
        }

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
        Comments::where('blog_id', $id)->delete();
        Blog::find($id)->delete();
        return redirect('/');
    }
}
