import request from '@/api/request'

export function getItem() {
  return request({
    url: '/item',
    method: 'GET'
  })
}

export function postItem(data) {
  return request({
    url: '/item',
    method: 'POST',
    data
  })
}

export function getItemRecord(itemId) {
  return request({
    url: `/item/record/${itemId}`,
    method: 'GET'
  })
}