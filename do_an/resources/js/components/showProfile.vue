<template>
	<ul class="container_2">
    <li class="n_posts">
      <span class="bold" :key="nPosts"> {{nPosts}} </span>
      <span> posts</span>
    </li>
    <li class="n_followers">
      <span class="bold" :key="nfollowers"> {{nfollowers}}</span>
      <span> followers</span>
    </li>
    <li class="n_following">
      <span class="bold" :key="nfollowing"> {{nfollowing}}</span>
      <span> following</span>
    </li>
  </ul>
</template>

<script>
    export default {
        props: ['userId'],
        mounted() {
            this.get_info();
            this.timer = setInterval(this.get_info, 3000);
        },
        data: function(){
            return {
                nPosts: 0, 
                nfollowers: 0, 
                nfollowing: 0
            }
        },
        methods: {
            get_info(){
                axios.post('/info/'+this.userId)
                .then((response) =>{
                    this.nPosts = response.data.nPosts;
                    this.nfollowers = response.data.nfollowers;
                    this.nfollowing = response.data.nfollowing;     
                })
                .catch(function(error){
                    console.log(error);
                })
            }
        },
    }
</script>
