@extends('app')

@section('content')
  <div class="row">
    <div class="col-3 sidebar">
      <ul>
        <li> <a href="{{route('user.edit',Auth::user()->id)}}" class="bold"> edit profile</a></li>
        <li> <a href="{{route('post.create')}}"> add post </a></li>
      </ul>
    </div>
    <div class="col-9" style="padding-left: 50px">
      <div class="row">
        <div class="col-md-2">
          <div class="avatar">
            <img class="card-img" src="https://img.freepik.com/free-psd/social-media-post-template-square-flyer_169869-538.jpg?size=626&ext=jpg" alt="avatar">
          </div>
        </div>
        <div class="information col-md-10">
          <div>
            <h2 style="margin-right: 15px;margin-bottom: 0px;font-size: 28px;line-height: 32px;font-weight: 300;"> {{$users->name}} </h2>
            <a href="#"> change Profile Photo</a>
          </div>
        </div>
      </div>
     
      <form action ="{{route('user.update',$users->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
          <lable class="form-text"> username</lable>
          <input class="form-input" type="text" name="username" placeholder="username">
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
