import request from '@/api/request'

export function userLogin(data) {
  return request({
    url: '/user/login',
    method: 'POST',
    data
  })
}