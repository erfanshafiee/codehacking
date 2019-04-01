@extends("layouts.admin")
@section("content")
    <h1>update page</h1>

    <div class="row">
        <div class="col-sm-3">

            <img src="{{$user->photo ? $user->photo->file : "no user"}}" alt="" class="img-responsive img-rounded">


        </div>



        <div class="col-sm-9">

            {!! Form::model($user,["method"=>"PATCH","action"=>["AdminUsersController@update",$user->id],"files"=>true]) !!}
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
                {!! Form::select("is_active",array(1=>"active",0=>"not active"),null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group">
                {!! Form::label("Photo_id","image:") !!}
                {!! Form::file("Photo_id",null,["class"=>"form-control"]) !!}
            </div>

            <div class="form-group ">
                {!! Form::submit("Update User",["class"=>"btn btn-primary col-sm-3"]) !!}
            </div>
            {!! Form::close() !!}

            {!! Form::open(["method"=>"DELETE","action"=>["AdminUsersController@destroy",$user->id]]) !!}
                <div class="form-group">
                    {!!  Form::submit("Delete User",["class"=>"btn btn-danger col-sm-3"]) !!}
                </div>
            {!! Form::close() !!}

        </div>

    </div>




    <div class="row">
        @include("includes.form_error")
    </div>

@endsection