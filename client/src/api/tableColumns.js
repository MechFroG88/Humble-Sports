export let personal = [
    { name: '学生资料', field: 'info'        },
    { name: '借用器材', field: 'item'        },
    { name: '借出时间', field: 'rent_time'   },
    { name: '归还时间', field: 'return_time' },
    { name: '负责老师', field: 'teacher'     },
    { name: '状态'   , field: 'status'      }
];

export let group = [
    { name: '团体名称' , field: 'groupname'},
    { name: '负责人'   , field: 'info'},
    { name: '借用器材' , field: 'item'},
    { name: '借出时间' , field: 'rent_time'},
    { name: '归还时间' , field: 'return_time'},
    { name: '数量'     , field: 'number'},
    { name: '负责老师' , field: 'teacher'},
    { name: '状态'     , field: 'status'}
]

export let management = [
    { name: '器材名称', field: 'name'         },
    { name: '编号'   , field: 'serialnumber' },
    { name: '价格'   , field: 'price'        },
    { name: '记录'   , field: 'record'       }
]

export let details = [
    { name: '编号'    , field: 'serialnumber'},
    { name: '学生/团体', field: 'name'        },
    { name: '借出时间' , field: 'rent_time'   },
    { name: '归还时间' , field: 'return_time' },
    { name: '负责老师' , field: 'teacher'     },
    { name: '状态'    , field: 'status'      }
]

export let users = [
    { name: '名字', field: 'name'      },
    { name: '权限', field: 'privilege' },
    { name: '操作', field: 'action'    }
]