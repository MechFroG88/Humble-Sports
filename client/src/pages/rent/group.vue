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
    :columns="columns" :tableData="data" title navbar="搜寻学号或名字" >
      <template slot="title">租借记录:(团体)</template>

      <template slot="student" slot-scope="{ data }">
        <div v-if="data.student || data.student_id">
          <div class="student" v-if="data.student_id">{{ data.student_id }}</div>
          <div class="name" v-if="data.student">{{ data.student.name }}</div>
        </div>
        <div v-else>▬ ▬</div>
      </template>

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
          <div class="action return" @click="returnItem(data.id)">归还物品</div>
          <!-- <div class="action loss" @click="loseItem(data.id)">遗失物品</div> -->
        </div>
        <div v-if="data.status == 2">
          <span class="label label-expired">已逾期</span>
          <div class="action return" @click="returnItem(data.id)">归还物品</div>
          <!-- <div class="action loss" @click="loseItem(data.id)">遗失物品</div> -->
        </div>
        <div v-if="data.status == 3">
          <span class="label label-error">已归还</span> 
          <!-- <div class="action" @click="showReceipt(data.id)">索取赔偿</div> -->
        </div>
      </template>
    </gpTable>
  </div>
</template>

<script>
import { getGroupRent, returnGroup, expire } from '@/api/rental';

import gpTable from '@/components/tables';
import { group_column } from '@/api/tableColumns';

export default {
  components: {
    gpTable,
  },
  data: () => ({
    columns: group_column,
    data: [],
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
          this.data = data;
          for (let i = 0; i < data.length; i++) {
            this.data[i].item_type = data[i].item.type;
          }
          this.$refs.table.is_loading = false;
        }).catch((err) => {
          console.log(err);
        })
      })
    },
    returnItem(id) {
      returnGroup(id, 0).then(() => {
        this.notification('成功归还物品！', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err)
      })
    },
    loseItem(id) {
      
    }
  }
};
</script>

<style>

</style>
