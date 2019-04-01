<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediaController extends Controller
{
    public function index()
    {
        $photos=Photo::all();
        return view("admin.media.index",compact("photos"));
    }
    public function create()
    {
        return view("admin.media.upload");
    }
    public function store(Request $request)
    {
        $file=$request->file("file");
        $name=time().$file->getClientOriginalName();
        $file->move("images",$name);
        Photo::create(["file"=>$name]);
    }
    public function destroy($id)
    {
        $photo=Photo::findOrFail($id);
        $photo->delete();
        unlink(public_path().$photo->file);
    }
    public function deletemedias(Request $request)
    {
        if(isset($request->delete_single))
        {
            $this->destroy($request->photo);
            return redirect()->back();
        }

        if(isset($request->delete_all) && !empty($request->CheckBoxArray))
        {
            $photos=Photo::find($request->CheckBoxArray);
            foreach ($photos as $photo)
            {
                $photo->delete();
            }
            return redirect()->back();
        }
        else
            {
            return redirect()->back();
        }
    }
}
