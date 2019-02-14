import request from '@/api/request'

export function userLogin(data) {
  return request({
    url: '/user/login',
    method: 'POST',
    data
  })
}

export function userLogout() {
  return request({
    url: '/user/logout',
    method: 'POST'
  })
}