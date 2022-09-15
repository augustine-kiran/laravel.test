<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tags;
use App\Models\TagAssigned;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('username')) {
            // session(['username' => $request->username]);
            Author::firstOrCreate([
                'username' => session('username'),
            ]);
        }

        if (session('username')) {
            return view('home', ['blogs' => Blog::all()]);
        } else {
            return view('login');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoryIds = Category::where('name', 'like', '%' . $id . '%')->pluck('id');
        $tagIds = Tags::where('name', 'like', '%' . $id . '%')->pluck('id');
        $blogIds = TagAssigned::whereIn('tag_id', $tagIds)->pluck('tag_id');
        $blog = Blog::where('title', 'like', '%' . $id . '%')
            ->orWhereIn('category_id', $categoryIds)
            ->orWhereIn('id', $blogIds)
            ->get();
        return view('home', ['blogs' => $blog, 'search' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
