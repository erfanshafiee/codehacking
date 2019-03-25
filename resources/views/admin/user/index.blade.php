@extends("layouts.admin")
@section("content")
    <h1>users</h1>
    <table class="table">
        <thead>
          <tr>
            <th>id</th>
            <th>photo</th>
            <th>name</th>
            <th>email</th>
            <th>role</th>
            <th>status</th>
            <th>created at</th>
            <th>updated at</th>
            <th>edit</th>
          </tr>
        </thead>
        <tbody>
        @if($user)
            @foreach($user as $user)
                  <tr>
                    <td>{{$user->id}}</td>
                    <td><img height="50" width="50" src="{{$user->photo ? $user->photo->file : 'no photo' }}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active==1 ? "active" : "dissable"}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td><a href="{{route("admin.users.edit",$user->id)}}">edit</a></td>
                  </tr>
            @endforeach
        @endif
        </tbody>
      </table>
@endsection