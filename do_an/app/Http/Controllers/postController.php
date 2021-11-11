<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;


class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::all();
        return view('post.profile', ['posts'=> $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newImageName = time() .'.'. $request->image->extension();
        $request->image->move(public_path('images'),$newImageName);
        $posts = post::create([  
            'username' => $request->input('username'),
            'n_likes' => $request->input('n_likes'),
            'description' => $request->input('description'),
            'image_path' => $newImageName
        ]);
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
        $posts = post::find($id)->first();
        return view('post.edit',['posts'=>$posts]);
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
        $posts = post::where('id', $id)
            ->update([  
            'username' => $request->input('username'),
            'n_likes' => $request->input('n_likes'),
            'description' => $request->input('description'),
        ]);
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = post::find($id)->first();
        $posts->delete();

        return redirect('/profile');
    }
}
