       
@foreach($posts as $posts)    
    <div class= "col-sm-4">

      <!-- Trigger the modal with a button -->
      <button type="button" class="button" data-bs-toggle="modal" data-bs-target="#Modal_{{$posts->id}}"><img class="card-img" src="https://previews.123rf.com/images/uniyok/uniyok1711/uniyok171100022/89491020-template-design-square-banner-with-pop-texture-background-poster-for-offer-and-presentation-on-abstr.jpg" alt="Card image" style="width:100%" /></button>

                    <!-- Modal -->
      <div class="modal" id="Modal_{{$posts->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
                <!-- Modal content -->
            <div class="post">
              <div class="row">
                <div class = "col-lg-7 col-md-6 col-12">
                  <div class="img">
                    <img class="card-img-top" src="https://previews.123rf.com/images/uniyok/uniyok1711/uniyok171100022/89491020-template-design-square-banner-with-pop-texture-background-poster-for-offer-and-presentation-on-abstr.jpg" alt="Card image" style="width:100%">
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
                          <p> UowY </p>
                        </span>
                      </div>
                      <div class="col-1">
                        <div class="dropdown">
                          <button class="dropbtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                              <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                            </svg>
                          </button>
                          <div class="dropdown-content">
                            <a href="#">edit</a>
                            <a href="#">delete</a>
                          </div>
                        </div> 
                      </div> 
                    </div>
                    <p class="card-text"><span class="bold">{{$posts->username}} </span> {{$posts->description}} </p>
                    
                    <div class="icons">
                      <button class="heart-icon" type="button">
                      </button>
                      <button class="comment-icon" type="button">
                      </button>
                      <button class="save-icon" type="button">
                      </button>
                    </div>
                    <p class="card-text"><span class="bold">{{$posts->n_likes}} likes</span></p>
                    <input class="form-control" type="text" placeholder="Add a comment..." value="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endforeach