import { default as axios } from 'axios'


let BaseApi = axios.create({

  baseURL: "http://localhost:8000",
});


let Api = function () {
  // let token = localStorage.getItem("access_token");

  // BaseApi.defaults.headers.common["Authorization"] = `Bearer ${token}`;

  BaseApi.defaults.withCredentials = true;
  // BaseApi.get("/sanctum/csrf-cookie")


  return BaseApi;
};



export default Api;
