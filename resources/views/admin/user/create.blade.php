@extends("layouts.admin")
@section("content")
<h1>create page</h1>
    {!! Form::open(["method"=>"POST","action"=>"AdminUsersController@store","files"=>true]) !!}
        <div class="form-group">
            {!! Form::label("name","Name:") !!}
            {!! Form::text("name",null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("email","Email:") !!}
            {!! Form::email("email",null,["class"=>"form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("password","Pass:") !!}
            {!! Form::password("password",null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label("role_id","Role:") !!}
            {!! Form::select("role_id",[""=>"choose option"]+$role,null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label("is_active","Status:") !!}
            {!! Form::select("is_active",array(1=>"active",0php arti=>"not active"),null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label("file","image:") !!}
            {!! Form::file("file",null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit("Creat User",["class"=>"btn btn-primary"]) !!}
        </div>
    {!! Form::close() !!}
@include("includes.form_error")
@endsection