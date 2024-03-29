import request from '@/api/request';

export function getPersonalRent() {
  return request({
    url: '/rent/personal',
    method: 'GET',
  });
}

export function getPersonalRentSort() {
  return request({
    url: '/rent/personal/sort',
    method: 'GET',
  })
}

export function postPersonalRent({student_id, item_id, item_tag, due_date}) {
  return request({
    url: '/rent/personal',
    method: 'POST',
    data: {
      student_id, item_id, item_tag, due_date
    },
  });
}

export function getGroupRent() {
  return request({
    url: '/rent/group',
    method: 'GET',
  });
}

export function getGroupRentSort() {
  return request({
    url: '/rent/group/sort',
    method: 'GET',
  })
}

export function postGroupRent(data) {
  return request({
    url: '/rent/group',
    method: 'POST',
    data,
  });
}

export function returnPersonal(rentId, amount) {
  return request({
    url: `/rent/personal/${rentId}/return`,
    method: 'PUT',
    data: {
      lost: amount,
    }
  })
}

export function returnGroup(rentId, amount) {
  return request({
    url: `/rent/group/${rentId}/return`,
    method: 'PUT',
    data: {
      lost: amount,
    }
  })
}

export function expire(type) {
  return request({
    url: `/rent/${type}/expired`,
    method: 'PUT'
  })
}

export function deletePersonalRent(rentId) {
  return request({
    url: `/rent/personal/${rentId}`,
    method: 'DELETE',
  })
}

export function deleteGroupRent(rentId) {
  return request({
    url: `/rent/group/${rentId}`,
    method: 'DELETE',
  })
}

export function payPersonalRent(rentId) {
  return request({
    url: `/rent/personal/pay/${rentId}`,
    method: 'PUT'
  })
}

export function payGroupRent(rentId) {
  return request({
    url: `/rent/group/pay/${rentId}`,
    method: 'PUT'
  })
}

export function cancelPersonalRent(rentId) {
  return request({
    url: `/rent/personal/revert/${rentId}`,
    method: 'PUT'
  })
}

export function cancelGroupRent(rentId) {
  return request({
    url: `/rent/group/revert/${rentId}`,
    method: 'PUT'
  })
}