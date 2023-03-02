import Axios from "./Axios";

export default {

  crsfToken(){
    return Axios().get("/sanctum/csrf-cookie")
  },

  register(form:any): Promise<any> {
    return Axios().post("/register", form);
  },

  login(form:any): Promise<any> {
    return Axios().post("/login", form);
  },

  logout(): Promise<any> {
    return Axios().post("/logout");
  },

  auth(): Promise<any> {
    return Axios().get("/api/user");
  },
};
