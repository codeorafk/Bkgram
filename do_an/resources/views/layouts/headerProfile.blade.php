<div class="col-md-4">
  <div class="avatar">
    <img class="card-img" src="https://img.freepik.com/free-psd/social-media-post-template-square-flyer_169869-538.jpg?size=626&ext=jpg" alt="avatar">
  </div>
</div>
<div class="information col-md-8">
  <div class="container_1">
    <h2> {{$users->name}} </h2>
    @can('update',$users)
      <a href="{{route('user.edit',Auth::user()->id)}}"> Edit profile</a>
    @else
      <button class='btn btn-primary' style="margin-left: 50px"> Follow </button>
    @endcan
  </div>
  <ul class="container_2">
    <li class="n_posts">
      <span class="bold"> 3</span>
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