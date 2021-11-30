<template>
	<div class="post row">
		<div class="header-post" style="padding: 10px 0px 0px 10px; border: none">
			<span class="sm-avatar">
					<img class="card-img" :src="'http://127.0.0.1:8000/images/'+image_path" alt="Card image" style="width:40px">
					&emsp;
				</span>
			<span>
				<p class="bold" style="font-size: 14px; margin:0"> {{ name }} </p>
			</span>
		</div>
		<div class="img">
			<img class="card-img-top" :src="'http://127.0.0.1:8000/images/'+image_src" alt="Card image" style="width:100%">
		</div>
		<div class="card-body">
			<div class="icons">
				<button v-bind:class="buttonLike" type="button" @click="likePost"></button>
				<button class="comment-icon" type="button">
				</button>
				<button class="save-icon" type="button">
				</button>
			</div>
			<div class="card-text"><span class="bold" :key="n_likes">{{n_likes}} likes</span></div>
			<div class="card-text"><span class="bold">{{ name }} </span> {{desc}}</div>
			<div class="comment-area" :key="nComment">
        <div class="card-body">
          <div class="card-text" style="word-break: break-word;" v-for="item in toBeShown" v-bind:key="item.id">
          <span class="bold">{{item.name}} :</span> {{item.comment}}
          </div>
          <p v-if="show" @click="viewMore"> ...See More </p>
          <p v-else @click="viewLess"> Show Less... </p>
        </div>
        <div class="input-group mb-3">
        <input id="comment" class="form-control" type="text" placeholder="Add a comment..." v-model="comment">
        <button class="input-group-text btn" @click="addComment()" style="border-radius: 0 0.25em 0.25em 0">Post</button>
        </div>
      </div>
      
      
		</div>
	</div>
  
</template>

<script>
    export default {
      props: ['postId','name','imagePath','desc','imageSrc'],
      mounted(){
		axios.post('/likeShow/'+this.postId)
			.then(response=>{
				this.status = response.data;
				console.log(response.data);
			});
        this.getN_likes();
        this.getComment();
        this.timer = setInterval(this.getN_likes, 3000);
        setInterval(this.getComment, 3000);
      },
      data: function(){
        return {
            image_src: this.imageSrc,
            image_path: this.imagePath,
            n_likes: 0,
			      status: false,
            comment:'',
            listComments: [],
            nComment: '',
            current : 2,
            show: true,
        }
      },
      methods: {
        getN_likes(){
          axios.post('/n_like/'+this.postId)
            .then((response) =>{
              this.n_likes = response.data;
            })
            .catch(function(error){
              console.log(error);
            })
        },
		    likePost() {  
            if(this.status) {this.status = false;this.n_likes--;}
            else {this.status = true;this.n_likes++;}
            axios.post('/like/'+this.postId)
            .then(response=>{
                console.log(response.data);
            });
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