   
  {{-- @foreach($posts as $key => $posts)    
      <div class= "col-sm-4">

        <!-- Trigger the modal with a button -->
        <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#Modal_{{$posts->id}}"><img class="card-img" src="{{asset('images/'.$posts->image_path)}}" alt="Card image" style="width:100%" /></button>

                      <!-- Modal -->
        <div class="modal" id="Modal_{{$posts->id}}">
          <div class="modal-dialog">
            <div class="modal-content" style="height:80%">
                  <!-- Modal content -->
              <div class="post">
                <div class="row">
                  <div class = "col-lg-7 col-md-6 col-12">
                    <div class="img">
                      <img class="card-img-top" src="{{asset('images/'.$posts->image_path)}}" alt="Card image" style="width:100%">
                    </div>
                  </div>
                  <div class= "col-lg-5 col-md-6 col-12">
                    <div class="card-body">
                      <div class="header-post">
                        <div class="col-11 row">
                          <span class="sm-avatar">
                              <img class="card-img" src="https://img.freepik.com/free-psd/social-media-post-template-square-flyer_169869-538.jpg?size=626&ext=jpg" alt="Card image" style="width:40px">
                              &emsp;
                            </span>
                          <span>
                            <p> {{ $users->name }} </p>
                          </span>
                        </div>
                        <div class="col-1">
                          @can('update',$users)
                          <div class="dropdown">
                            <button class="dropbtn">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                              </svg>
                            </button>
                            <div class="dropdown-content">
                              <a href="{{route('post.edit', $posts->id)}}">edit</a>
                              <form action="{{route('post.destroy', $posts->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit">delete</button>
                              </form>
                            </div>
                          </div> 
                          @endcan
                        </div> 
                      </div>
                      <p class="card-text"><span class="bold">{{$posts->username}} </span> {{$posts->description}} </p>
                      
                      <div class="icons">
                        
                        <like-button :post-id="{{$posts->id}}" :likes="{{$likes[$key]}}"></like-button>

                        <button class="comment-icon" type="button">
                        </button>
                        <button class="save-icon" type="button">
                        </button>
                      </div>
                      <p class="card-text"><span class="bold">12 likes</span></p>
                      <input class="form-control" type="text" placeholder="Add a comment..." value="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endforeach --}}
  <thread-view user-id="{{$users->id}}"> 
  </thread-view>
  {{-- <single-post post-id="2" username="loc minh hieu" desc="shit!" image-src="1637255103.jpg"></single-post> --}}
