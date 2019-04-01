@extends("layouts.blog-post")
@section("content")
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <link href="{{asset('css/libs.css')}}" rel="stylesheet">
    <h1>{{$post->title}}</h1>
    <!-- Blog Post -->

    <!-- Title -->
    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span>{{$post->created_at}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive"  src="{{$post->photo ? $post->photo->file : null}}" height="400px" width="550" alt=""/>

    <hr>

    <!-- Post Content -->
    <p>{!! $post->body !!}</p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
@if(Auth::check())

        <div class="well">
            @if(Session::has("comment_message"))

                {{Session("comment_message")}}
            @endif
            {!! Form::open(["method"=>"POST","action"=>"PostCommentsController@store"]) !!}
            <input type="hidden" name="post_id" value="{{$post->id}}">

                <div class="form-group">
                    {!! Form::label("body","Comment:") !!}
                    {!! Form::textarea("body",null,["class"=>"form-control","rows"=>3]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit("Create comment",["class"=>"btn btn-primary"]) !!}
                </div>
            {!! Form::close() !!}
        </div>
@endif
    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->

    @foreach($comments as $comment)
        @if($comment->is_active==1)
            <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object"  src="{{$comment->photo}}" height="64" width="64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">created at
                    <small>{{$comment->created_at}}</small>
                </h4>
                {{$comment->body}}
                {{--nested--}}
                @foreach($comment->replies as $reply)
                    @if($reply->is_active==1)

                        <div class="nested-comment media">
                            <a class="pull-left" href="#">
                                <img class="media-object" height="45" width="45" src="{{$reply->photo}}" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">reply in
                                    <small>{{$reply->created_at}}</small>
                                </h4>
                                {{$reply->body}}
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="comment-reply-container">
                        <button class="toggle-reply btn btn-primary pull-right">reply</button>
                    <div class="clomment-reply">
                        {!! Form::open(["method"=>"POST","action"=>"CommentRepliesController@CreateReply"]) !!}
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <div class="form-group">
                                {!! Form::label("body","Title:") !!}
                                {!! Form::textarea("body",null,["class"=>"form-control","rows"=>3]) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit("Create reply",["class"=>"btn btn-primary"]) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>

                    {{--ens nested--}}
                </div>
            </div>
            </div>
        @endif
    @endforeach

@stop
