<template>
  <div>
    <div class="col-12 shadow-sm" style="background-color: #ffffff">
      <nav
        class="navbar navbar-expand-lg bg-gradient-light py-2"
        style="background-color: #ffffff !important; color: #606266"
      >
        <div class="col-12 d-flex justify-content-center">
          <div class="col-8">
            <div class="row">
              <div class="col-4">
                <div class="row">
                  <div class="col-2 text-start">
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
                  </div>
                  <div class="col-10 pt-2">
                    <el-button type="primary" @click="createPost">
                      Create Post
                    </el-button>
                  </div>
                </div>
              </div>

              <div class="col-8 text-end pt-2">
                <div>
                  <template v-if="!authStore.user">
                    <a class="nav-link">
                      <el-button plain @click="register">Sign up</el-button>
                      <el-button type="primary" plain @click="login"
                        >Login</el-button
                      >
                    </a>
                  </template>
                  <template v-else>
                    <a class="nav-link"
                      ><el-button type="primary" @click="authStore.logout" plain
                        >Logout</el-button
                      >
                    </a>
                  </template>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent } from "vue";

import { ElButton } from "element-plus";

import { useAuthStore } from "@/stores/auth";

import { useRouter } from "vue-router";

export default defineComponent({
  components: { ElButton },

  setup() {
    const authStore = useAuthStore();

    const router = useRouter();

    const register = () => {
      router.push({ path: "/register" });
    };
    const login = () => {
      router.push({ path: "/login" });
    };
    const createPost = () => {
      router.push({ path: "/add-post" });
    };
    return {
      authStore,
      register,
      login,
      createPost,
      router,
    };
  },
});
</script>

<style scoped>
.auth-button {
  font-family: Gt-America-Font-bold !important;
  border-radius: 22px;
  height: 40px;
}
.list-group-item {
  border: none;
}
</style>
