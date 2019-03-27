<template>
  <div id="_groupReceipt" class="modal" :class="[
    active ? 'active' : ''
  ]">
    <a class="modal-overlay" aria-label="Close"
    @click="active = false"/>
    <div class="modal-container" v-if="data">
      <div class="modal-header">
        <div class="modal-title-group">
          <div class="modal-title h3">罚款</div>
          <div class="header ml-2">
            <div class="fine">总计罚款金额：</div>
            <div class="amount">{{data.total_fine + data.total_price}}</div>
          </div>
        </div>
        <i class="icon icon-x-circle float-right close-button" @click="active = false"
        v-if="closable"></i>
      </div>
      <div class="modal-body">
        <div class="content">
          <!-- <cpTable width="100" class="mt-2" ref="table" :columns="columns" /> -->
          <div class="container">
            <div class="left-container">
              <div class="title">借出时间</div>
              <div class="date">{{toDate(data.grouprent.item_out)}}</div>
              <div class="time">{{toTime(data.grouprent.item_out)}}</div>
            </div>
            <div class="box1">
              <div class="dottedLine"></div>
            </div>
            <i class="icon icon-x-circle"></i>
            <div class="box2">
              <div class="dottedLine"></div>
            </div>
            <div class="right-container">
              <div class="title">归还时间</div>
              <div class="date">{{toDate(data.grouprent.item_in)}}</div>
              <div class="time">{{toTime(data.grouprent.item_in)}}</div>
            </div>
          </div>
          <div class="lateContainer">
            <span class="late">已逾期 </span>
            <span class="lateTime">
              {{data.days}} 天 {{calTime(data.grouprent.item_in, data.grouprent.item_out)}}
            </span>
            <div class="lateFine">
              {{data.days}} x {{data.fine}} = {{data.total_fine}}
            </div>
          </div>
          <div class="detailsContainer mt-2">
            <div class="payerContainer columns">
              <div class="payer column col-2">支付者：</div>
              <div class="payerName">
                {{data.grouprent.student_id}} {{data.user.cn_name}}
              </div>
            </div>
            <div class="itemContainer columns">
              <div class="item column col-2">项目：</div>
              <div class="itemGroup">
                <div class="itemType">
                  {{data.grouprent.item.type}}逾期{{data.days}}天{{calTime(data.grouprent.item_in, data.grouprent.item_out)}}
                </div>
              </div>
            </div>
            <div class="moneyContainer columns">
              <div class="money column col-2">来银：</div>
              <div class="amount">{{data.total_fine + data.total_price}}</div>
            </div>
            <div class="cashierContainer columns">
              <div class="cashier column col-2">收银人：</div>
              <div class="cashierName">{{data.grouprent.teacher}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <slot name="footer"/>
      </div>
    </div>
  </div>
</template>

<script>
import cpTable from '@/components/tables';
import { comp_column } from '@/api/tableColumns';

export default {
  props: {
    closable: {
      type: Boolean,
      default: true,
    },
    title: String,
    data: {
      type: Object,
      validator: function(obj) {
        return obj.id
            && obj.grouprent.group_name
            && obj.grouprent.student_id
            && obj.grouprent.item_out
            && obj.grouprent.item_in
            && obj.days
            && obj.single_fine
            && obj.single_price
            && obj.total_fine
            && obj.total_price
            && obj.grouprent.item.type
            && obj.user.cn_name;
      }
    }
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
    calTime(dateIn,dateOut) {
      const timeIn = dateIn.split(' ')[1].split(':');
      const timeOut = dateOut.split(' ')[1].split(':');
      var lateHour = (timeIn[0]-timeOut[0]);
      if (lateHour < 0){
        lateHour += 24;
      }
      var lateMinutes = (timeIn[1]-timeOut[1]);
      if (lateMinutes < 0){
        lateMinutes += 60;
        lateHour -= 1
      }
      return `${lateHour} 小时 ${lateMinutes} 分钟`;
    }
  },
  components: {
    cpTable
  },
  data: () => ({
    columns: comp_column,
    active: false,
  }),
};
</script>

<style>

</style>
