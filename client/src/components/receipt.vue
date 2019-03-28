<template>
  <div id="_receipt" class="modal" :class="[
    active ? 'active' : ''
  ]">
    <a class="modal-overlay" aria-label="Close"
    @click="active = false"/>
      {{data.grouprent.item_out}}
    <div class="modal-container" v-if="Object.keys(data).length">
      <div class="modal-header">
        <div class="modal-title-group">
          <div class="modal-title h3">罚款</div>
          <div class="header ml-2">
            <div class="fine">总计罚款金额：</div>
            <div class="amount">RM{{ (data.total_fine + data.total_price).toFixed(2) }}</div>
          </div>
        </div>
        <i class="icon icon-x-circle float-right close-button" @click="active = false"
        v-if="closable"></i>
      </div>
      <div class="modal-body">
        <div class="content">
          <div class="container" v-if="data.days">
            <div class="left-container">
              <div class="title">借出时间</div>
              <div class="date">{{ toDate(data.personalrent.item_out) }}</div>
              <div class="time">{{ toTime(data.personalrent.item_out) }}</div>
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
              <div class="date">{{ toDate(data.personalrent.item_in) }}</div>
              <div class="time">{{ toTime(data.personalrent.item_in) }}</div>
            </div>
          </div>
          <div class="lateContainer" v-if="data.days">
            <span class="late">已逾期 </span>
            <span class="lateTime">{{ data.days }} 天</span>
            <div class="lateFine">
              {{ data.days }} x RM {{ parseFloat(data.fine).toFixed(2) }} = RM {{ parseFloat(data.total_fine).toFixed(2) }}
            </div>
          </div>
          <div class="detailsContainer" :class="{'late': data.days}">
            <div class="payerContainer columns">
              <div class="payer column col-2">支付者：</div>
              <div class="payerName">
                {{ data.personalrent ? data.personalrent.student_id : data.grouprent.student_id }} {{ data.user.cn_name }}
              </div>
            </div>
            <div class="itemContainer columns">
              <div class="item column col-2">项目：</div>
              <div class="itemGroup">
                <div class="itemType">
                  {{ data.days != 0 ? `${data.personal ? data.personalrent.item.type : data.grouprent.item.type} 逾期 ${data.days} 天` : '' }}
                  <br v-if="data.days && data.fine">
                  {{ data.lost != 0 ? `${data.personal ? data.personalrent.item.type : data.grouprent.item.type} 遗失 ${data.lost} 个` : '' }}
                  {{ data.days == 0 && data.lost == 0 ? '逾期' : '' }}
                </div>
              </div>
            </div>
            <div class="moneyContainer columns">
              <div class="money column col-2">来银：</div>
              <div class="amount">RM {{ (data.total_fine + data.total_price).toFixed(2) }}</div>
            </div>
            <div class="cashierContainer columns">
              <div class="cashier column col-2">收银人：</div>
              <div class="cashierName">{{ data.user.cn_name }}</div>
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
import { comp_column } from '@/api/tableColumns';

export default {
  props: {
    closable: {
      type: Boolean,
      default: true,
    },
    data: {
      type: Object,
      // validator: function(obj) {
      //   return obj.id
      //       && obj.personalrent.student_id
      //       && obj.personalrent.item_out
      //       && obj.personalrent.item_in
      //       && obj.days
      //       && obj.fine
      //       && obj.total_fine
      //       && obj.total_price
      //       && obj.personalrent.item.type
      //       && obj.user.cn_name;
      // }
    }
  },
  methods: {
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
    // calTime(dateIn, dateOut) {
    //   const timeIn = dateIn.split(' ')[1].split(':');
    //   const timeOut = dateOut.split(' ')[1].split(':');
    //   let lateHour = timeIn[0] - timeOut[0];
    //   let lateMinutes = timeIn[1] - timeOut[1];

    //   if (lateMinutes < 0) {
    //     lateMinutes += 60;
    //     lateHour--;
    //   }
    //   if (lateHour < 0) {
    //     lateHour += 24;
    //   }
    //   return `${lateHour} 小时 ${lateMinutes} 分钟`;
    // },
  },
  data: () => ({
    columns: comp_column,
    active: false,
  }),
};
</script>

<style>

</style>
