<template>
  <div class="app">
    <post-form
        @create="createPost"
    />
    <post-list
        :posts="posts"
    />
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


</style>

<script>
import PostList from "@/components/PostList.vue";
import PostForm from "@/components/PostForm.vue";
export default {
    components: {
      PostForm, PostList
    },
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
        ]
      }
    },
    methods: {
      createPost(post) {
        this.posts.push(post)
      }
    }
  }
</script>