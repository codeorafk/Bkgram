<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show($id)
    {
        $users = User::findOrFail($id);
        $posts = DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.*', 'posts.*')
                ->where('users.id',$id)
                ->get();
        $check = DB::table('user_user')->where('user_id',auth()->user()->id)->where('profile_id',$id)->get();
        $follows = isset($check[0]->id)? true : false;
        return view('profile.show', ['users' =>$users, 'posts'=> $posts, 'follows' => $follows]);
    }

    public function edit($id)
    {
        $users = User::find($id);

        $this->authorize('update', $users);

        return view('profile.edit',['users'=>$users]);
    }

    public function update(Request $request, $id)
    {
        $users = User::find($id);

        $this->authorize('update', $users);
        if($request->image == null){
                User::where('id', $id)
                ->update([  
                'username' => $request->input('username'),
                'bio' => $request->input('description'),
            ]);

            return redirect(route('user.show',$users));
        }
        $image = $request->file('image');

        $newImageName = time() .'.'. $request->image->extension();
        $image_resize = Image::make($image->path());
        $image_resize->fit(1200, 1200)->save(public_path().'/images/'.$newImageName);
        User::where('id', $id)
            ->update([  
            'username' => $request->input('username'),
            'bio' => $request->input('description'),
            'imagePath' => $newImageName,
        ]);

        return redirect(route('user.show',$users));
    }

    public function authenticate($id){
        if($id == auth()->user()->id)
            return "true";
        return "false";
    }
    public function info($id){
        $nfollowers = DB::table('user_user')->where('profile_id',$id)->get()->count();
        $nfollowing = DB::table('user_user')->where('user_id',$id)->get()->count();
        $nPosts = DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->select('users.*', 'posts.*')
                ->where('users.id',$id)
                ->get()->count();
        return ['nPosts'=> $nPosts, 'nfollowing' => $nfollowing, 'nfollowers' =>$nfollowers];
    }
    public function search(Request $request){
        $users = User::where('name', 'like', '%'.$request->input('search').'%')->orWhere('username', 'like', '%'.$request->input('search').'%')->get();
        if(!isset($users[0]->id))   return redirect(route('home'));
        return redirect(route('user.show',$users[0]->id));
    }
}
