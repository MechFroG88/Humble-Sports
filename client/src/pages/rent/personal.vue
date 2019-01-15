<template>
  <div id="_personal">
    <div class="btn btn-lg btn-primary mb-2" 
    @click="$router.push({
      'name': 'addNew',
      'params': {
      'state': 'personal'
      }
    })">新增</div>
    <cp-table width="100" class="mt-2"
    :columns="columns" :data="data" title navbar="搜寻学号或名字">
      <template slot="title">
        aslkdjhasld
      </template>
      <div slot="status">
        label
      </div>
    </cp-table>
  </div>
</template>

<script>
import cpTable from '@/components/tables'
import cmodal from '@/components/confirm-modal'
import { personal } from '@/api/tableColumns'
export default {
  components: {
    cpTable,
    cmodal
  },
  data: () => ({
    columns: personal,
    data: [
      {
        item: 'b',
        rent_time: 'c',
        return_time: 'd',
        teacher: 'e',
        info: ''
      },
      {
        item: '2',
        rent_time: '3',
        return_time: '4',
        teacher: '5'
      }
    ]
  })
}
</script>

<style>

</style>
