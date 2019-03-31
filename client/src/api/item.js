import request from '@/api/request';

export function getItem() {
  return request({
    url: '/item',
    method: 'GET'
  });
}

export function getSingleItem(id) {
  return request({
    url: `/item/${id}`,
    method: 'GET'
  });
}

export function postItem(data) {
  return request({
    url: '/item',
    method: 'POST',
    data
  });
}

export function getItemRecord(itemId) {
  return request({
    url: `/item/record/${itemId}`,
    method: 'GET'
  });
}

export function deleteItem(itemId) {
  return request({
    url: `/item/${itemId}`,
    method: 'DELETE',
  });
}

export function editItem(itemId, data) {
  return request({
    url: `/item/${itemId}`,
    method: 'PUT',
    data
  });
}