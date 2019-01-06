<template>
  <div id="_group">
    <gpTable width="100%" :columns="columns" :data="data" title>
      <div slot="status">
        label
      </div>
      <div slot="title">
        租借记录:(团体)
      </div>
    </gpTable>
  </div>
</template>

<script>
import gpTable from '@/components/tables'
import { group } from '@/api/tableColumns'
export default {
  components:{
    gpTable
  },
  data:()=>({
    columns: group,
    data:[
      {
        groupname:'篮球学会',
        info:'David Tan',
        item:'篮球',
        rent_time:'2018 年 7 月 19 日',
        return_time:'2018 年 7 月 19 日',
        number:'15',
        teacher:'董顺忠老师',
    },
      
    ]


  })
}
</script>

<style>

</style>
