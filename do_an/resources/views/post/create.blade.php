@extends('app')

@section('content')
  <div class="row">
    <div class="col-3 sidebar">
      <ul>
        <li> <a href="/edit"> edit profile</a></li>
        <li> <a href="/profile/create" class="bold"> add post</a></li>
      </ul>
    </div>
    <div class="col-9" style="padding-left: 50px">
      <form action ="/profile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <label class="form-text"> Image</label>
          <input type="file" class="form-input" name="image">
        </div>
        <div class="row">
          <lable class="form-text"> username</lable>
          <input class="form-input" type="text" name="username" placeholder="username">
        </div>
        <div class="row">
          <lable class="form-text"> n_likes</lable>
          <input class="form-input" type="text" name="n_likes" placeholder="n_likes">
        </div>
        <div class="row">
          <lable class="form-text"> description</lable>
          <textarea class="form-input" type="text" name="description" placeholder="description"></textarea>
        </div>
        <div class="submit">
          <button type="submit"> submit</button>  
        </div>
      </form>
    </div>
  </div>  
@endsection('content')
