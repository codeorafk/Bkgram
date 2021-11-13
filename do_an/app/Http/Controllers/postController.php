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
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $posts = auth()->user()->posts()->create([  
            'description' => $request->input('description'),
            'image_path' => $newImageName
        ]);
        return redirect('/user/'.auth()->user()->id);
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
        $posts = post::find($id);
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
        $newImageName = time() .'.'. $request->image->extension();
        $request->image->move(public_path('images'),$newImageName);
        $posts = post::where('id', $id)
            ->update([  
            'description' => $request->input('description'),
            'image_path' => $newImageName,
        ]);
        return redirect('/user/'.auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = post::find($id);
        $posts->delete();

        return redirect('/user/'.auth()->user()->id);
    }
}
