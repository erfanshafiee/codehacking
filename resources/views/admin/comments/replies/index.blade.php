@extends("layouts.admin")
@section("content")
    {!! Form::model($replies,["method"=>"POST","action"=>["CommentRepliesController@updatereply",$replies->id]]) !!}
        <div class="form-group">
            {!! Form::label("author","Author:") !!}
            {!! Form::text("author",null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("email","Email:") !!}
            {!! Form::text("email",null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("photo","Photo:") !!}
            {!! Form::file("photo",null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("body","Body:") !!}
            {!! Form::textarea("body",null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit("edit reply",["class"=>"btn btn-primary"]) !!}
        </div>
    {!! Form::close() !!}
@stop