<template>
  <div class="app">
    <h1>Posts page</h1>
    <my-input v-model="searchQuery"/>
    <div class="app_btns">
      <my-button
          @click="showDialog"
      >Create posts</my-button>
      <my-select
          v-model="selectedSort"
          :options="sortOptions"
        />
    </div>
    <my-dialog v-model:show="dialogVisible">
      <post-form
          @create="createPost"
      />
    </my-dialog>
    <post-list
        :posts="sortedAndSearchedPosts"
        @remove="removePost"
        v-if="!postsLoading"
    />
    <div v-else>идёт загрузка</div>
  </div>
</template>

<style>
  .app {
    padding: 20px;
  }
  .app_btns {
    margin: 15px 0;
    display: flex;
    justify-content: space-between;
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
import {onMounted} from "vue";
import MySelect from "@/components/UI/MySelect.vue";
import MyInput from "@/components/UI/MyInput.vue";
export default {
    components: {
      MyInput,
      MySelect,
      MyDialog,
      MyButton,
      PostForm, PostList
    },
    data() {
      return {
        posts: [],
        dialogVisible: false,
        postsLoading: false,
        selectedSort: '',
        searchQuery: '',
        sortOptions: [
          {
            value: 'title',
            name: 'По названию'
          },
          {
            value: 'body',
            name: 'по описанию'
          }
        ]
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
      async fetchPosts() {
        try {
          this.postsLoading = true;
            const response = await axios.get('https://jsonplaceholder.typicode.com/posts?_limit=10');
            this.posts = response.data;
        } catch (e) {
          alert("error")
        } finally {
          this.postsLoading = false;
        }
      }
    },
    mounted() {
      this.fetchPosts();
    },
    computed: {
      sortedPosts() {
       return [...this.posts].sort((a, b) => {
         return a[this.selectedSort]?.localeCompare(b[this.selectedSort]);
       })
      },
      sortedAndSearchedPosts() {
        return this.sortedPosts.filter(post => post.title.includes(this.searchQuery));
      }
    },
    watch: {

    }
  }
</script>