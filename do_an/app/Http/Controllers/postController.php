<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Image;

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
        $image = $request->file('image');

        $newImageName = time() .'.'. $request->image->extension();
        $image_resize = Image::make($image->path());
        $image_resize->fit(1200, 1200)->save(public_path().'/images/'.$newImageName);
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

    public function updatePost(Request $request)
    {
        if($request->image == null){
            $id = $request->id;
            $posts = post::where('id', $id)
            ->update([  
            'description' => $request->input('description'),
            ]);
            return ['description' =>$request->input('description') ];
        };
        $image = $request->get('image');
        $newImageName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        $id = $request->id;
        $image_resize = Image::make($image);
        $image_resize->fit(1200, 1200)->save(public_path().'/images/'.$newImageName);
        $posts = post::where('id', $id)
            ->update([  
            'description' => $request->input('description'),
            'image_path' => $newImageName,
        ]);
        return ['image_path' => $newImageName, 'description' =>$request->input('description') ];
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
    public function deletePost(Request $request)
    {
        $id = $request->id;
        $posts = post::find($id);
        $posts->delete();

        return '/user/'.auth()->user()->id;
    }

    public function getPost($id){
        $posts = DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.name','users.imagePath','users.id', 'posts.*')
                ->where('users.id',$id)
                ->get();
        return $posts;
    }
    public function getPostHome($id){
        $Postfollowing = DB::table('user_user')
                    ->join('posts', 'user_user.profile_id', '=', 'posts.user_id')
                    ->join('users', 'user_user.profile_id','=', 'users.id')
                    ->select('user_user.*', 'posts.*','users.name','users.imagePath')
                    ->where('user_user.user_id',$id)
                    ->orderBy('posts.updated_at', 'DESC')
                    ->get();
        return $Postfollowing;
    }
    public function addComment(Request $request){
        return Comment::create([  
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'post_id' => $request->id
        ]);
    }
    public function getComment(Request $request){
        $comments = DB::table('comments')->join('users','users.id', '=', 'comments.user_id')->select('comments.*','users.name')->where('comments.post_id',$request->id)->orderBy('comments.created_at','DESC')->get();
        return ['comment' => $comments,'nComment'=>$comments->count()];
    }
}
