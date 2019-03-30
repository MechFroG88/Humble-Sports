<template>
  <div id="_details">
    <div class="btn btn-lg btn-primary addBtn"
    style="margin-bottom: 3.8rem;"
    @click="$router.push('/management')">
      <i class="icon icon-chevron-left mr-1"></i>返回
    </div>
    <dtTable width="100%" ref="table"
    :columns="columns" :tableData="data" title>
      <template slot="title" v-if="item_type">{{item_type}}租借记录</template>

      <template slot="individual" slot-scope="{ data }">
        {{data.group_name || data.student_id}}
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
        <div v-else>▬ ▬</div>
      </template>

      <template slot="status" slot-scope="{ data }">
        <span v-if="data.status == 0" class="label label-success">已归还</span>
        <span v-if="data.status == 1" class="label label-primary">未归还</span>
        <span v-if="data.status == 2" class="label label-expired">已逾期</span>
        <span v-if="data.status == 3" class="label label-success">已罚款</span>
        <span v-if="data.status == 4" class="label label-success">已赔偿</span>
        <div v-if="data.status == 5" class="label1">
          <div class="label label-success" style="margin-bottom:.2rem">已罚款</div>
          <div class="label label-success">已赔偿</div>
        </div>
        <span v-if="data.status == 6" class="label label-warning">  未罚款</span>
        <span v-if="data.status == 7" class="label label-warning">  未赔偿</span>
        <div v-if="data.status == 8 " class="label2">
          <div class="label label-warning" style="margin-bottom:.2rem">未罚款</div>
          <div class="label label-warning">未赔偿</div>
        </div>
      </template>
    </dtTable>
  </div>
</template>

<script>
import { getItemRecord, getSingleItem } from '@/api/item';

import dtTable from '@/components/tables';
import { details_column } from '@/api/tableColumns';

export default {
  components: {
    dtTable,
  },
  mounted() {
    getSingleItem(this.$route.params.id).then(({ data }) => {
      this.item_type = data.type;
    })
    getItemRecord(this.$route.params.id).then(({ data }) => {
      this.data = data;
      this.$refs.table.is_loading = false;
    }).catch((err) => {
      console.log(err);
    })
  },
  data: () => ({
    columns: details_column,
    item_type: '',
    data: [],
  }),
  methods: {
    toDate(date) {
      return `${date.split(' ')[0].split('-')[0]} 年 ${parseInt(date.split(' ')[0].split('-')[1])} 月 ${parseInt(date.split(' ')[0].split('-')[2])} 日`;
    },
    toTime(date) {
      let time = '上午';
      const times = date.split(' ')[1].split(':');
      time = times[0] === 12 ? '中午' : '下午';
      if (times[0] > 12) {
        times[0] -= 12;
      }
      return `${time}${times[0]}：${times[1]}`;
    },
  },
};
</script>

<style>

</style>
