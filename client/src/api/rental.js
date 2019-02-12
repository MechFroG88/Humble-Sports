import request from '@/api/request'

export function getPersonalRent() {
  return request({
    url: '/rent/personal',
    method: 'GET'
  })
}