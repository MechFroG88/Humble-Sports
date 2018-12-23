<template>
  <div id="_personal">
    <cp-table width="100%" :columns="columns" :data="data" title>
      <template slot="title">
        aslkdjhasld
      </template>
      <div slot="info">
        asdhasdhasdhasd
      </div>
    </cp-table>
  </div>
</template>

<script>
import cpTable from '@/components/tables'
export default {
  components: {
    cpTable
  },
  data: () => ({
    columns: [
      { name: '学生资料', field: 'info'        },
      { name: '借用器材', field: 'item'        },
      { name: '借出时间', field: 'rent_time'   },
      { name: '归还时间', field: 'return_time' },
      { name: '负责老师', field: 'teacher'     },
      { name: '状态'   , field: 'status'      }
    ],
    data: [
      {
        item: 'b',
        info: '',
        rent_time: 'c',
        return_time: 'd',
        teacher: 'e',
        status: 'f'
      },
      {
        item: '2',
        rent_time: '3',
        return_time: '4',
        teacher: '5',
        status: '6'
      }
    ]
  })
}
</script>

<style>

</style>
