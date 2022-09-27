<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tag/list_tags', ['tags' => Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('tag/create_tag');
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
            'tag_name' => 'bail|required|unique:tags,name|max:25',
        ]);

        try {
            Tag::create([
                'name' => $request->tag_name,
            ]);

            $status = [
                'status' => true,
                'message' => "Tag saved successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Tag saved not successful",
            ];
        }

        return redirect(url('tags'))->with(['status' => $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('tag/tag_details', ['tag' => Tag::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('tag/edit_tag', ['tag' => Tag::findOrFail($id)]);
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
            'tag_name' => 'bail|required|unique:tags,name,' . $id . '|max:25',
        ]);

        try {
            Tag::findOrFail($id)->update([
                'name' => $request->tag_name,
            ]);

            $status = [
                'status' => true,
                'message' => "Tag updated successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Tag updation not successful",
            ];
        }

        return redirect(url('tags'))->with(['status' => $status]);
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
            Tag::findOrFail($id)->delete();

            $status = [
                'status' => true,
                'message' => "Tag deleted successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Tag deletion not successful",
            ];
        }

        return redirect(url('tags'))->with(['status' => $status]);
    }
}
