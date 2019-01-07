<template>
  <div id="_management">
    <div class="btn btn-lg btn-primary" 
    @click="$refs.add.active = true">新增</div>
    <mg-table width="40%" :columns="columns" :data="data" title>
      <div slot="record">
        icon
      </div>
      <div slot="title">
        `器材管理`
      </div>
    </mg-table>
    <cpModal ref="add" title="新增器材" closable>
      <div slot="body">
        <form class="form-horizontal">
          <div class="form-group" v-if="$route.params.state === 'group'">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="group_name">名称：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="group_name" placeholder="名称">
            </div>
          </div>
        </form>
      </div>
    </cpModal>
  </div>
</template>

<script>
import mgTable from '@/components/tables'
import cpModal from '@/components/modal'
import { management } from '@/api/tableColumns'
export default {
  components:{
    mgTable,
    cpModal
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
