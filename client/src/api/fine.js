import request from '@/api/request';

export function getFine() {
  return request({
    url: '/fine',
    method: 'GET',
  });
}

export function postFine(data) {
  return request({
    url: '/fine/new',
    method: 'POST',
    data
  });
}