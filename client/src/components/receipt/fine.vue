<template>
  <div id="_fine" class="modal" :class="[
    active ? 'active' : ''
  ]">
    <a class="modal-overlay" aria-label="Close"
    @click="active = false"/>
    <div class="modal-container">
      <div class="modal-header">
        <div class="modal-title-group">
          <div class="modal-title h3">罚款</div>
          <div class="header ml-2">
            <div class="fine">总计罚款金额：</div>
            <div class="amount">{{fineData.total}}
           </div>
          </div>
        </div>
        <i class="icon icon-x-circle float-right close-button" @click="active = false"
        v-if="closable"></i>
      </div>
      <div class="modal-body">
        <div class="content">
          <div class="container">
            <div class="left-container">
              <div class="title">借出时间</div>
              <div class="date">{{toDate(fineData.item_out)}}
              </div>
              <div class="time">{{toTime(fineData.item_out)}}
              </div>
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
              <div class="date">{{toDate(fineData.item_in)}} 
              </div>
              <div class="time">{{toTime(fineData.item_in)}}
              </div>
            </div>
          </div>
          <div class="lateContainer">
            <span class="late">已逾期 </span>
            <span class="lateTime">{{fineData.days}}天
              {{calTime(fineData.item_in,fineData.item_out)}}
            </span>
            <div class="lateFine">{{fineData.days}}x
              {{fineData.fine}}={{fineData.total}}
            </div>
          </div>
          <div class="detailsContainer mt-2">
            <div class="payerContainer columns">
              <div class="payer column col-2">支付者：</div>
              <div class="payerName">{{fineData.student_id}}{{fineData.cn_name}}
              </div>
            </div>
            <div class="itemContainer columns">
              <div class="item column col-2">项目：</div>
              <div class="itemGroup">
                <div class="itemType">{{fineData.item_type}}逾期{{fineData.days}}天
              {{calTime(fineData.item_in,fineData.item_out)}}
                </div>
                <div class="code">追踪代码：
                  {{fineData.code}}
                </div>
              </div>
            </div>
            <div class="moneyContainer columns">
              <div class="money column col-2">来银：</div>
              <div class="amount">{{fineData.total}}</div>
            </div>
            <div class="cashierContainer columns">
              <div class="cashier column col-2">收银人：</div>
              <div class="cashierName">{{fineData.teacher}}</div>
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
            && obj.student_id
            // && obj.cn_name
            && obj.item_out
            && obj.item_in
            && obj.days
            && obj.fine
            && obj.total
            && obj.item_type
            && obj.teacher;
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
      return `${time}${parseInt(times[0])}：${times[1]}`;
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
  
  data: () => ({
    active: false,
  }),
};
</script>

<style>

</style>
