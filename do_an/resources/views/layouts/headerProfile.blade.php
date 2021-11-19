<div class="col-md-4">
  <div class="avatar">
    <img class="card-img" src={{asset('images/'.$users->image_path)}} alt="avatar" style="border: 2px solid grey">
  </div>
</div>
<div class="information col-md-8">
  <div class="container_1">
    <h2> {{$users->name}} </h2>
    @can('update',$users)
      <a href="{{route('user.edit',$users->id)}}"> Edit profile</a>
    @else
      <follow-button user-id="{{$users->id}}" follows="{{$follows}}"></follow-button>
    @endcan   
  </div>
  <show-profile user-id="{{$users->id}}"></show-profile>
  <div class="bio">
    <span class="bold">{{$users->username}}</span>
    <br>
    <span> {{$users->bio}}</span>
  </div>
</div>