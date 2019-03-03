import request from '@/api/request';

// Personal
export function getPersonalReceipt(receiptId) {
  return request({
    url: `/receipt/personal/${receiptId}`,
    method: 'GET'
  });
}

export function postPersonalReceiptFine(rentId) {
  return request({
    url: `/receipt/personal/fine/${rentId}`,
    method: 'POST',
  });
}

export function postPersonalReceiptLost(rentId) {
  return request({
    url: `/receipt/personal/lost/${rentId}`,
    method: 'POST',
  });
}

// Group
export function getGroupReceipt(receiptId) {
  return request({
    url: `/receipt/group/${receiptId}`,
    method: 'GET'
  });
}

export function postGroupReceiptFine(rentId) {
  return request({
    url: `/receipt/group/fine/${rentId}`,
    method: 'POST',
  });
}

export function postGroupReceiptLost(rentId) {
  return request({
    url: `/receipt/group/lost/${rentId}`,
    method: 'POST',
  });
}