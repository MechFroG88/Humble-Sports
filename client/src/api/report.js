import request from '@/api/request';

export function getReport() {
  return request({
    url: '/report/stats',
    method: 'GET'
  });
}

export function getReportGraph(year) {
  return request({
    url: `/report/${year}`,
    method: 'GET'
  })
}