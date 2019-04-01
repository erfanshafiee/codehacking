<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Post;
use App\User;
use Carbon\Carbon;


Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(["middleware"=>"admin"],function ()
{
    Route::get("admin",function (){return view("admin.index");});
    Route::resource("admin/users","AdminUsersController");
    Route::resource("admin/posts","AdminPostsController");
    Route::resource("admin/categories","AdmincategoriesController");
    Route::resource("admin/media","AdminMediaController");
    Route::resource("admin/comments","PostCommentsController");
    Route::resource("admin/comments/reply","CommentRepliesController");

//    Route::get("admin/media/upload",["as"=>"admin.media.upload","uses"=>"AdminMediaController@upload"]);
});
Route::get("post/{id}",["as"=>"home.post","uses"=>"AdminPostsController@post"]);
Route::group(["middleware"=>"auth"],function ()
{
    Route::post("comment/reply","CommentRepliesController@CreateReply");
});