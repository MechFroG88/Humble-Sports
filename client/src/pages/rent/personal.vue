<template>
  <div id="_personal">
    <div class="btn btn-lg btn-primary"
    @click="$router.push({
      'name': 'addNew',
      'params': {
        'state': 'personal'
      }
    })">新增</div>
    <cp-table width="100" class="mt-2" ref="table"
    :columns="columns" :tableData="data" title navbar="搜寻学号或名字">
      <template slot="title">租借记录（个人）</template>

      <template slot="student" slot-scope="{ data }">
        <img :src="data.student.image" alt="Student image">
        <div class="student_data">
          <div class="cn_name">{{data.student.cn_name}}</div>
          <div class="id">{{data.student.id}}</div>
          <div class="class_name">{{data.student.class}}</div>
        </div>
      </template>

      <template slot="item_out" slot-scope="{ data }">
        <div class="date">{{toDate(data.item_out)}}</div>
        <div class="time">{{toTime(data.item_out)}}</div>
      </template>

      <template slot="item_in" slot-scope="{ data }">
        <div class="date">{{toDate(data.item_in)}}</div>
        <div class="time">{{toTime(data.item_in)}}</div>
      </template>

      <template slot="status" slot-scope="{ data }">
        <span v-if="data.status == 0" class="label label-success">已归还</span>
        <span v-if="data.status == 1" class="label label-primary">未归还</span>
        <span v-if="data.status == 2" class="label label-expired">
          已逾期 <div class="fine"><a href="">进行罚款</a></div>
        </span>
        <span v-if="data.status == 3" class="label label-error">
          已丢失 <div class="fine"><a href="">索取赔偿</a></div>
        </span>
      </template>
    </cp-table>
  </div>
</template>

<script>
import { getPersonalRent } from '@/api/rental';

import cpTable from '@/components/tables';
import { personal_column } from '@/api/tableColumns';
// import { personal } from '@/api/mock/rental'
export default {
  components: {
    cpTable,
  },
  data: () => ({
    columns: personal_column,
    data: [],
  }),
  mounted() {
    getPersonalRent().then(({ data }) => {
      this.data = data;
      for (let i = 0; i < this.data.length; i++) {
        this.data[i].item_type = this.data[i].item.type;
        this.data[i].item_in_date = `${this.data[i].item_in.split(' ')[0].split('-')[0]}年${this.data[i].item_in.split(' ')[0].split('-')[1]}月${this.data[i].item_in.split(' ')[0].split('-')[2]}日`;
      }
      this.$refs.table.isLoading = false;
    }).catch((err) => {
      console.log(err);
    });
  },
  methods: {
    toDate(date) {
      return `${date.split(' ')[0].split('-')[0]} 年 ${parseInt(date.split(' ')[0].split('-')[1])} 月 ${parseInt(date.split(' ')[0].split('-')[2])} 日`;
    },
    toTime(date) {
      let time = '上午';
      const times = date.split(' ')[1].split(':');
      if (times[0] >= 12) {
        time = times[0] === 12 ? '中午' : '下午';
        times[0] -= 12;
      }
      return `${time}${times[0]}：${times[1]}`;
    },
  },
};
</script>

<style>

</style>
