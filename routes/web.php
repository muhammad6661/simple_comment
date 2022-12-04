<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PostController::class, 'index']);
Route::get('/sign-up', [UserController::class, 'signUp']);
Route::post('/sign-up', [UserController::class, 'registerUser']);
Route::get('/sign-in', [UserController::class, 'signIn']);
Route::post('/sign-in', [UserController::class, 'loginUser']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/post/{id}', [PostController::class, 'detailPost']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/myposts', [PostController::class, 'myPosts']);
Route::get('/moreComment/post/{post_id}/offset/{offset}', [PostController::class, 'moreComment']);
Route::get('/searchUserBylogin/{login}/forPost/{post_id}', [PostController::class, 'searchUserByLogin']);
Route::get('/filterCommentByLoginOfUser/{login}/post/{post_id}/offset/{offset}', [PostController::class, 'filterCommentByUserlogin']);
Route::get('/filterCommentByDateAscOrDesc/post/{post_id}/offset/{offset}/filterBy/{filterBy}', [PostController::class,'filterCommentByDateAscOrDesc']);

Route::group(['middleware' => 'panel'], function(){
Route::get('/create/post', [PostController::class, 'createPost']);
Route::post('/store/post', [PostController::class, 'storePost']);
Route::get('/edit/post/{id}', [PostController::class, 'editPost']);
Route::post('/update/post/{id}', [PostController::class, 'updatePost']);
Route::get('/delete/post/{id}', [PostController::class, 'deletePost']);
Route::post('/sendComment', [PostController::class, 'addComment']);
Route::post('/updateComment/{id}', [PostController::class, 'updateComment']);
Route::get('/deleteComment/{id}', [PostController::class, 'deleteComment']);
Route::get('/myprofile', [UserController::class, 'myProfile']);
Route::post('/profile/user/upload/avatar', [UserController::class, 'uploadAvatar']);
Route::post('/update/profile', [UserController::class, 'updateProfile']);
Route::post('/change/password', [UserController::class, 'changePassword']);
});
