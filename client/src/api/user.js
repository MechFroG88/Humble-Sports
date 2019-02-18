import request from '@/api/request';

export function userLogin(data) {
  return request({
    url: '/user/login',
    method: 'POST',
    data,
  });
}

export function userLogout(data) {
  return request({
    url: '/user/logout',
    method: 'POST',
    data
  });
}

export function getAllUsers() {
  return request({
    url: '/user',
    method: 'GET'
  });
}
export function getUser(userId) {
  return request({
    url: `/user/${userId}`,
    method: 'GET'
  });
}

export function postUser(data){
  return request({
    url: '/user',
    method: 'POST',
    data,
  });
}
