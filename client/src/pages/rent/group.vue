<template>
  <div id="_group">
    <div class="btn btn-lg btn-primary" 
    @click="$router.push({
      'name': 'addNew',
      'params': {
        'state': 'group'
      }
    })">新增</div>
    <gpTable class="mt-2" width="100" 
    :columns="columns" :tableData="data" title navbar="搜寻学号或名字">
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
import { group_column } from '@/api/tableColumns'
export default {
  components:{
    gpTable
  },
  data:()=>({
    columns: group_column,
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
    {
        groupname:'足球学会',
        info:'Fat Tan',
        item:'足球',
        rent_time:'2018 年 7 月 19 日',
        return_time:'2018 年 7 月 19 日',
        number:'10',
        teacher:'董顺忠老师',
    }
      
    ]


  })
}
</script>

<style>

</style>
