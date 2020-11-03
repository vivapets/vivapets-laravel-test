import axios from "axios";

const baseDomain = "http://127.0.0.1";
const baseURL = `${baseDomain}/api/v1`; // Incase of /api/v1;

const instance = axios.create({
  baseURL
});

instance.interceptors.request.use(function (config) {
    let auth = '';
    if(window.localStorage.getItem('access_token') !== null) {
        auth = "Bearer " + window.localStorage.getItem('access_token');
    } 

    config.headers.Authorization = auth;
    return config;
});


export default instance