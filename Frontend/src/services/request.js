import axios from "axios";

const API_URL = process.env.API_URL;

let devInstance = axios.create({
  baseURL: API_URL || "http://localhost/app/v1",
  withCredentials: true
});

export default devInstance;

