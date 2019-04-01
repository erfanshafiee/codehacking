@extends("layouts.admin")
@section("content")
    <h1>Posts</h1>

    @if(Session::has("deleted_post"))

        <p>{{Session("deleted_post")}}</p>
    @endif



    <table class="table">
        <thead>
          <tr>
            <th>id</th>
            <th>user_id</th>
            <th>category_id</th>
            <th>photo_id</th>
            <th>title</th>
            <th>body</th>
            <th>edit</th>
          </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
          <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->user->id}}</td>
            <td>{{$post->category->name ? $post->category->name : "no ategory"}}</td>
            <td><img height="50" width="50" src="{{$post->photo->file}}" alt=""></td>
            <td>{{$post->title}}</td>
            <td>{{str_limit($post->body,30)}}</td>
            <td><a href="{{route("admin.posts.edit",$post->id)}}">edit</a></td>
            <td><a href="{{route("home.post",$post->slug)}}">show post</a></td>
            <td><a href="{{route("admin.comments.show",$post->id)}}">view comments</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{{$posts->render()}}}
        </div>
    </div>


@endsection