<template>
  <div id="_group">
    <div class="btn btn-lg btn-primary"
    @click="$router.push({
      'name': 'addNew',
      'params': {
        'state': 'group'
      }
    })">新增</div>
    <gpTable class="mt-2" width="100" ref="table"
    :columns="columns" :tableData="data" title navbar="搜寻学号或名字" >
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
import { getGroupRent } from '@/api/rental';

import gpTable from '@/components/tables';
import { group_column } from '@/api/tableColumns';

export default {
  components: {
    gpTable,
  },
  data: () => ({
    columns: group_column,
    data: [],
  }),
  mounted() {
    getGroupRent().then(({ data }) => {
      this.data = data;
      this.$refs.table.isLoading = false;
    }).catch((err) => {
      console.log(err);
    })
  }
};
</script>

<style>

</style>
