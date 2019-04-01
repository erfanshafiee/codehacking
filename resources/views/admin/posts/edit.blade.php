@extends("layouts.admin")
@section("content")
    @include("includes.tinyeditor")
    <h1>edit post</h1>
    <div class="row">


        <div class="col-sm-3">
            <img src="{{$post->photo->file}}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">
        {!! Form::model($post,["method"=>"PATCH","action"=>["AdminPostsController@update",$post->id],"files"=>true]) !!}
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
            {!! Form::submit("Edit Post",["class"=>"btn btn-primary"]) !!}
        </div>
        {!! Form::close() !!}

        {!! Form::open(["method"=>"DELETE","action"=>["AdminPostsController@destroy",$post->id]]) !!}
            <div class="form-group">
                {!! Form::submit("delete Post",["class"=>"btn btn-danger"]) !!}
            </div>
        {!! Form::close() !!}
        </div>
    </div>
    <div class="row">
        @include("includes.form_error")
    </div>
@endsection