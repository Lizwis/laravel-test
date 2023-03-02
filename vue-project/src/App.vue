<script lang="ts">
import Navigation from "./components/Navigation.vue";

import { defineComponent, ref } from "vue";
import { useRouter } from "vue-router";

export default defineComponent({
  components: {
    Navigation,
  },

  setup() {},
});
</script>

<template>
  <div>
    <div class="col-12">
      <Navigation />
    </div>
    <div class="col-12 d-flex justify-content-center">
      <div class="col-8 pt-4">
        <router-view />
      </div>
    </div>
  </div>
</template>

<style>
body {
  background-color: #fafcfe !important;
}
.form-control {
  border: 1px solid #bdc4c9 !important;
}

.input-height {
  height: 40px !important;
}
</style>
