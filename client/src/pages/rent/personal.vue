<template>
  <div id="_personal">
    <cp-table width="100%" :columns="columns" :data="data" title>
      <div slot="info">
        asdhasdhasdhasd
      </div>
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
  mounted() {
    console.log(this);
  },
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
