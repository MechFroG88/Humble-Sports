<template>
  <div id="_personal">
<<<<<<< HEAD
    <cp-table width="100%" :columns="columns" :data="data" title>
      <div slot="info">
        asdhasdhasdhasd
      </div>
=======
    <cp-table width="100%" :columns="columns" :data="data" 
    title navbar="搜寻学号或名字">
>>>>>>> d8950b18c58338e4ccc10b76315a6deb9c0df393
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
