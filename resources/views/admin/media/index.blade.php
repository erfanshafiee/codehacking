@extends("layouts.admin")
@section("content")
<h1>Media</h1>
    @if($photos)
        <form action="/delete/media" method="post" class="form-inline">
            {{csrf_field()}}
            {{method_field("delete")}}
            <div class="form-group">
                <select name="CheckBoxArray" id="check" class="form-control">
                    <option value="">delete</option>
                </select>
            </div>
            <div class="form-group">
                <input name="delete_all" type="submit" class="btn btn-primary">
            </div>

            <table class="table">

                <thead>
                  <tr>
                      <th><input type="checkbox" id="options"></th>
                    <th>Id</th>
                    <th>Name</th>
                    <th>delete</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($photos as $photo)
                      @if($photo->id==8 || $photo->id==4)
                      @else
                          <tr>
                              <td><input class="checkbox" type="checkbox" name="CheckBoxArray[]" value="{{$photo->id}}"></td>
                              <td>{{$photo->id}}</td>
                              <td><img  src="{{$photo->file}}" width="50" height="50"></td>
                              <td>

                                  <input type="hidden" name="photo" value="{{$photo->id}}" >
                                  <div class="form-group">
                                      <input type="submit" class="btn btn-danger" name="delete_single" value="delete">
                                  </div>
                              </td>
                          </tr>

                      @endif

                @endforeach
                </tbody>
          </table>
        </form>
    @endif
@stop
