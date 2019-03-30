<template>
  <div id="_personal">
    <div class="btn btn-lg btn-primary addBtn"
    @click="$router.push({
      'name': 'addNew',
      'params': {
        'state': 'personal'
      }
    })">新增</div>

    <cp-table width="100" class="mt-2" ref="table"
    :columns="personal_columns" :tableData="tableData" title navbar="搜寻学号或名字">
      <template slot="title">租借记录（个人）</template>

      <!-- <template slot="student" slot-scope="{ tableData }">
        <div class="student_data">
          <div class="cn_name">{{tableData.student_id}}</div>
        </div>
      </template> -->

      <template slot="item_type" slot-scope="{ data }">
        {{ data.item_type }} -- {{ data.item_tag }}
      </template>

      <template slot="item_out" slot-scope="{ data }">
        <div class="date">{{ toDate(data.item_out) }}</div>
        <div class="time">{{ toTime(data.item_out) }}</div>
      </template>

      <template slot="item_in" slot-scope="{ data }">
        <div v-if="data.item_in">
          <div class="date">{{ toDate(data.item_in) }}</div>
          <div class="time">{{ toTime(data.item_in) }}</div>
        </div>
        <div v-else>
          <div class="expired">逾期时间：</div>
          <div class="date">{{ toDate(data.due_date) }}</div>
          <div class="time">{{ toTime(data.due_date) }}</div>
        </div>
      </template>

      <template slot="status" slot-scope="{ data }">
        <span v-if="data.status == 0" class="label label-success">已归还</span>
        <div v-if="data.status == 1">
          <span class="label label-primary">未归还</span> 
        </div>
        <div v-if="data.status == 2">
          <span class="label label-expired">已逾期</span>
        </div>
        <div v-if="data.status == 3">
          <span class="label label-success">已罚款</span> 
        </div>
        <div v-if="data.status == 4">
          <span class="label label-success">已赔偿</span>
        </div>
        <div v-if="data.status == 6">
          <span class="label label-warning">未罚款</span>
        </div>
        <div v-if="data.status == 7">
          <span class="label label-warning">未赔偿</span>
        </div>
      </template>

      <!-- <template slot="action" slot-scope="{ data }" >
        <div class="btn btn-primary deleteBtn" @click="openModal(data.id)">删除</div>
      </template> -->

      <template slot="action" slot-scope="{ data }">
        <div v-if="data.status == 0" class="line">▬ ▬</div>
  
        <div v-if="data.status == 1">
          <div class="action return" @click="returnItem(data.id)">归还物品</div>
          <div class="action loss" @click="loseItem(data.id)">遗失物品</div>
        </div>
        <div v-if="data.status == 2">
          <div class="action fine" @click="returnItem(data.id)">归还物品</div>
          <div class="action loss" @click="loseItem(data.id)">遗失物品</div>
        </div>
        <div v-if="data.status == 3">
          <div class="action" @click="showReceipt(data.id)">显示收据</div> 
        </div>
        <div v-if="data.status == 4">
          <div class="action" @click="showReceipt(data.id)">显示收据</div>
        </div>
        <div v-if="data.status == 6">
          <div class="action" @click="cancelRent(data.id)">取消</div>
          <div class="action" @click="payRent(data.id)">索取罚款</div>
          <div class="action" @click="showReceipt(data.id)">显示收据</div>
          
        </div>
        <div v-if="data.status == 7">
          <div class="action" @click="cancelRent(data.id)">取消</div>
          <div class="action" @click="payRent(data.id)">索取赔偿</div>
          <div class="action" @click="showReceipt(data.id)">显示收据</div>
          
        </div>
      </template>
<!-- <div class="btn btn-primary deleteBtn" @click="openModal(data.id)">删除</div> -->
      <template slot="delete" slot-scope="{ data }"> 
        <i class="icon icon-trash" @click="openModal(data.id)"></i>
      </template>
    </cp-table>

    <modal ref="submitLose" title="损失数量">
      <div slot="body">
        <!-- <div class="form-group">
          <input name="amount" id="amount" type="number" class="form-input" 
          placeholder="请输入物品损失数量" v-model="lostAmount">
        </div> -->
        确定遗失物品？
      </div>
      <div slot="footer">
        <div class="btn btn-primary submitLoseBtn" @click="submitLose">确认</div>
      </div>
    </modal>

    <cmodal class="confirmModal" ref="cancel" :trigger="removeRent"></cmodal>

    <receipt ref="receipt" :data="receiptData"></receipt>
  </div>
</template>

<script>
import { getPersonalRent, returnPersonal, expire, deletePersonalRent, payPersonalRent, cancelPersonalRent} from '@/api/rental';
import { getPersonalReceipt } from '@/api/receipt';
import { personal_column } from '@/api/tableColumns';

import cpTable from '@/components/tables';
import receipt from '@/components/receipt';
import cmodal from '@/components/confirm-modal';
import modal   from '@/components/modal';

export default {
  components: {
    cpTable,
    receipt,
    cmodal,
    modal,
  },
  data: () => ({
    personal_columns: personal_column,
    tableData:[],
    receiptData: {},
    lostId: null,
    deleteId: '',
  }),
  mounted() {
    this.getAll();
  },
  methods: {
    getAll() {
      expire('personal').then(() => {
        getPersonalRent().then(({ data }) => {
          this.tableData = data;
          for (let i = 0; i < data.length; i++) {
            this.tableData[i].item_type = data[i].item.type;
          }
          this.$refs.table.is_loading = false;
        }).catch((err) => {
          console.log(err);
        });
      });
    },
    toDate(date) {
      return `
        ${date.split(' ')[0].split('-')[0]} 年 
        ${parseInt(date.split(' ')[0].split('-')[1])} 月 
        ${parseInt(date.split(' ')[0].split('-')[2])} 日
      `;
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
      returnPersonal(id, 0).then(() => {
        this.notification('成功更新物品状态：归还', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err)
      })
    },
    showReceipt(id) {
      getPersonalReceipt(id).then(({ data }) => {
        this.receiptData = data;
        this.receiptData.rent = data.personalrent;
        this.$refs.receipt.active = true;
      })
    },
    submitLose() {
      returnPersonal(this.lostId, 1).then((msg) => {
        this.$refs.submitLose.active = false;
        this.notification('成功更新物品状态：遗失', 'success');
        this.getAll();
      })  
    },
    loseItem(id) {
      this.$refs.submitLose.active = true;
      this.lostId = id;
    },
    openModal(id) {
      this.deleteId = id;
      this.$refs.cancel.active = true;
    },
    removeRent() {
      deletePersonalRent(this.deleteId).then((msg) => {
        this.$refs.cancel.active = false;
        this.notification('成功删除租借记录', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    },
    payRent(id) {
      payPersonalRent(id).then(() => {
        this.notification('付费成功', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    },
    cancelRent(id) {
      cancelPersonalRent(id).then(() => {
        this.notification('成功取消状态', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    }
  },
};
</script>

<style>

</style>
