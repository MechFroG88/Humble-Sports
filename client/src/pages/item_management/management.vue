<template>
  <div id="_management">
    <div class="btn btn-lg btn-primary addBtn"
    style="margin-bottom: 3.8rem;"
    @click="$refs.add.active = true">新增</div>
    <mg-table width="40" ref="table"
    :columns="columns" :tableData="data" title>
      <template slot="title">器材管理</template>
      <template slot="serialNumber" slot-scope="{ data }">
        {{data.start}} - {{data.end}}
      </template>

      <template slot="record">
        <i class="icon icon-external-link c-hand" @click="$router.push({
            'name':'management_details'
          })" ></i>
      </template>
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
              <input class="form-input input-sm" type="text" id="type" 
              v-model="item.type">
            </div>
          </div>
          <div class="form-group serial">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="serial">编号：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm mr-2" type="number" id="serial"
              v-model="item.start_id">
              至
              <input class="form-input input-sm ml-2" type="number" id="serial"
              v-model="item.end_id">
            </div>
          </div>
          <div class="form-group price">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="price">价钱：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm" type="number" id="price"
              v-model="item.price">
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
import { getItem, postItem } from '@/api/item';

import mgTable from '@/components/tables';
import cpModal from '@/components/modal';
import { management_column } from '@/api/tableColumns';

export default {
  components: {
    mgTable,
    cpModal,
  },
  mounted() {
    getItem().then(({data}) => {
      this.data = data;
      this.$refs.table.isLoading = false;
    })
  },
  data: () => ({
    columns: management_column,
    data: [],
    item: {
      type: '',
      start_id: '',
      end_id: '',
      price: ''
    }
    // data: [
    //   {
    //     name: '篮球',
    //     serialnumber: '1-12',
    //     price: '16.00',
    //   },
    //   {
    //     name: '足球',
    //     price: '18.00',
    //     serialnumber: '1-12',
    //   },
    //   {
    //     name: '排球',
    //     serialnumber: '1-12',
    //     price: '12.00',
    //   },
    // ],
  }),
  methods: {
    add() {
      this.item.price    = parseInt(this.item.price);
      this.item.end_id   = parseInt(this.item.end_id);
      this.item.start_id = parseInt(this.item.start_id);

      postItem(this.item).then((msg) => {
        console.log(msg);
        this.$refs.add.active = false;
      }).catch((err) => {
        console.log(this.item)
        console.log(err);
      })
    },
  },
};
</script>

<style>

</style>
