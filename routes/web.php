<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get("/logout","Auth\LoginController@logout");
Route::get('/', function () {
    return view('welcome');
});

Route::group(["middleware"=>"admin"],function ()
{
    Route::delete("/delete/media","AdminMediaController@deletemedias");
    Route::get("admin",function (){return view("admin.index");});
    Route::resource("admin/users","AdminUsersController",["names"=>["index"=>"admin.users.index","create"=>"admin.users.create","store"=>"admin.users.store","edit"=>"admin.users.edit"]]);
    Route::resource("admin/posts","AdminPostsController",["names"=>["index"=>"admin.posts.index","create"=>"admin.posts.create","store"=>"admin.posts.store","edit"=>"admin.posts.edit"]]);
    Route::resource("admin/categories","AdmincategoriesController",["names"=>["index"=>"admin.categories.index","create"=>"admin.categories.create","store"=>"admin.categories.store","edit"=>"admin.categories.edit"]]);
    Route::resource("admin/media","AdminMediaController",["names"=>["index"=>"admin.media.index","create"=>"admin.media.create","store"=>"admin.media.store","edit"=>"admin.media.edit"]]);
    Route::resource("admin/comments","PostCommentsController",["names"=>["index"=>"admin.comments.index","create"=>"admin.comments.create","store"=>"admin.comments.store","edit"=>"admin.comments.edit","show"=>"admin.comments.show"]]);
    Route::resource("admin/comments/reply","CommentRepliesController",["names"=>["index"=>"admin.comments.reply.index","create"=>"admin.comments.reply.create","store"=>"admin.comments.reply.store","edit"=>"admin.comments.reply.edit","show"=>"admin.comments.reply.show","CreateReply"=>"admin.comments.reply.CreateReply"]]);

//    Route::get("admin/media/upload",["as"=>"admin.media.upload","uses"=>"AdminMediaController@upload"]);
});
Route::get("post/{id}",["as"=>"home.post","uses"=>"AdminPostsController@post"]);

Route::group(["middleware"=>"auth"],function ()
{
    Route::post("comment/reply","CommentRepliesController@CreateReply");
});






















