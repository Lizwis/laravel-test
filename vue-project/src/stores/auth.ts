import {defineStore} from 'pinia';
import User from "@/api/auth";



export const useAuthStore = defineStore('auth',{
    state:() =>({
        authUser: null,
    }),
    getters:{
        user: (state) => state.authUser
    },
    actions:{
        async getToken(){
           await User.crsfToken();
        },
        async getUser(){
            await this.getToken();
            await User.auth().then((response: any) => {
                this.authUser = response.data;
              });
        },
        async logout(){

          await User.logout().then(() =>{
            this.authUser = null;
          });

          this.router.push("/");
        },
    },
    persist: true,

})