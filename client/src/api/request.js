import { getToken, deleteToken } from './auth';
import router from '@/router'
import axios from 'axios'
import qs    from 'qs'

const service = axios.create({ 
  //local url: http://mechfrog88.ddns.net:4928
  baseURL: process.env.NODE_ENV === 'production' ? "/api/" : "http://mechfrog88.ddns.net:4928",
  withCredentials: true,
  transformRequest: [function (data, headers) {
    if(headers['Content-Type'] == "multipart/form-data"){
      return data;
    }
    return qs.stringify(data);
  }],
})

service.interceptors.request.use(function (config) {
  config.headers['Authorization'] = getToken() ? getToken() : (window.token ? window.token : "")
  return config
}, function (error) {
  return Promise.reject(error)
})

service.interceptors.response.use(function (response) {
  return response;
}, function (error) { 
  // if(error.response.status == 401){
  //   router.push('/login')
  // }
  return Promise.reject(error);
});

export default service