<template>
  <form @submit.prevent>
    <h4>Create post</h4>
    <my-input
        v-model="post.title"
        type="text"
        placeholder="название"></my-input>
    <my-input
        v-model="post.body"
        type="text"
        placeholder="описание"></my-input>
    <my-button
        @click="createPost"
        class="btn"
        style="align-self: flex-end; margin-top: 15px"
    >create
    </my-button>
  </form>
</template>

<script>

import MyInput from "@/components/UI/MyInput.vue";
import MyButton from "@/components/UI/MyButton.vue";

export default {
  components: {MyButton, MyInput},

  data() {
    return {
      post: {
        title: '',
        body: ''
      }
    }
  },
  methods: {
    createPost() {
      this.post.id = Date.now();
      this.$emit('create', this.post)
      this.post = {
        title: '',
        body: ''
      }
    }
  }
}
</script>

<style scoped>
  form {
    display: flex;
    flex-direction: column;
  }
</style>