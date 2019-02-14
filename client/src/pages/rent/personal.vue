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

      <template slot="student" slot-scope="{ data }">
        <img :src="data.student.image" alt="Student image">
        <div class="student_data">
          <div class="cn_name">{{data.student.cn_name}}</div>
          <div class="id">{{data.student.id}}</div>
          <div class="class_name">{{data.student.class}}</div>
        </div>
      </template>

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
// import { personal } from '@/api/mock/rental'
export default {
  components: {
    cpTable,
    cmodal
  },
  data: () => ({
    columns: personal_column,
    data: []
  }),
  mounted() {
    getPersonalRent().then(({data}) => {
      this.data = data;
      for (let i = 0; i < this.data.length; i++) {
        this.data[i].item_type = this.data[i].item.type
      }
      this.$refs.table.isLoading = false
      console.log(this.data)
    }).catch((err) => {
      console.log(err)
    })
  }
}
</script>

<style>

</style>
