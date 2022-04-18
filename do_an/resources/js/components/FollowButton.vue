<template>
		<button class='btn btn-primary' style="margin-left: 50px" @click="followUser" v-text="buttonFollow"></button>
</template>

<script>
    export default {
        props: ['posts','userId', 'follows'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function(){
            return {
                status: this.follows,
            }
        },
        methods: {
            followUser() {
                axios.post('/follow/'+this.userId)
                .then(response=>{
                    this.status = !this.status;
                    console.log(response.data);
                });
            }
        },
        computed:{
            buttonFollow(){
                return (this.status)? "Unfollow" : "Follow";
            }
        }
    }
</script>
