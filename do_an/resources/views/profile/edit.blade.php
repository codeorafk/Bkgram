@extends('app')

@section('content')
  <div class="row">
    <div class="col-3 sidebar">
      <ul>
        <li> <a href="{{route('user.edit',Auth::user()->id)}}" class="bold"> edit profile</a></li>
        <li> <a href="{{route('post.create')}}"> add post </a></li>
        <li> <a href="{{route('home')}}"> change password </a></li>
      </ul>
    </div>
    <div class="col-9" style="padding-left: 50px">
      <form action ="{{route('user.update',$users->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
          <div class="col-md-2">
            <div class="avatar">
              <img class="card-img" src="{{asset('images/'.$users->image_path)}}" alt="avatar">
            </div>
          </div>
          <div class="information col-md-10">
            <div>
              <h2 style="margin-right: 15px;margin-bottom: 0px;font-size: 28px;line-height: 32px;font-weight: 300;"> {{$users->name}} </h2>
              <input type="file" class="form-input" name="image">
            </div>
          </div>
        </div>
        <div class="row">
          <label class="form-text"> username</label>
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
