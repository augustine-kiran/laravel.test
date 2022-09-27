<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category/list_category', ['category' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category/create_category');
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
            'category_name' => 'bail|required|unique:categories,name|max:25',
        ]);

        try {
            Category::create([
                'name' => $request->category_name,
            ]);

            $status = [
                'status' => true,
                'message' => "Category saved successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Category saved not successful",
            ];
        }

        return redirect(url('category'))->with(['status' => $status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('category/category_details', ['category' => Category::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('category/edit_category', ['category' => Category::findOrFail($id)]);
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
            'category_name' => 'bail|required|unique:categories,name,' . $id . '|max:25',
        ]);

        try {
            Category::findOrFail($id)->update([
                'name' => $request->category_name,
            ]);

            $status = [
                'status' => true,
                'message' => "Category updated successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Category updation not successful",
            ];
        }

        return redirect(url('category'))->with(['status' => $status]);
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
            Category::findOrFail($id)->delete();

            $status = [
                'status' => true,
                'message' => "Category deleted successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => "Category deletion not successful",
            ];
        }

        return redirect(url('category'))->with(['status' => $status]);
    }
}
