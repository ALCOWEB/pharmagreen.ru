<template>
  <div class="app">
    <h1>Posts page</h1>
    <my-button
      @click="showDialog"
      style="margin: 15px 0"
    >Create post</my-button>
    <my-dialog v-model:show="dialogVisible">
      <post-form
          @create="createPost"
      />
    </my-dialog>
    <post-list
        :posts="posts"
        @remove="removePost"
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
import MyButton from "@/components/UI/MyButton.vue";
import MyDialog from "@/components/UI/MyDialog.vue";
import axios from 'axios';
export default {
    components: {
      MyDialog,
      MyButton,
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
        ],
        dialogVisible: false
      }
    },
    methods: {
      createPost(post) {
        this.posts.push(post);
        this.dialogVisible = false
      },
      removePost(post) {
        this.posts = this.posts.filter(p => p.id !== post.id)
      },
      showDialog() {
        this.dialogVisible = true
      },
      async fetchUsers() {
        try {
          const response = await axios
        } catch (e) {
          alert("error")
        }
      }
    }
  }
</script>