<template>
  <div>
    <div v-if="posts">
      <div
        class="col-12 py-2 px-2 post-wrapper shadow-sm my-1"
        v-for="(post, key) in posts"
        :key="key"
      >
        <div v-if="post.post_id">
          <div class="d-flex justify-content-between">
            <div class="col-9">
              <div>
                <h6>{{ post.title }}</h6>
              </div>
              <div>
                <span class="text-primary post-date text-end">{{
                  post.last_updated
                }}</span>
              </div>
            </div>
            <div class="col-3 text-end d-flex justify-content-end py-2">
              <el-button
                type="primary"
                @click="selectedPost(post.post_id)"
                :icon="View"
              />
              <DeleteAction
                :post_id="post.post_id"
                @refresh-posts="getPosts"
                v-if="authStore.user"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="loading col-12 text-center">
      <img src="../../assets/images/loading-gif2.gif" height="" />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from "vue";
import Post from "@/api/Post";
import DeleteAction from "@/components/DeleteAction.vue";
import { ElButton } from "element-plus";
import { View } from "@element-plus/icons-vue";
import { useRouter } from "vue-router";

import { useAuthStore } from "@/stores/auth";

export default defineComponent({
  name: "list-posts",
  components: { DeleteAction, ElButton },

  setup() {
    const posts = ref<Array<any> | null>(null);
    const router = useRouter();

    const getPosts = async () => {
      posts.value = null;
      const response = await Post.listPosts();
      posts.value = response.data.data;
    };

    onMounted(async () => {
      await getPosts();
    });

    const selectedPost = (id: number) => {
      router.push({ path: `/show-post/${id}` });
    };

    const authStore = useAuthStore();

    return { View, posts, selectedPost, getPosts, authStore };
  },
});
</script>

<style scoped>
.post-wrapper {
  background-color: #ffffff;
  cursor: pointer;
}

.post-content {
  font-size: 15px;
  color: #a7abae;
}

.post-date {
  font-size: 13px;
}
</style>
