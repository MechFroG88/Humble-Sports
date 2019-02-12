<template>
  <div id="_personal">
    <div class="btn btn-lg btn-primary" 
    @click="$router.push({
      'name': 'addNew',
      'params': {
      'state': 'personal'
      }
    })">新增</div>
    <cp-table width="100" class="mt-2" ref="table"
    :columns="columns" :tableData="data" title navbar="搜寻学号或名字">
      <template slot="title">租借记录（个人）</template>
      <template slot="status" slot-scope="{ data }">
          <span v-if="data.status == 0" class="label label-success">已归还</span>
          <span v-if="data.status == 1" class="label label-primary">未归还</span>
          <span v-if="data.status == 2" class="label label-expired">已逾期</span>
          <span v-if="data.status == 3" class="label label-error">已丢失</span>
      </template>
    </cp-table>
  </div>
</template>

<script>
import { getPersonalRent } from '@/api/rental'

import cpTable from '@/components/tables'
import cmodal from '@/components/confirm-modal'
import { personal_column } from '@/api/tableColumns'
import { personal } from '@/api/mock/rental'
export default {
  components: {
    cpTable,
    cmodal
  },
  data: () => ({
    columns: personal_column,
    data: personal
  }),
  mounted() {
    getPersonalRent().then((data) => {
      console.log(data)
    }).catch((err) => {
      console.log(err)
    })
  }
}
</script>

<style>

</style>
