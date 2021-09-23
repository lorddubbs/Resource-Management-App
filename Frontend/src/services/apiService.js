import Vue from "vue";
import axios from "./request";

class BaseApiService {
  baseUrl = process.env.API_URL;
  resource;

  constructor(resource) {
    if (!resource) throw new Error("No resource is provided");
    this.resource = resource;
  }

  getUrl(id = "") {
    return `${this.baseUrl}/${this.resource}/${id}`;
  }

  defaultUrl(id = "") {
    return `${this.baseUrl}/${this.resource}`;
  }


  handleErrors(error) {
    let errors = error.response.data.errors;
    if (
      error.response.status === 404
    ) {
      Vue.$toast.error(error.response.data.message);
      return;
    }
    for (let field of Object.keys(errors)) {
      Vue.$toast.error(errors[field][0], "error");
    }
  }
}

class GetterApiService extends BaseApiService {
  constructor(resource) {
    super(resource);
  }
  async fetch(config = {}) {
    try {
      const response = await axios.get(this.defaultUrl(), config);
      return response.data;
    } catch (error) {
      this.handleErrors(error);
    }
  }
  async get(id) {
    try {
      if (!id) throw Error("No record id is provided");
      const response = await axios.get(this.getUrl(id));
      return response.data;
    } catch (error) {
      this.handleErrors(error);
    }
  }
}

class ModelApiService extends GetterApiService {
  constructor(resource) {
    super(resource);
  }
  async post(data = {}) {
    try {
      //await axios.get(this.defaultUrl() + "csrf-cookie");
      const response = await axios.post(this.defaultUrl(), data);
      //const { id } = response.data;
      //return id;
      return response.data;
    } catch (error) {
      this.handleErrors(error);
    }
  } 
  async put(id, data = {}) {
    if (!id) throw Error("No record id is provided");
    try {
      const response = await axios.post(this.getUrl(id), data);
      const { id: responseId } = response.data;
      return responseId;
      //return response.data;
    } catch (error) {
      this.handleErrors(error);
    }
  }
  async delete(id) {
    if (!id) throw Error("No record id is provided");
    try {
      await axios.delete(this.getUrl(id));
      return true;
    } catch (error) {
      this.handleErrors(error);
    }
  }

}


class UserApiService extends ModelApiService {
  constructor() {
    super("user");
  }
}

class AssetApiService extends ModelApiService {
  constructor() {
    super("asset");
  }
  
  async getAssetCounts() {
    try {
      const response = await axios.get(
        this.defaultUrl() + "/counts");
      return response.data;
    } catch (error) {
      this.handleErrors(error);
      return;
    }
  }
  
  async getMediaAssets(media) {
    try {
      await axios.get(this.defaultUrl() + "csrf-cookie");
      const response = await axios.get(
        this.baseUrl + `/asset/${media}/type`
      );
      return response.data;
    } catch (error) {
      this.handleErrors(error);
      return;
    }
  }
}


export const $apiService = {
  user: new UserApiService(),
  asset: new AssetApiService()
};
