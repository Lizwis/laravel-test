import { createRouter, createWebHistory } from 'vue-router'
//import HomeView from '../views/HomeView.vue'

import PostList from "../views/post/ListPosts.vue";
import ShowPost from "../views/post/ShowPost.vue";
import AddPost from "../views/post/AddPost.vue";

import Login from "../views/auth/Login.vue";
import Register from "../views/auth/Register.vue";
import { useAuthStore } from "@/stores/auth";



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView
    // },
    {
      path: "/",
      name: "posts",
      component: PostList,
    },
    {
      path: "/show-post/:id",
      
      name: "showPost",
      component: ShowPost,
    },
    {
      path: "/add-post",
      name: "addPost",
      component: AddPost,
      meta: { authOnly: true },

    }, 
    {
      path: "/login",
      name: "login",
      component: Login,
      meta: { guestOnly: true },
    },  
    {
      path: "/register",
      name: "register",
      component: Register,

    }
  ]

  
})

function isLoggedIn() {
  const authStore = useAuthStore();
  return authStore.user;
}
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.authOnly)) {
    if (!isLoggedIn()) {
      next({
        path: "/login",
        query: { redirect: to.fullPath },
      });
    } else {
      next();
    }
  } else if (to.matched.some((record) => record.meta.guestOnly)) {
    if (isLoggedIn()) {
      next({
        path: "/",
        query: { redirect: to.fullPath },
      });
    } else {
      next();
    }
  } else {
    next();
  }
});


export default router
