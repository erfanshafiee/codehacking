<?php

namespace App\Http\Controllers;

use App\Catagory;
use App\Category;
use App\Comment;
use App\CommentReply;
use App\Http\Requests\EditPostRequest;
use App\Http\Requests\PostsCreateRequest;
use App\Photo;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::paginate(20);
        $categories=Catagory::all();
        return view("admin.posts.index",compact("posts","categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Catagory::pluck("name","id")->all();
        return view("admin.posts.create",compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input=$request->all();
        $user=Auth::user();
        if($file=$request->file("photo_id"))
        {
            $name=time().$file->getClientOriginalName();
            $file->move("images",$name);
            $photo=Photo::create(["file"=>$name]);
            $input["photo_id"]=$photo->id;
        }
        else
        {
            $input["photo_id"]=8;
        }
        $input["user_id"]=$user->id;
        $newpost=Post::create($input);
        return redirect("admin/posts");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories=Catagory::pluck("name","id")->all();
        return view("admin.posts.edit",compact("post","categories"));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPostRequest $request, $id)
    {
        //
        $input=$request->all();
        $post=Post::find($id);
        if($file=$request->file("photo_id"))
        {
            if($post->photo->id!==8)
            {
                unlink(public_path().$post->photo->file);
            }
            $name=time().$file->getClientOriginalName();
            $file->move("images",$name);
            $photo=Photo::create(["file"=>$name]);
            $input["photo_id"]=$photo->id;
        }
        else
        {
            $input["photo_id"]=$post->photo_id;
        }
        $post->update($input);
        return redirect("admin/posts");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Session::flash("deleted_post","post has been deleted");
        $post=Post::findOrFail($id);
        if($post->photo->id!==8)
        {
            unlink(public_path().$post->photo->file);
        }
        $post->delete();
        return redirect("/admin/posts");

    }
    public function post($slug)
    {
        $post=Post::findBySlugOrFail($slug);
        $comments=$post->comments()->where("is_active",1)->get();
        return view("posts",compact("post","comments"));
    }
}
