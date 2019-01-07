<template>
  <div id="_management">
    <div class="btn btn-lg btn-primary" 
    @click="$refs.add.active = true">新增</div>
    <mg-table width="40%" :columns="columns" :data="data" title>
      <div slot="record">
        icon
      </div>
      <div slot="title">
        器材管理
      </div>
    </mg-table>
    <cpModal ref="add" title="新增器材" size="lg" closable>
      <div slot="body">
        <form class="form-horizontal">
          <div class="item h5 mt-2 mb-2">器材资料</div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="type">种类：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="type">
            </div>
          </div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="type">编号：</label>
            </div>
            <div class="col-10 col-sm-12" style="display: flex; align-items: center;">
              <input class="form-input mr-2" type="text" id="type">
              至
              <input class="form-input ml-2" type="text" id="type">
            </div>
          </div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="type">种类：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="type" placeholder="种类">
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
