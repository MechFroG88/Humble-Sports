import request from '@/api/request';

// Personal
export function getPersonalReceipt(receiptId) {
  return request({
    url: `/receipt/personal/${receiptId}`,
    method: 'GET'
  });
}



// Group
export function getGroupReceipt(receiptId) {
  return request({
    url: `/receipt/group/${receiptId}`,
    method: 'GET'
  });
}

