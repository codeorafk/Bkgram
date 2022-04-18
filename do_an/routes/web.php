<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\postController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\LikesController;

use App\Policies\UserPolicy;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/post/create', [postController::class,'create'])->name('post.create');

// Route::post('/post', [postController::class,'store'])->name('post.store');

Route::resource('/post',postController::class);
// Route::get('/edit', function () {
//     return view('profile.edit');
// });

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('/user',UserController::class);
Route::get('change-password', [App\Http\Controllers\ChangePasswordController::class, 'index']);
Route::post('change-password', [App\Http\Controllers\ChangePasswordController::class, 'changePassword'])->name('change.password');

Route::post('/follow/{id}',[FollowsController::class, 'store']);
Route::post('/like/{id}',[LikesController::class, 'store']);
Route::post('/likeShow/{id}',[LikesController::class, 'show']);
Route::post('/n_like/{id}',[LikesController::class, 'getn_Likes']);
Route::post('/posts/{id}',[postController::class, 'getPost']);
Route::post('/postsHome/{id}',[postController::class, 'getPostHome']);
Route::post('/authentication/{id}',[UserController::class, 'authenticate']);
Route::post('/info/{id}',[UserController::class, 'info']);
Route::post('/search',[UserController::class, 'search'])->name('search');
Route::post('/updatePost',[postController::class, 'updatePost']);
Route::post('/deletePost',[postController::class, 'deletePost']);
Route::post('/addComment',[postController::class,'addComment']);
Route::post('/getComment',[postController::class,'getComment']);