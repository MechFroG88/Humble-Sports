<template>
  <div id="_management">
    <div class="btn btn-lg btn-primary addBtn" 
    style="margin-bottom: 3.8rem;"
    @click="$refs.add.active = true">新增</div>
    <mg-table width="40" :columns="columns" :data="data" title>
      <div slot="record">
        <i class="icon icon-external-link c-hand" @click="$router.push({
            'name':'management_details'
          })" ></i> 
      </div>
      <div slot="title">
        器材管理
      </div>
    </mg-table>

    <div class="expired">
      <h5 style="font-weight: 400;">器材逾期</h5>
      <form class="form-horizontal">
        <div class="form-group">
          <div class="col-3 col-sm-12">
            <label class="form-label" for="price">罚款金额：</label>
          </div>
          <div class="col-9 col-sm-12">
            <input class="form-input mr-2" type="number" id="price">
            / 天
          </div>
        </div>
        <div class="btn btn-lg btn-primary" type="submit">储存</div>
      </form>
    </div>

    <cpModal ref="add" title="新增器材" closable>
      <div slot="body">
        <form class="form-horizontal">
          <div class="item h5 mb-2">器材资料</div>
          <div class="form-group type">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="type">种类：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm" type="text" id="type">
            </div>
          </div>
          <div class="form-group serial">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="serial">编号：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm mr-2" type="text" id="serial">
              至
              <input class="form-input input-sm ml-2" type="text" id="serial">
            </div>
          </div>
          <div class="form-group price">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="price">价钱：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm" type="number" id="price">
            </div>
          </div>
        </form>
      </div>
      <div slot="footer" class="btn btn-lg btn-primary"
      @click="add()">新增</div>
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
        price: '16.00'
      },
      {
        name:'足球',
        price: '18.00',
        serialnumber:'1-12',
      },
      {
        name:'排球',
        serialnumber:'1-12',
        price: '12.00'
      }
    ]
  }),
  methods: {
    add() {
      this.$refs.add.active = false
    }
  }
}
</script>

<style>

</style>
