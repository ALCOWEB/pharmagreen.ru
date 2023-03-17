<template>
  <div class="app">
      <form>
        <h4>Create post</h4>
        <input v-bind:value="title" class="input" type="text" placeholder="название">
        <input v-bind:value="body"  class="input" type="text" placeholder="описание">
        <button class="btn" @click="createPost">create</button>
      </form>
    <div class="post" v-for="post in posts">
      <div><strong>Название:</strong> {{ post.title }} </div>
      <div><strong>Описание</strong> {{ post.body }}</div>
    </div>
  </div>
</template>

<style>
  .app {
    padding: 20px;
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .post {
    padding: 15px;
    border: 2px solid teal;
    margin-top: 15px;
  }

  .input {
    width: 100%;
    border: 2px solid teal;
    padding: 10px 15px;
    margin-top: 15px;
  }

  form {
    display: flex;
    flex-direction: column;
  }

  .btn {
    align-self: flex-end;
    margin-top: 15px;
    padding: 10px 15px;
    background: none;
    color: teal;
    border: 1px solid teal;
  }
</style>

<script>
  export default {
    data() {
      return {
        posts: [
          {
            id: 1,
            title: 'Title js',
            body: 'body of post js'
          },
          {
            id: 2,
            title: 'Title php',
            body: 'body of post php'
          },
        ],
        title: '',
        body: ''
      }
    },
    methods: {
      createPost() {

      }
    }
  }
</script>