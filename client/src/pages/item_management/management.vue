<template>
  <div id="_management">
    <div class="btn btn-lg btn-primary addBtn"
    style="margin-bottom: 3.8rem;"
    @click="$refs.add.active = true">新增</div>
    <mg-table width="40" ref="table"
    :columns="columns" :tableData="data" title>
      <template slot="title">器材管理</template>
      <template slot="serialNumber" slot-scope="{ data }">
        {{data.start_id}} - {{data.end_id}}
      </template>

      <template slot="price" slot-scope="{ data }">
        RM{{data.price}}
      </template>

      <template slot="record" slot-scope="{ data }">
        <i class="icon icon-external-link c-hand" @click="$router.push({
            'name':'management_details',
            'params': {
              'id': data.id
            }
          })" ></i>
      </template>
    </mg-table>

    <div class="expired">
      <h5 style="font-weight: 400;">器材逾期</h5>
      <form class="form-horizontal" @submit.prevent="changeFine()">
        <div class="form-group">
          <div class="col-3 col-sm-12">
            <label class="form-label" for="price">罚款金额：</label>
          </div>
          <div class="col-9 col-sm-12">
            <input class="form-input mr-2" type="number" id="price" v-model="fine_price">
            / 天
          </div>
        </div>
        <div class="btn btn-lg btn-primary" type="submit" @click="changeFine()">储存</div>
      </form>
    </div>

    <cpModal ref="add" title="新增器材" closable>
      <div slot="body">
        <div class="form-horizontal">
          <div class="item h5 mb-2">器材资料</div>
          <div class="form-group type">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="type">种类：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm" type="text" id="type" 
              v-model="item.type" @keyup.enter="add">
            </div>
          </div>
          <div class="form-group serial">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="serial">编号：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm mr-2" type="number" id="serial"
              v-model="item.start_id" @keyup.enter="add">
              至
              <input class="form-input input-sm ml-2" type="number" id="serial"
              v-model="item.end_id" @keyup.enter="add">
            </div>
          </div>
          <div class="form-group price">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="price">价钱：</label>
            </div>
            <div class="col-9 col-sm-12">
              <input class="form-input input-sm" type="number" id="price"
              v-model="item.price" @keyup.enter="add">
            </div>
          </div>
        </div>
      </div>
      <div slot="footer"
      class="btn btn-lg btn-primary" :class="{'loading': is_loading}"
      @click="add">新增</div>
    </cpModal>
  </div>
</template>

<script>
import { postFine } from '@/api/fine';
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
    getItem().then(({ data }) => {
      this.data = data;
      this.$refs.table.is_loading = false;
    }).catch((err) => {
      console.log(err);
    })
  },
  data: () => ({
    columns: management_column,
    data: [],
    fine_price: null,
    is_loading: false,
    add_loading: false,
    item: {
      type: '',
      start_id: '',
      end_id: '',
      price: ''
    }
  }),
  methods: {
    changeFine() {
      this.add_loading = true;
      let fine = this.fine_price.toFixed(2);
      postFine({ fine }).then((msg) => {
        this.notification(`成功更改罚款金额：RM${parseInt(this.fine_price).toFixed(2)}`, 'success');
        this.fine_price = null;
        this.add_loading = false;
      }).catch((err) => {
        this.notification('罚款金额更换失败！请重试！', 'error');
        this.add_loading = false;
        console.log(err)
      })
    },
    add() {
      this.is_loading = true;
      this.item.price = parseInt(this.item.price).toFixed(2);
      postItem(this.item).then((msg) => {
        this.is_loading = false;
        this.$refs.add.active = false;
        for (let i of Object.keys(this.item)) {
          this.item[i] = '';
        }
        this.$refs.table.is_loading = true;
        getItem().then(({ data }) => {
          this.data = data;
          this.$refs.table.is_loading = false;
        })
      }).catch((err) => {
        console.log(err);
        this.$refs.add.active = false;
      })
    },
  },
};
</script>

<style>

</style>
