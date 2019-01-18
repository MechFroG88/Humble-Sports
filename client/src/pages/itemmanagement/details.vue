<template>
  <div id="_details">
    <dtTable width="100%" :columns="columns" :data="data" title>
      <div slot="status">
        label
      </div>
      <div slot="title">
        篮球租借记录
      </div>
    </dtTable>
  </div>
</template>

<script>
import dtTable from '@/components/tables'
import { details } from '@/api/tableColumns'
export default {
  components:{
    dtTable,
  },
  data:()=>({
    columns: details,
    data:[
      {
        serialnumber:'1',
        name:'陈智霖',
        rent_time:'2018 年 7 月 19 日',
        return_time:'2018 年 7 月 19 日',
        teacher:'陈晓明老师',
      },
      {
        serialnumber:'2',
        name:'蔡小轩',
        rent_time:'2018 年 7 月 19 日',
        return_time:'2018 年 7 月 19 日',
        teacher:'陈小花老师',
      },

    ]

  })

}
</script>

<style>

</style>
