<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        $nfollowers = DB::table('user_user')->where('profile_id',$id)->get()->count();
        $nfollowing = DB::table('user_user')->where('user_id',$id)->get()->count();
        return view('profile.show', ['users' =>$users, 'posts'=> $posts, 'follows' => $follows, 'nfollowing' => $nfollowing, 'nfollowers' =>$nfollowers]);
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
        $newImageName = time() .'.'. $request->image->extension();
        $request->image->move(public_path('images'),$newImageName);
        User::where('id', $id)
            ->update([  
            'username' => $request->input('username'),
            'bio' => $request->input('description'),
            'image_path' => $newImageName,
        ]);

        return redirect(route('user.show',$users));
    }

    public function authenticate($id){
        if($id == auth()->user()->id)
            return "true";
        return "false";
    }
}
