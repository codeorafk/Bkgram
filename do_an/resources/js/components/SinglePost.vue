
<template>
    <div class= "col-sm-4"> 
      <!-- Trigger the modal with a button -->
        <button type="button" class="button" data-bs-toggle="modal" :data-bs-target="'#Modal_'+postId"><img class="card-img" :src="'http://127.0.0.1:8000/images/'+image_src" alt="Card image" style="width:100%" /></button>

                      <!-- Modal -->
        <div class="modal" :id="'Modal_'+postId">
          <div class="modal-dialog">
            <div class="modal-content" style="height:80%">
                  <!-- Modal content -->
              <div class="post">
                <div class="row">
                  <div class = "col-lg-7 col-md-6 col-12">
                    <div class="img">
                      <img class="card-img-top" :src="'http://127.0.0.1:8000/images/'+image_src" alt="Card image" style="width:100%">
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
                            <p> {{ username }} </p>
                          </span>
                        </div>
                        <div class="col-1" v-if="canUpdate()">
                          <div class="dropdown">
                            <button class="dropbtn">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/>
                              </svg>
                            </button>
                            <div class="dropdown-content">
                              <button>Edit</button>
                              <button> Delete</button>
                            </div>
                          </div> 
                        </div> 
                      </div>
                      <p class="card-text"><span class="bold">{{username}} </span> {{desc}} </p>
                      <div class="icons">
                        <like-button :post-id="postId"></like-button>
                        <button class="comment-icon" type="button">
                        </button>
                        <button class="save-icon" type="button">
                        </button>
                      </div>
                      <p class="card-text"><span class="bold" :key="n_likes">{{n_likes}} likes</span></p>
                      <input class="form-control" type="text" placeholder="Add a comment..." value="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>  
</template>


<script>
    export default {
      props: ['postId','username','desc','imageSrc','auth'],
      mounted(){
        this.getN_likes();
        this.timer = setInterval(this.getN_likes, 3000);
      },
      data: function(){
        return {
            image_src: this.imageSrc,
            n_likes: 0,
        }
      },
      methods: {
        canUpdate() {
            return this.auth;
        },
        getN_likes(){
          axios.post('/n_like/'+this.postId)
            .then((response) =>{
              this.n_likes = response.data;
            })
            .catch(function(error){
              console.log(error);
            })
        }
      }
    }
</script>