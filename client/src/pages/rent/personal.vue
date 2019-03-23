<template>
  <div id="_personal">
    <div class="btn btn-lg btn-primary"
    @click="$router.push({
      'name': 'addNew',
      'params': {
        'state': 'personal'
      }
    })">新增</div>

    <!-- <fine ref="add"></fine>
    <comp ref="add2"></comp> -->

    <cp-table width="100" class="mt-2" ref="table"
    :columns="personal_columns" :tableData="tableData" title navbar="搜寻学号或名字">
      <template slot="title">租借记录（个人）</template>

      <template slot="item_type" slot-scope="{ data }">
        {{data.item_type}} -- {{data.item_tag}}
      </template>

      <template slot="item_out" slot-scope="{ data }">
        <div class="date">{{toDate(data.item_out)}}</div>
        <div class="time">{{toTime(data.item_out)}}</div>
      </template>

      <template slot="item_in" slot-scope="{ data }">
        <div v-if="data.item_in">
          <div class="date">{{toDate(data.item_in)}}</div>
          <div class="time">{{toTime(data.item_in)}}</div>
        </div>
        <div v-else>
          <div class="expired">逾期时间：</div>
          <div class="date">{{toDate(data.due_date)}}</div>
          <div class="time">{{toTime(data.due_date)}}</div>
        </div>
      </template>

      <template slot="status" slot-scope="{ data }">
        <span v-if="data.status == 0" class="label label-success">已归还</span>
        <div v-if="data.status == 1">
          <span class="label label-primary">未归还</span> 
          <div class="action return" @click="returnItem(data.id)">归还物品</div>
          <div class="action loss" @click="loseItem(data.id)">遗失物品</div>
        </div>
        <div v-if="data.status == 2">
          <span class="label label-expired">已逾期</span>
          <div class="action return" @click="returnItem(data.id)">归还物品</div>
          <div class="action loss" @click="loseItem(data.id)">遗失物品</div>
        </div>
        <div v-if="data.status == 3">
          <span class="label label-error">已归还</span> 
          <div class="action" @click="showReceipt(data.id)">索取赔偿</div>
        </div>
      </template>
    </cp-table>

    <modal ref="submitLose" title="损失数量">
      <div slot="body">
        <div class="form-group">
          <input name="amount" id="amount" type="number" class="form-input" 
          placeholder="请输入物品损失数量" v-model="lostAmount">
        </div>
      </div>
      <div slot="footer">
        <div class="btn btn-primary submitLoseBtn" @click="submitLose">确认</div>
      </div>
    </modal>
  </div>
</template>

<script>
import { getPersonalRent, returnPersonal, expire } from '@/api/rental';
import { getPersonalReceipt, postPersonalReceipt } from '@/api/receipt';
import { personal_column } from '@/api/tableColumns';

import fine    from '@/components/receipt/fine';
import comp    from '@/components/receipt/comp';
import cpTable from '@/components/tables';
import modal   from '@/components/modal';

export default {
  components: {
    cpTable,
    fine,
    comp,
    modal,
  },
  data: () => ({
    personal_columns: personal_column,
    receipt_data: {},
    tableData: [],
    lostAmount: null,
    lostId: null,
  }),
  mounted() {
    this.getAll();
  },
  methods: {
    getAll() {
      expire('personal').then(() => {
        getPersonalRent().then(({ data }) => {
<<<<<<< HEAD
          this.tableData = data;
          for (let i = 0; i < data.length; i++) {
            this.tableData[i].item_type = data[i].item.type;
=======
          this.data = data;
          for (let i = 0; i < data.length; i++) {
            this.data[i].item_type = data[i].item.type;
>>>>>>> c7de4366bfb16d10917c3ad1a8bb44ec9dfbe998
          }
          this.$refs.table.is_loading = false;
        }).catch((err) => {
          console.log(err);
        });
<<<<<<< HEAD
=======
      });
      getPersonalReceipt().then(({ data }) => {
        this.fineData = data;
      }).catch((err) => {
        console.log(err);
>>>>>>> c7de4366bfb16d10917c3ad1a8bb44ec9dfbe998
      });
    },
    toDate(date) {
      return `${date.split(' ')[0].split('-')[0]} 年 ${parseInt(date.split(' ')[0].split('-')[1])} 月 ${parseInt(date.split(' ')[0].split('-')[2])} 日`;
    },
    toTime(date) {
      const times = date.split(' ')[1].split(':');
      let time = times[0] == 12 ? '中午' : '上午';
      if (times[0] > 12) {
        time = '下午';
        times[0] -= 12;
      }
      return `${time}${parseInt(times[0])}：${times[1]}`;
    },
    returnItem(id) {
<<<<<<< HEAD
      returnPersonal(id, 0).then(() => {
=======
      returnPersonal(id).then((msg) => {
        console.log(msg);
>>>>>>> c7de4366bfb16d10917c3ad1a8bb44ec9dfbe998
        this.notification('成功更新物品状态：归还', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err)
      })
    },
    showReceipt(id) {
      getPersonalReceipt(id).then(({ data }) => {
        if (data.length == 0) {
          postPersonalReceipt(id).then(() => {
            getPersonalReceipt(id).then(({ inner_data }) => console.log(inner_data));
          });
        } else this.receipt_data = data;
      })
    },
    loseItem(id) {
      this.$refs.submitLose.active = true;
      this.lostId = id;
    },
    submitLose() {
      returnPersonal(this.lostId, this.lostAmount).then((msg) => {
        this.$refs.submitLose.active = false;
        postPersonalReceipt(this.lostId);
        this.notification('成功更新物品状态：遗失', 'success');
        this.getAll();
      })  
    }
  },
};
</script>

<style>

</style>
