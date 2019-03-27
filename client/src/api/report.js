import request from '@/api/request';

export function getReport() {
  return request({
    url: '/report',
    method: 'GET'
  });
}

export function getReportGraph() {
  return request({
    url: '/report/month',
    method: 'GET'
  })
}