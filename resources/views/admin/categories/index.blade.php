@extends("layouts.admin")
@section("content")

    <div class="col-sm-6">
        {!! Form::open(["method"=>"POST","action"=>"AdmincategoriesController@store"]) !!}
        <div class="form-group">
            {!! Form::label("name","Category:") !!}
            {!! Form::text("name",null,["class"=>"form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit("Create category",["class"=>"btn btn-primary"]) !!}
        </div>
        {!! Form::close() !!}



        @include("includes.form_error")
    </div>
    <div class="col-sm-6">
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td><a href="{{route("admin.categories.edit",$category->id)}}">edit</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>





@stop