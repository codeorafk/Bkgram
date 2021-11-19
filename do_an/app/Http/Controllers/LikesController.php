<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store($id)
    {
        $check = DB::table('user_post')->where('user_id',auth()->user()->id)->where('post_id',$id)->get();
        if(isset($check[0]->id))
        {
            return DB::table('user_post')->where('user_id',auth()->user()->id)->where('post_id',$id)->delete();
        }
        return DB::table('user_post')->insert(['user_id' => auth()->user()->id,'post_id' => $id]);
    }
    public function show($id){
        $check = DB::table('user_post')->where('user_id',auth()->user()->id)->where('post_id',$id)->get();
        if(isset($check[0]->id))
        {
            return true;
        }
        return false;
    }
    public function getn_Likes($id){
        return $check = DB::table('user_post')->where('post_id',$id)->get()->count();
    }
}
