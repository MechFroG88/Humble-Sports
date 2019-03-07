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

export function getCurrentUser() {
  return request({
    url: '/user/current',
    method: 'GET'
  })
}

export function getUser(userId) {
  return request({
    url: `/user/${userId}`,
    method: 'GET'
  });
}

export function createUser(data){
  return request({
    url: '/user',
    method: 'POST',
    data,
  });
}

export function updateUserPassword(data) {
  return request({
    url: '/user/password',
    method: 'PUT',
    data
  })
}

export function updateUserType(userId, data) {
  return request({
    url: `/user/${userId}`,
    method: 'PUT',
    data
  })
}

export function deleteUser(userId) {
  return request({
    url: `/user/${userId}`,
    method: 'DELETE',
  })
}