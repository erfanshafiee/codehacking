@extends("layouts.admin")
@section("content")
    <div class="col-sm-6">
        {!! Form::model($category,["method"=>"PATCH","action"=>["AdmincategoriesController@update",$category->id]]) !!}
        <div class="form-group">
            {!! Form::label("name","Category:") !!}
            {!! Form::text("name",null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit("Create category",["class"=>"btn btn-primary"]) !!}
        </div>
        {!! Form::close() !!}
        {!! Form::open(["method"=>"DELETE","action"=>["AdmincategoriesController@destroy",$category->id]]) !!}
        <div class="form-group">
            {!! Form::submit("delete category",["class"=>"btn btn-danger"]) !!}
        </div>
        {!! Form::close() !!}
        @include("includes.form_error")
    </div>
@stop