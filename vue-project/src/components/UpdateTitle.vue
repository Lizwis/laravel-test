<template>
  <div>
    <el-button :icon="Edit" plain @click="dialogVisibleTitle = true" />
    <el-dialog v-model="dialogVisibleTitle" title="Edit Title" width="50%">
      <span class="text-danger font-weight-light" v-if="errorTitle">{{
        errorTitle[0]
      }}</span>
      <input
        type="text"
        v-model="new_title"
        class="form-control input-height mt-2 font-weight-light"
      />

      <template #footer>
        <span class="dialog-footer">
          <el-button @click="Cancel()">Cancel</el-button>
          <el-button type="primary" @click="SaveTitle()"> Save </el-button>
        </span>
      </template>
    </el-dialog>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";

import { ElButton, ElDialog, ElInput } from "element-plus";

import { Edit } from "@element-plus/icons-vue";

import Post from "@/api/Post";

interface PostProps {
  post?: {
    post_id: number;
    post_title: string;
  };
}
export default defineComponent({
  name: "update-title",

  props: {
    post: Object as () => PostProps["post"],
  },

  emits: ["refresh-post"],

  components: { ElButton, ElDialog, ElInput },
  setup(props, { emit }) {
    const dialogVisibleTitle = ref(false);
    const new_title = ref(props.post?.post_title ?? "");

    const errorTitle = ref("");
    const id = props.post?.post_id;
    const handleUpdate = () => {
      emit("refresh-post");
    };

    const SaveTitle = () => {
      Post.updateTile(id, { title: new_title.value })
        .then(() => {
          dialogVisibleTitle.value = false;
          handleUpdate();
        })
        .catch((error: any) => {
          dialogVisibleTitle.value = true;
          errorTitle.value = error.response.data.errors.title;
        });
    };

    const Cancel = () => {
      errorTitle.value = "";
      dialogVisibleTitle.value = false;
    };

    return {
      dialogVisibleTitle,
      new_title,
      errorTitle,
      handleUpdate,
      SaveTitle,
      Cancel,
      Edit,
    };
  },
});
</script>

<style></style>
