<template>
  <div >
    <h1>{{ $store.getters.doubleLikes }}</h1>
    <div>
      <my-button @click="$store.commit('incrementLikes')">Increment Liks</my-button>
      <my-button @click="$store.commit('decrementLikes')">Decrement Liks</my-button>
    </div>
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
    <div ref="observer" class="observer"></div>
    <!--    <div class="page__wrapper">-->
    <!--        <div-->
    <!--          v-for="pageNumber in totalPages"-->
    <!--          :key="pageNumber"-->
    <!--          class="page"-->
    <!--          @click="changePage(pageNumber)"-->
    <!--          :class="{-->
    <!--            'current__page': page === pageNumber-->
    <!--          }"-->
    <!--        > {{ pageNumber }}-->
    <!--        </div>-->
    <!--    </div>-->
  </div>
</template>

<style>

.app_btns {
  margin: 15px 0;
  display: flex;
  justify-content: space-between;
}

.page__wrapper {
  display: flex;
  margin-top: 15px;
}
.page {
  border: 1px solid black;
  padding: 10px;
}
.current__page {
  border: 2px solid green;
}
.observer {
  height: 20px;
  background-color: yellow;
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
      page: 1,
      limit: 10,
      totalPages: 0,
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
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts', {
          params: {
            _page: this.page,
            _limit: this.limit
          }
        });
        this.totalPages = Math.ceil(response.headers['x-total-count'] / this.limit);
        this.posts = [...this.posts, ...response.data];
      } catch (e) {
        alert("error")
      } finally {
        this.postsLoading = false;
      }
    },
    async loadMorePosts() {
      try {
        this.page += 1;
        const response = await axios.get('https://jsonplaceholder.typicode.com/posts', {
          params: {
            _page: this.page,
            _limit: this.limit
          }
        });
        this.totalPages = Math.ceil(response.headers['x-total-count'] / this.limit);
        this.posts = [...this.posts, ...response.data];
      } catch (e) {
        alert("error")
      }
    },
    // changePage(pageNumber) {
    //   this.page = pageNumber;
    // }
  },
  mounted() {
    this.fetchPosts();
    const options = {
      rootMargin: '0px',
      threshold: 1.0
    }
    const callback = (entries, observer) => {
      if(entries[0].isIntersecting && this.page < this.totalPages) {
        this.loadMorePosts();
      }

    };
    const observer = new IntersectionObserver(callback, options);
    observer.observe(this.$refs.observer);

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
    // page() {
    //   this.fetchPosts()
    // }
  }
}
</script>