<template>
  <div>
    <div class="col-12 py-2 px-2 post-wrapper shadow-sm my-1">
      <div v-if="post">
        <div class="d-flex justify-content-between">
          <h6>
            {{ post.title }}
            <UpdateTitle
              :post="{ post_title: post.title, post_id: post.post_id }"
              @refresh-post="get_post"
              v-if="authStore.user"
            />
          </h6>

          <span class="text-primary post-date">{{ post.last_updated }}</span>
        </div>
        <div class="post-content pt-2">
          {{ post.content }}
          <UpdateContent
            :post="{ post_content: post.content, post_id: post.post_id }"
            @refresh-post="get_post"
            v-if="authStore.user"
          />
        </div>
      </div>

      <div v-else class="loading col-12 text-center">
        <img src="../../assets/images/loading-gif2.gif" height="" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Post from "../../api/Post";

import UpdateTitle from "../../components/UpdateTitle.vue";

import UpdateContent from "../../components/UpdateContent.vue";

import { useAuthStore } from "@/stores/auth";

export default defineComponent({
  components: { UpdateTitle, UpdateContent },
  data() {
    return {
      post: <Array<any> | null>null,
      authStore: {} as Record<string, any>,
    };
  },
  created() {
    this.get_post();

    this.authStore = useAuthStore();
  },
  methods: {
    get_post(): void {
      this.post = null;
      const post_id = this.$route.params.id as string;
      Post.singlePost(post_id).then((response) => {
        this.post = response.data.data;
      });
    },
  },
});
</script>

<style></style>
