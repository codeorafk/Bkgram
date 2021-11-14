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
        return view('profile.show', ['users' =>$users, 'posts'=> $posts]);
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
}
