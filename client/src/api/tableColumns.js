export const personal_column = [
  { name: '学生资料', field: 'student', search: true },
  { name: '借用器材', field: 'item_type' },
  { name: '借出时间', field: 'item_out' },
  { name: '归还时间', field: 'item_in' },
  { name: '负责老师', field: 'teacher' },
  { name: '状态', field: 'status' },
];

export const group_column = [
  { name: '团体名称', field: 'group_name', search: true },
  { name: '负责人', field: 'student' },
  { name: '借用器材', field: 'item_type' },
  { name: '借出时间', field: 'item_out' },
  { name: '归还时间', field: 'item_in' },
  { name: '负责老师', field: 'teacher' },
  { name: '状态', field: 'status' },
];

export const management_column = [
  { name: '器材名称', field: 'type' },
  { name: '编号', field: 'serialNumber' },
  { name: '价格', field: 'price' },
  { name: '记录', field: 'record' },
];

export const details_column = [
  { name: '编号', field: 'id' },
  { name: '学生/团体', field: 'individual' },
  { name: '借出时间', field: 'item_out' },
  { name: '归还时间', field: 'item_in' },
  { name: '负责老师', field: 'teacher' },
  { name: '状态', field: 'status' },
];

export const users_column = [
  { name: '名字', field: 'cn_name' },
  { name: '权限', field: 'type' },
  { name: '操作', field: 'action' },
];

export const comp_column = [
  { name: '种类', field: 'type' },
  { name: '编号', field: 'serialnumber' },
  { name: '单价', field: 'price' },
  { name: '共丢失', field: 'lost'},
  { name: '总价' , field: 'totalPrice'}
];
