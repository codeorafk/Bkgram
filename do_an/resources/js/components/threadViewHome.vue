

<template>
  <div>
      <post-home v-for="post in posts" v-bind:key="post.id" v-bind:post-id="post.id" v-bind:name="post.name" v-bind:image-path="post.imagePath" v-bind:desc="post.description" v-bind:image-src="post.image_path"></post-home>
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
        this.loadPost();
      },

      methods: {
        loadPost(){
          axios.post('/postsHome/'+this.userId)
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