<template>
	<div class="post row">
		<div class="header-post" style="padding: 20px 0px 0px 20px; border: none">
			<span class="sm-avatar">
					<img class="card-img" src="https://img.freepik.com/free-psd/social-media-post-template-square-flyer_169869-538.jpg?size=626&ext=jpg" alt="Card image" style="width:40px">
					&emsp;
				</span>
			<span>
				<p> {{ name }} </p>
			</span>
		</div>
		<div class="img">
			<img class="card-img-top" :src="'http://127.0.0.1:8000/images/'+image_src" alt="Card image" style="width:100%">
		</div>
		<div class="card-body">
			<div class="icons">
				<like-button :post-id="postId"></like-button>
				<button class="comment-icon" type="button">
				</button>
				<button class="save-icon" type="button">
				</button>
			</div>
			<p class="card-text"><span class="bold" :key="n_likes">{{n_likes}} likes</span></p>
			<p class="card-text"><span class="bold">{{ name }} </span> {{desc}}</p>
			<input class="form-control" type="text" placeholder="Add a comment..." value="">
		</div>
	</div>
  
</template>

<script>
    export default {
      props: ['postId','name','desc','imageSrc'],
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