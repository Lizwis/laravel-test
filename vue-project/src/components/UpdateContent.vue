<template>
  <div>
    <el-button :icon="Edit" plain @click="dialogVisibleContent = true" />
    <el-dialog v-model="dialogVisibleContent" title="Edit Content" width="50%">
      <span class="text-danger font-weight-light" v-if="errorContent">{{
        errorContent[0]
      }}</span>
      <textarea
        v-model="new_content"
        class="form-control mt-2 font-weight-light"
        rows="10"
        style="height: 100%"
      ></textarea>

      <template #footer>
        <span class="dialog-footer">
          <el-button @click="Cancel()">Cancel</el-button>
          <el-button type="primary" @click="SaveContent()"> Save </el-button>
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
    post_content: string;
  };
}

export default defineComponent({
  name: "update-content",

  props: {
    post: Object as () => PostProps["post"],
  },

  emits: ["refresh-post"],

  components: { ElButton, ElDialog, ElInput },

  setup(props, { emit }) {
    const dialogVisibleContent = ref<boolean>(false);
    const new_content = ref(props.post?.post_content ?? "");

    const errorContent = ref<string>("");
    const id = props.post?.post_id;

    const handleUpdate = () => {
      emit("refresh-post");
    };

    const SaveContent = () => {
      Post.updateContent(id, { content: new_content.value })
        .then(() => {
          dialogVisibleContent.value = false;
          handleUpdate();
        })
        .catch(
          (error: { response: { data: { errors: { content: string } } } }) => {
            dialogVisibleContent.value = true;
            errorContent.value = error.response.data.errors.content;
          }
        );
    };

    const Cancel = () => {
      errorContent.value = "";
      dialogVisibleContent.value = false;
    };

    return {
      dialogVisibleContent,
      new_content,
      errorContent,
      SaveContent,
      Cancel,
      Edit,
    };
  },
});
</script>

<style></style>
