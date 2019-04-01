@extends("layouts.admin")
@section("content")
    @include("includes.tinyeditor")
    <h1>create post</h1>
    <div class="row">
        {!! Form::open(["method"=>"POST","action"=>"AdminPostsController@store","files"=>true]) !!}
            <div class="form-group">
                {!! Form::label("title","Title:") !!}
                {!! Form::text("title",null,["class"=>"form-control"]) !!}
            </div>
            <div class="form-group">
                {!! Form::label("category_id","Category:") !!}
                {!! Form::select("category_id",[""=>"options"]+$categories,null,["class"=>"form-control"]) !!}
            </div>
            <div class="form-group ">
                {!! Form::label("photo_id","select photo:") !!}
                {!! Form::file("photo_id",null,["class"=>"form-control"]) !!}
            </div>
            <div class="form-group ">
                {!! Form::label("body","body:") !!}
                {!! Form::textarea("body",null,["class"=>"form-control my-editor","rows"=>3]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit("Creat Post",["class"=>"btn btn-primary"]) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="row">
    @include("includes.form_error")
    </div>
@endsection