<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\Category;
use App\Validations\BlogValidation;
use App\Services\BlogService;

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
        BlogValidation::createBlogValidation($request);
        $blogService = new BlogService;
        return redirect(url('blog'))->with(['status' => $blogService->createBlog($request)]);
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
        BlogValidation::updateBlogValidation($request);
        $blogService = new BlogService;
        return redirect(url('blog'))->with(['status' => $blogService->updateBlog($request, $id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogService = new BlogService;
        return redirect(url('blog'))->with(['status' => $blogService->deleteBlog($id)]);
    }

    /**
     * This function returns blog list and it's details
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array $data
     */
    public function getBlogList(Request $request)
    {
        $blogService = new BlogService;
        return $blogService->getBlogTableData($request);
    }
}
