import request from '@/api/request';

export function getReport() {
  return request({
    url: ' /report',
    method: 'GET'
  });
}