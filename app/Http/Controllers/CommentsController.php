<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->validate($request, [
            'blog_id' => 'required|numeric',
            'comment' => 'required:min:2',
        ]);

        try {
            Comments::create([
                'blog_id' => $request->blog_id,
                'comment' => $request->comment,
                'user_id' => auth()->id(),
            ]);

            $status = [
                'status' => true,
                'message' => "Comment saved successfully",
            ];
        } catch (\Exception $ex) {
            $status = [
                'status' => false,
                'message' => $ex->getMessage(),
            ];
        }

        return redirect(url('blog/' . $request->blog_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $comment = Comments::find($id);
        $blog_id = $comment->blog_id;
        $comment->delete();
        return redirect(url('blog/' . $blog_id));
    }
}
