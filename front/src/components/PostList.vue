<template>
  <div v-if="posts.length > 0">
    <h3>Список постов</h3>
    <transition-group name="postList">
      <post-item class="post"
                 v-for="post in posts"
                 :post="post"
                 :key="post.id"
                 @remove="$emit('remove', post)"
      />
    </transition-group>

  </div>
  <h2 v-else style="color: red">Список постов пуст</h2>
</template>

<script>
import PostItem from "@/components/PostItem.vue";

export default {
  components: {PostItem},
  props: {
    posts: {
      type: Array,
      required: true,
    }
  }
}
</script>

<style scoped>
  .postList-item {
    display: inline-block;
    margin-right: 10px;
  }
  .postList-enter-active,
  .postList-leave-active {
    transition: all 0.4s ease;
  }
  .postList-enter-from,
  .postList-leave-to {
    opacity: 0;
    transform: translateX(130px);
  }
  .postList-move {
    transition: transform 0.4s ease;
  }

</style>