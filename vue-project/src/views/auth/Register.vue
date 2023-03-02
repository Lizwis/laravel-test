<template>
  <div>
    <div class="row justify-content-center pt-0 mt-2">
      <div class="col-6 py-4 px-0 mx-0">
        <el-alert
          title="Please resolve errors"
          type="error"
          show-icon
          :closable="false"
          v-show="errorAlert"
        />
      </div>
      <div class="col-6 border shadow-sm py-4 px-2 mx-2">
        <div class="col-12 text-center py-4 bg-login">
          <router-link to="/">
            <svg
              id="line"
              height="40px"
              viewBox="0 0 64 64"
              width="40px"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="m62.5 56h-5v-37.5a3 3 0 0 0 -3-3h-30.5a3 3 0 0 0 -3 3v38.248a7.183 7.183 0 0 0 6.786 7.252c.071 0 .143.005.214 0h28.5a7.008 7.008 0 0 0 7-7 1 1 0 0 0 -1-1zm-28.75-33.75h11a1 1 0 0 1 0 2h-11a1 1 0 0 1 0-2zm-6.5 6.75h24a1 1 0 0 1 0 2h-24a1 1 0 0 1 0-2zm0 8.75a1 1 0 0 1 0-2h24a1 1 0 0 1 0 2zm24 6.75h-12a1 1 0 0 1 0-2h12a1 1 0 0 1 0 2zm1 5.75a1 1 0 0 1 -1 1h-6a1 1 0 0 1 0-2h6a1 1 0 0 1 1 1zm4.25 11.75h-23.6a6.941 6.941 0 0 0 2.031-4h26.469a5.008 5.008 0 0 1 -4.9 4z"
                fill="#32CB00"
              />
            </svg>
          </router-link>
          <h5 class="pt-4">Register Your Account!</h5>
        </div>

        <form @submit.prevent="submit()">
          <div class="col-md-12 font-weight-bold px-4" style="font-size: 14px">
            <h6 class="label">Name</h6>
            <el-input v-model="form.name" :prefix-icon="Avatar" />

            <span class="text-danger font-weight-light" v-if="errors.name">{{
              errors.name[0]
            }}</span>
          </div>

          <div
            class="col-md-12 font-weight-bold px-4 pt-3"
            style="font-size: 14px"
          >
            <h6 class="label">Email</h6>
            <el-input v-model="form.email" :prefix-icon="Message" />

            <span class="text-danger font-weight-light" v-if="errors.email">{{
              errors.email[0]
            }}</span>
          </div>

          <div
            class="col-md-12 font-weight-bold pt-3 px-4"
            style="font-size: 14px"
          >
            <h6 class="label">Password</h6>

            <el-input
              v-model="form.password"
              type="password"
              :prefix-icon="Lock"
            />

            <span
              class="text-danger font-weight-light"
              v-if="errors.password"
              >{{ errors.password[0] }}</span
            >
          </div>

          <div
            class="col-md-12 font-weight-bold pt-3 px-4"
            style="font-size: 14px"
          >
            <h6 class="label">Confirm Password</h6>

            <el-input
              v-model="form.password_confirmation"
              type="password"
              :prefix-icon="Lock"
            />

            <span
              class="text-danger font-weight-light"
              v-if="errors.password_confirmation"
              >{{ errors.password_confirmation[0] }}</span
            >
          </div>

          <div class="col-12 px-4 py-4 text-center">
            <el-button type="primary" @click="submit">Register</el-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import User from "@/api/auth";
import { useRouter } from "vue-router";
import { ElInput, ElButton, ElAlert } from "element-plus";
import { Avatar, Lock, Message } from "@element-plus/icons-vue";

import { useAuthStore } from "@/stores/auth";

export default defineComponent({
  name: "Register",
  components: { ElInput, ElButton, ElAlert, Avatar, Lock, Message },
  setup() {
    const form = ref({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    });

    const errors = ref<string[]>([]);
    const router = useRouter();

    const errorAlert = ref(false);

    const authStore = useAuthStore();

    const submit = async () => {
      try {
        await User.register(form.value);
        errorAlert.value = false;
        authStore.getUser();
        router.push({ path: "/" });
      } catch (error: any) {
        errors.value = error.response.data.errors;
        errorAlert.value = true;
      }
    };

    return {
      form,
      submit,
      errors,
      router,
      errorAlert,
      Avatar,
      Lock,
      Message,
    };
  },
});
</script>

<style></style>
