@extends("layouts.admin")
@section("content")
    @if(count($replies)>0)
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>is active</th>
                <th>author</th>
                <th>email</th>
                <th>photo</th>
                <th>body</th>
                <th>view post</th>
            </tr>
            </thead>
            <tbody>
            @foreach($replies as $reply)
                <tr>
                    <td>{{$reply->id}}</td>
                    <td>{{$reply->is_active}}</td>
                    <td>{{$reply->author}}</td>
                    <td>{{$reply->email}}</td>
                    <td>{{$reply->photo}}</td>
                    <td>{{str_limit($reply->body,50)}}</td>
                    <td><a href="{{route("home.post",$reply->comment->post->id)}}">view post</a></td>
                    <td>
                        @if($reply->is_active==1)
                            {!! Form::open(["method"=>"PATCH","action"=>["CommentRepliesController@update",$reply->id]]) !!}
                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit("unaprove post",["class"=>"btn btn-primary"]) !!}
                            </div>
                            {!! Form::close() !!}

                        @else
                            {!! Form::open(["method"=>"PATCH","action"=>["CommentRepliesController@update",$reply->id]]) !!}
                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit("aprove post",["class"=>"btn btn-primary"]) !!}
                            </div>
                            {!! Form::close() !!}

                        @endif
                    </td>
                    <td>
                        {!! Form::open(["method"=>"DELETE","action"=>["CommentRepliesController@destroy",$reply->id]]) !!}

                            <div class="form-group">
                                {!! Form::submit("delete reply",["class"=>"btn btn-danger"]) !!}
                            </div>
                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Replies</h1>
    @endif

@stop