<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($id)
    {
        $check = DB::table('user_user')->where('user_id',auth()->user()->id)->where('profile_id',$id)->get();
        if(isset($check[0]->id))
        {
            return DB::table('user_user')->where('user_id',auth()->user()->id)->where('profile_id',$id)->delete();
        }
        return DB::table('user_user')->insert(['user_id' => auth()->user()->id,'profile_id' => $id]);
    }
}
