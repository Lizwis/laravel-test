<template>
  <div>
    <div class="row justify-content-center pt-0 mt-2">
      <div class="col-8 py-4 px-0 mx-0">
        <el-alert
          title="Post created successfully"
          type="success"
          show-icon
          v-show="successAlert"
        />
        <el-alert
          title="Please resolve errors"
          type="error"
          show-icon
          :closable="false"
          v-show="errorAlert"
        />
      </div>
      <div class="col-8 border shadow-sm py-4 px-2 mx-2">
        <form>
          <div class="col-md-12 font-weight-bold px-4" style="font-size: 14px">
            <h6 class="label">Title</h6>
            <span class="text-danger font-weight-light" v-if="errorTitle">{{
              errorTitle[0]
            }}</span>
            <el-input v-model="title" class="" />
          </div>

          <div
            class="col-md-12 font-weight-bold pt-3 px-4"
            style="font-size: 14px"
          >
            <h6 class="label">Content</h6>
            <span class="text-danger font-weight-light" v-if="errorContent">{{
              errorContent[0]
            }}</span>
            <el-input v-model="content" type="textarea" rows="10" class="" />
          </div>
          <mavon-editor v-model="content" />
          <div class="col-12 px-4 pb-4 text-center pt-2">
            <el-button type="primary" plain @click="save">Submit</el-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import type { Ref } from "vue";

import { ElInput, ElButton, ElAlert } from "element-plus";

import Post from "@/api/Post";

import mavonEditor from "mavon-editor";
import "mavon-editor/dist/css/index.css";

export default defineComponent({
  name: "AddPost",
  components: { ElInput, ElButton, ElAlert, mavonEditor },
  setup() {
    const title: Ref<string> = ref("");
    const content: Ref<string> = ref("");
    const errorTitle: Ref<string> = ref("");
    const errorContent: Ref<string> = ref("");
    const successAlert: Ref<boolean> = ref(false);
    const errorAlert: Ref<boolean> = ref(false);

    const save = async (): Promise<void> => {
      try {
        await Post.storePost({ title: title.value, content: content.value });
        successAlert.value = true;
        errorAlert.value = false;
        errorContent.value = "";
        errorTitle.value = "";
        title.value = "";
        content.value = "";
      } catch (error: any) {
        const { response } = error as {
          response: { data: { errors: { content: string; title: string } } };
        };
        errorContent.value = response.data.errors.content;
        errorTitle.value = response.data.errors.title;
        errorAlert.value = true;
        successAlert.value = false;
      }
    };

    return {
      title,
      content,
      errorContent,
      errorTitle,
      successAlert,
      errorAlert,
      save,
      mavonEditor,
    };
  },
});
</script>

<style sc></style>
