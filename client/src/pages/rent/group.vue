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
    :columns="columns" :tableData="tableData" title navbar="搜寻学号或名字" >
      <template slot="title">租借记录（团体）</template>

      <template slot="student" slot-scope="{ data }">
        <div v-if="data.student || data.student_id">
          <div class="student" v-if="data.student_id">{{ data.student_id }}</div>
          <div class="name" v-if="data.student">{{ data.student.name }}</div>
        </div>
        <div v-else>▬ ▬</div>
      </template>

      <template slot="item_type" slot-scope="{ data }">
        {{ data.item_type }}--{{ data.item_tag }}（{{ data.amount }}个）
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
        <div>
          <span v-if="data.status == 0" class="label label-success">已归还</span>
          <span v-if="data.status == 1" class="label label-primary">未归还</span> 
          <span v-if="data.status == 2" class="label label-expired">已逾期</span>
          <span v-if="data.status == 3 || data.status == 5" class="label label-success">已罚款</span> 
          <span v-if="data.status == 4 || data.status == 5" class="label label-success">已赔偿</span>
          <!-- <div v-if="data.status == 5" class="label1">
            <span class="label label-success" style="margin-bottom:.2rem">已罚款</span>
            <span class="label label-success">已赔偿</span>
          </div> -->
          <span v-if="data.status == 6 || data.status == 8" class="label label-warning">未罚款</span>
          <span v-if="data.status == 7 || data.status == 8" class="label label-warning">未赔偿</span>
          <!-- <div v-if="data.status == 8" class="label2">
            <span class="label label-warning" style="margin-bottom:.2rem">未罚款</span>
            <span class="label label-warning">未赔偿</span>
          </div> -->
        </div>
      </template>

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
        <div v-if="data.status == 3 || data.status == 4 || data.status == 5">
          <div class="action" @click="showReceipt(data.id)">显示收据</div> 
        </div>
        <div v-else>
          <div class="action" @click="cancelRent(data.id)">取消</div>
          <div v-if="data.status == 6" class="action" @click="payRent(data.id)">索取罚款</div>
          <div v-if="data.status == 7" class="action" @click="payRent(data.id)">索取赔偿</div>
          <div v-if="data.status == 8" class="action" @click="payRent(data.id)">索取罚款&amp;赔偿</div>
          <div class="action" @click="showReceipt(data.id)">显示收据</div>
        </div>
      </template>

      <template slot="delete" slot-scope="{ data }"> 
        <i class="icon icon-trash-2" @click="openModal(data.id)"></i>
      </template>

    </gpTable>

    <modal ref="submitLose" title="损失数量">
      <div slot="body">
        <div class="form-group">
          <input name="损失数量" id="amount" type="text" class="form-input" :class="{'error-input': errors.first('损失数量')}"
          placeholder="请输入物品损失数量" v-model="lostAmount" v-validate="'required|numeric'"
          @keyup.enter="submitLose">
          <p class="form-input-hint text-error">{{ errors.first('损失数量') }}</p>
        </div>
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
import { getGroupRent, returnGroup, expire, deleteGroupRent, payGroupRent, cancelGroupRent} from '@/api/rental';
import { getGroupReceipt } from '@/api/receipt' ;
import { group_column } from '@/api/tableColumns';

import gpTable from '@/components/tables';
import receipt from '@/components/receipt';
import cmodal from '@/components/confirm-modal';
import modal   from '@/components/modal';

export default {
  components: {
    gpTable,
    receipt,
    cmodal,
    modal,
  },
  data: () => ({
    columns: group_column,
    tableData: [],
    receiptData: {},
    lostAmount: null,
    lostId: null,
    deleteId: '',
  }),
  mounted() {
    this.getAll();
  },
  methods: {
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
      return `${time}${times[0]}：${times[1]}`;
    },
    getAll() {
      expire('group').then(() => {
        getGroupRent().then(({ data }) => {
          this.tableData = data;
          for (let i = 0; i < data.length; i++) {
            this.tableData[i].item_type = data[i].item.type;
          }          
          this.$refs.table.is_loading = false;
        }).catch((err) => {
          console.log(err);
        })
      })
    },
    loseItem(id) {
      this.lostAmount = null;
      this.$refs.submitLose.active = true;
      this.lostId = id;
    },
    showReceipt(id) {
      getGroupReceipt(id).then(({ data }) => {
        this.receiptData = data;
        this.receiptData.rent = data.grouprent;
        console.log(this.receiptData);
        this.$refs.receipt.active = true;
      })
    },
    returnItem(id) {
      returnGroup(id, 0).then(() => {
        this.notification('成功更新物品状态：归还', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err)
      })
    },
    submitLose() {
      returnGroup(this.lostId, this.lostAmount).then((msg) => {
        this.$refs.submitLose.active = false;
        this.notification('成功更新物品状态：遗失', 'success');
        this.getAll();
      })  
    },
    openModal(id) {
      this.deleteId = id;
      this.$refs.cancel.active = true;
    },
    removeRent(){
      deleteGroupRent(this.deleteId).then((msg) => {
        this.$refs.cancel.active = false;
        this.notification('成功删除租借记录', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    },
    payRent(id) {
      payGroupRent(id).then(() => {
        this.notification('付费成功', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    },
    cancelRent(id) {
      cancelGroupRent(id).then(() => {
        this.notification('成功取消状态', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    }
  }
};
</script>

<style>

</style>
