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

// export function postLost(id, data) {
//   return request({
//     url: `/rent/${id}/lost`,
//     method: 'POST',
//     data,
//   });
// }
