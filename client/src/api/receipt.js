import request from '@/api/request';

// Personal
export function getPersonalReceipt(receiptId) {
  return request({
    url: `/receipt/personal/${receiptId}`,
    method: 'GET'
  });
}

export function postPersonalReceipt(receiptId) {
  return request({
    url: `/receipt/personal/${receiptId}`,
    method: 'POST'
  })
}

// Group
export function getGroupReceipt(receiptId) {
  return request({
    url: `/receipt/group/${receiptId}`,
    method: 'GET'
  });
}

export function postGroupReceipt(receiptId) {
  return request({
    url: `/receipt/group/${receiptId}`,
    method: 'POST'
  })
}