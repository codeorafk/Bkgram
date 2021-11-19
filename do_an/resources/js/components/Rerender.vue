<template>
    <div>
        <single-post :key="componentKey"></single-post>
        <button hidden @click="forceRerender()"> re render</button>
    </div> 
</template>
<script>
  export default {
    props: ['userId'],
    data() {
      return {
        componentKey: 0
      }
    },
    created () {
        this.forceRerender();
        this.timer = setInterval(this.forceRerender, 30000);
    },
    methods: {
      forceRerender() {
        this.componentKey += 1
      },
    }
  }
</script>

