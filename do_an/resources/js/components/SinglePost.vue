
<template>
    <div class= "col-4" style="padding: 0 0 0 0;"> 
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
                    <label :for="'file'+postId" v-if="IsEditing" style="margin: 0">
                      <div class="img">
                        <img class="card-img-top" :src="'http://127.0.0.1:8000/images/'+image_src" alt="Card image" style="width:100%">
                      </div>
                    </label>
                    <div class="img" v-else>
                      <img class="card-img-top" :src="'http://127.0.0.1:8000/images/'+image_src" alt="Card image" style="width:100%">
                    </div>
                    <input hidden :id="'file'+postId" type="file"  @change="onFileChange">
                  </div>
                  <div class= "col-lg-5 col-md-6 col-12">
                    <div class="card-body">
                      <div class="header-post">
                        <div class="col-11 row">
                          <span class="sm-avatar">
                              <img class="card-img" :src="'http://127.0.0.1:8000/images/'+ image_path" alt="Card image" style="width:40px">
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
                            <div class="dropdown-content" v-if="IsEditing">
                              <button style="width: 100%" @click="submitForm()">Ok</button>
                              <button @click="edit()" > Cancel</button>
                            </div>
                            <div class="dropdown-content" v-else>
                              <button @click="edit()" style="width: 100%">Edit</button>
                              <button @click="deletePost()"> Delete</button>
                            </div>
                          </div> 
                        </div> 
                      </div>
                      <p class="card-text" v-if="IsEditing"><span class="bold">{{username}} </span> <textarea class="form-control" v-model="desc_form" name="desc"></textarea></p>
                      <p class="card-text" v-else><span class="bold">{{username}} </span> {{desc_form}} </p>
                      <div class="icons">
                        <button v-bind:class="buttonLike" type="button" @click="likePost"></button>
                        <button class="comment-icon" type="button">
                        </button>
                        <button class="save-icon" type="button">
                        </button>
                      </div>
                      <div class="card-text"><span class="bold" :key="n_likes">{{n_likes}} likes</span></div>

                      <div class="comment-area" :key="nComment">
                        <div class="card-body" style="padding-top: 0;max-height:220px;overflow-y: auto;scrollbar-width: none;margin-bottom: 20px">
                          <div class="card-text" style="word-break: break-word;" v-for="item in toBeShown" v-bind:key="item.id">
                          <span class="bold">{{item.name}} :</span> {{item.comment}}
                          </div>
                        </div>
                        <p v-if="show" @click="viewMore"> ...See More </p>
                          <p v-else @click="viewLess"> Show Less... </p>
                        <div class="input-group mb-3">
                        <input id="comment" class="form-control" type="text" placeholder="Add a comment..." v-model="comment">
                        <button class="input-group-text btn" @click="addComment()" style="border-radius: 0 0.25em 0.25em 0">Post</button>
                        </div>
                      </div>
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
      props: ['postId','username','imagePath','desc','imageSrc','auth'],
      data: function(){
        return {
            image_path: this.imagePath,
            image_src: this.imageSrc,
            n_likes: 0,
            IsEditing: false,
            status: false,
            image: '',
            desc_form: this.desc,
            comment:'',
            listComments: [],
            nComment: '',
            current : 2,
            show: true,
        }
      },
      mounted(){
        axios.post('/likeShow/'+this.postId)
                .then(response=>{
                    this.status = response.data;
                });
        this.getN_likes();
        this.getComment();
        setInterval(this.getN_likes, 3000);
        setInterval(this.getComment, 3000);
      },
      methods: {
        onFileChange(e) {
          console.log(e);
          var files = e.target.files || e.dataTransfer.files;
          if (!files.length)
            return;
          this.createImage(files[0]);
        },
        createImage(file) {
          var image = new Image();
          var reader = new FileReader();
          var vm = this;

          reader.onload = (e) => {
            vm.image = e.target.result;
          };
          reader.readAsDataURL(file);
        },
        submitForm(){
            axios.post('/updatePost/',{
                                  id: this.postId,
                                  image: this.image,
                                  description: this.desc_form,
                                })
                 .then((response) => {
                   if(response.data.image_path != null)
                    this.image_src = response.data.image_path;
                   this.desc_form = response.data.description;
                   this.IsEditing = false;
                 })
        },
        getComment(){
          axios.post('/getComment/',{
            id: this.postId,
          })
                .then((response)=>{
                  this.listComments = response.data.comment
                  this.nComment = response.data.nComment
                  console.log(this.listComments)
                })
        },
        addComment(){
          axios.post('/addComment/',{
            id: this.postId,
            comment: this.comment
          })
                .then((reponse)=>{
                })
        },
        deletePost(){
            axios.post('/deletePost/',{
                                  id: this.postId,
                                })
                 .then((response) => {
                   window.location.reload(true)
                  })
        },
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
        },
        edit(){
          if(this.IsEditing === true)  this.IsEditing = false;
          else this.IsEditing = true;
        },
        likePost() {  
            if(this.status) {this.status = false;this.n_likes--;}
            else {this.status = true;this.n_likes++;}
            axios.post('/like/'+this.postId)
            .then(response=>{
                console.log(response.data);
            });
        },
        viewMore(){
          this.current = this.nComment;
          this.show = false;
        },
        viewLess(){
          this.current = 2;
          this.show = true;
        }
      },
      computed:{
          buttonLike(){
              return (this.status)? "heart-icon-active" : "heart-icon";
          },
          toBeShown(){
            return this.listComments.slice(0, this.current);
          }
      }
    }
</script>