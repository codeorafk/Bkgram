<div class="col-md-4">
  <div class="avatar">
    <img class="card-img" src={{asset('images/'.$users->image_path)}} alt="avatar">
  </div>
</div>
<div class="information col-md-8">
  <div class="container_1">
    <h2> {{$users->name}} </h2>
    @can('update',$users)
      <a href="{{route('user.edit',Auth::user()->id)}}"> Edit profile</a>
    @else
    <div id="app">
      <follow-button></follow-button>
    </div>
    @endcan   
  </div>
  <ul class="container_2">
    <li class="n_posts">
      <span class="bold"> {{$posts->count()}}</span>
      <span> posts</span>
    </li>
    <li class="n_followers">
      <span class="bold"> 256</span>
      <span> follower</span>
    </li>
    <li class="n_following">
      <span class="bold"> 158</span>
      <span> following</span>
    </li>
  </ul>
  <div class="bio">
    <span class="bold">{{$users->username}}</span>
    <br>
    <span> {{$users->bio}}</span>
  </div>
</div>