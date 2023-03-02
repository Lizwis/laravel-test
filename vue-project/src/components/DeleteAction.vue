<template>
  <el-button type="danger" @click="openConfirmModal()" :icon="Delete" circle />
</template>

<script lang="ts">
import { defineComponent } from "vue";

import { ElButton, ElMessage, ElMessageBox } from "element-plus";

import { Delete } from "@element-plus/icons-vue";

import { useRouter } from "vue-router";

import Post from "@/api/Post";

interface PostProps {
  post_id: number;
}

export default defineComponent({
  name: "post-actions",
  components: { ElButton },
  props: ["post_id"],

  emits: ["refresh-posts"],

  setup(props, { emit }) {
    const router = useRouter();

    const handleDelete = () => {
      emit("refresh-posts");
    };

    const openConfirmModal = () => {
      ElMessageBox.confirm(
        "Are you sure you want to delete this post. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning",
        }
      )
        .then(() => {
          Post.deletePost(props.post_id);
          handleDelete();
          ElMessage({
            type: "success",
            message: "Delete completed",
          });
        })
        .catch(() => {
          ElMessage({
            type: "info",
            message: "Delete canceled",
          });
        });
    };

    return {
      openConfirmModal,
      router,
      handleDelete,
      Delete,
    };
  },
});
</script>

<style></style>
