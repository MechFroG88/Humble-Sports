import request from '@/api/request';

export function getPersonalRent() {
  return request({
    url: '/rent/personal',
    method: 'GET',
  });
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

export function postGroupRent(data) {
  return request({
    url: '/rent/group',
    method: 'POST',
    data,
  });
}

export function returnPersonal(rentId) {
  return request({
    url: `/rent/personal/${rentId}/return`,
    method: 'PUT'
  })
}

export function lostPersonal(rentId) {
  return request({
    url: `/rent/personal/${rentId}/lost`,
    method: 'PUT'
  })
}

export function returnGroup(rentId) {
  return request({
    url: `/rent/group/${rentId}/return`,
    method: 'PUT'
  })
}

export function lostGroup(rentId) {
  return request({
    url: `/rent/group/${rentId}/lost`,
    method: 'PUT'
  })
}

export function expire(type) {
  return request({
    url: `/rent/${type}/expired`,
    method: 'PUT'
  })
}