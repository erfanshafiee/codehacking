<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPage;
use App\Http\Requests\UserRequest;
use App\Photo;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        return view("admin.user.index",compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=Role::pluck("name","id")->all();
        return view("admin.user.create",compact("role"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input=$request->all();
        if($file=$request->file("Photo_id"))
        {
            $name=time().$file->getClientOriginalName();
            $file->move("images",$name);
            $photo=Photo::create(["file"=>$name]);
            $input["photo_id"]=$photo->id;
        }
        else
        {
            $input["photo_id"]=4;
        }
        $input["password"]=bcrypt($request->password);

        User::create($input);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user=User::findOrFail($id);
        $role=Role::pluck("name","id")->all();
        return view("admin.user.edit",compact("user","role"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPage $request, $id)
    {
        //
        $user=User::findOrFail($id);
        $input=$request->all();
        if($file=$request->file("Photo_id"))
        {
            if($user->photo->id!==4)
            {
                unlink(public_path().$user->photo->file);
            }
            $name=time().$file->getClientOriginalName();
            $file->move("images",$name);
            $photo=Photo::create(["file"=>$name]);
            $input["photo_id"]=$photo->id;
        }
        else
        {
            $input["photo_id"]=$user->photo_id;
        }
        if(!$input["password"])
        {
            $input["password"]=$user->password;
        }
        $input["password"]=bcrypt($request->password);

        $user->update($input);
        $user->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|string
     */
    public function destroy($id)
    {
        Session::flash("deleted_user","the user has been deleted");
        $user=User::findOrFail($id);
        if($user->photo->id!==4)
        {
            unlink(public_path().$user->photo->file);
        }

        $user->delete();


        return redirect("/admin/users");
    }
}
