import { getToken } from '@/api/auth';
// import router from '@/router';
import axios from 'axios';
import qs from 'qs';

// const local = 'http://mechfrog88.ddns.net/';
<<<<<<< HEAD
=======
const local = 'http://121.121.86.232/';
>>>>>>> 20618ac517240a1d1285ba6790ce7202685374d5
// const local = 'http://178.128.126.127:8080/';
const local = 'http://121.121.86.232';

const service = axios.create({
  baseURL: process.env.NODE_ENV === 'production' ? '/api/' : local,
  transformRequest: [(data, headers) => {
    if (headers['Content-Type'] === 'multipart/form-data') {
      return data;
    }
    return qs.stringify(data);
  }],
  withCredentials: true,
});

service.interceptors.request.use((config) => {
  config.headers.Authorization = getToken() ? getToken() : (window.token ? window.token : '');
  return config;
}, error => Promise.reject(error));

service.interceptors.response.use(response => response, error => Promise.reject(error));

export default service;
