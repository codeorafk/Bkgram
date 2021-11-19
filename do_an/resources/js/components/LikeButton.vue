<template>
		<button v-bind:class="buttonLike" type="button" @click="likePost"></button>
</template>

<script>
    export default {
        props: ['postId'],
        
        data: function(){
            return {
                status: this.likes,
            }
        },
        mounted() {
            console.log('Component mounted. button'),
            axios.post('/likeShow/'+this.postId)
                .then(response=>{
                    this.status = response.data;
                    console.log(response.data);
                });
        },
        methods: {
            likePost() {
                axios.post('/like/'+this.postId)
                .then(response=>{
                    this.status = !this.status;
                    console.log(response.data);
                });
            }
        },
        computed:{
            buttonLike(){
                return (this.status)? "heart-icon-active" : "heart-icon";
            }
        }
    }
</script>
