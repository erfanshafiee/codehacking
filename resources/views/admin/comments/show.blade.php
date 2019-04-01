@extends("layouts.admin")
@section("content")
    @if(count($comments)>0)
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>post id</th>
                <th>is active</th>
                <th>author</th>
                <th>email</th>
                <th>photo</th>
                <th>body</th>
                <th>view post</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->post_id}}</td>
                    <td>{{$comment->is_active}}</td>
                    <td>{{$comment->author}}</td>
                    <td>{{$comment->email}}</td>
                    <td>{{$comment->photo}}</td>
                    <td>{{str_limit($comment->body,50)}}</td>
                    <td><a href="{{route("home.post",$comment->post->id)}}">view post</a></td>
                    <td>
                        @if($comment->is_active==1)
                            {!! Form::open(["method"=>"PATCH","action"=>["PostCommentsController@update",$comment->id]]) !!}
                            <input type="hidden" name="is_active" value="0">

                            <div class="form-group">
                                {!! Form::submit("unaprove post",["class"=>"btn btn-primary"]) !!}
                            </div>
                            {!! Form::close() !!}

                        @else
                            {!! Form::open(["method"=>"PATCH","action"=>["PostCommentsController@update",$comment->id]]) !!}
                            <input type="hidden" name="is_active" value="1">

                            <div class="form-group">
                                {!! Form::submit("aprove post",["class"=>"btn btn-primary"]) !!}
                            </div>
                            {!! Form::close() !!}

                        @endif
                    </td>
                    <td>{!! Form::open(["method"=>"DELETE","action"=>["PostCommentsController@destroy",$comment->id]]) !!}

                        <div class="form-group">
                            {!! Form::submit("delete comment",["class"=>"btn btn-danger"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">No Comments</h1>
    @endif

@stop