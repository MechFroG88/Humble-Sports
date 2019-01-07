<template>
  <div id="_management">
    <mg-table width="100%" :columns="columns" :data="data" title>
      <div slot="record">
        icon
      </div>
      <div slot="title">
        器材管理
      </div>
    </mg-table>
  </div>
</template>

<script>
import mgTable from '@/components/tables'
import { management } from '@/api/tableColumns'
export default {
  components:{
    mgTable
  },
  data:()=>({
    columns: management,
    data:[
      {
        name:'篮球',
        serialnumber:'1-12',
      },
      {
        name:'足球',
        serialnumber:'1-12',
      },
      {
        name:'排球',
        serialnumber:'1-12',
      }

      ]
  })
}
</script>

<style>

</style>
