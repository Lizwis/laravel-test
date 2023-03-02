import Axios from "./Axios";

export default {
  listPosts(): Promise<any> {
    return Axios().get("api/post/list");
  },

  singlePost(id: any): Promise<any> {
    return Axios().get(`api/post/show/${id}`);
  },

  storePost(form: any): Promise<any> {
    return Axios().post("api/post/store", form);
  },

  updateTile(id: any ,form: any): Promise<any> {
    return Axios().post(`api/post/updateTile/${id}`,form);
  },

  updateContent(id: any ,form: any): Promise<any> {
    return Axios().post(`api/post/updateContent/${id}`,form);
  },

  
  deletePost(id:any): Promise<any> {
    return Axios().post(`api/post/destroy/${id}`);
  },
};
