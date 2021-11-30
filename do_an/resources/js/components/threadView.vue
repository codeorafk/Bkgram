

<template>
  <div class="posts_profile row">
      <single-post v-for="post in posts" v-bind:key="post.id" v-bind:post-id="post.id" v-bind:username="post.name" v-bind:image-path="post.imagePath" v-bind:desc="post.description" v-bind:image-src="post.image_path" v-bind:auth="authentication"></single-post>
  </div>    
</template>


<script>
    export default {
      props: ['userId'],
      data: function(){
        return {
          posts: [],
          authentication: false,
          componentKey: 0
        }
      },
      mounted(){
        console.log('Component mounted. thread');
        this.loadPost();
        axios.post('/authentication/'+this.userId)
            .then((response) =>{
              console.log('auth:'+response.data);
              this.authentication = response.data;
            })
            .catch(function(error){
              console.log(error);
            })
      },

      methods: {
        loadPost(){
          axios.post('/posts/'+this.userId)
            .then((response) =>{
              console.log(response.data);
              this.posts = response.data;
            })
            .catch(function(error){
              console.log(error);
            })
        },
      }
    }
</script>