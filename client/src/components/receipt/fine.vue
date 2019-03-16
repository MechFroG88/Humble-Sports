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
            <div class="amount">RM1.80</div>
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
              <div class="date">{{data.item_out_date}}
              </div>
              <div class="time">{{data.item_out_time}}
              </div>
            </div>
            <div class="box1">
              <div class="dottedLine"></div>
            </div>
            <i class="icon icon-x-circle" ></i>
            <div class="box2">
              <div class="dottedLine"></div>
            </div>
            <div class="right-container">
              <div class="title">归还时间</div>
              <div class="date">{{data.item_in_data}}</div>
              <div class="time">{{data.item_in_time}}</div>
            </div>
          </div>
          <div class="lateContainer">
            <span class="late">已逾期 </span>
            <span class="lateTime">{{data.late_time}}</span>
            <div class="lateFine">{{data.days}}x
              {{data.fine}}={{data.total_fine}}
            </div>
          </div>
          <div class="detailsContainer mt-2">
            <div class="payerContainer columns">
              <div class="payer column col-2">支付者：</div>
              <div class="payerName">{{data.student_id}}{{data.cn_name}} </div>
            </div>
            <div class="itemContainer columns">
              <div class="item column col-2">项目：</div>
              <div class="itemGroup">
                <div class="itemType">{{data.item_type}}逾期{{data.late_time}}
                </div>
                <div class="code">追踪代码：
                  {{data.code}}</div>
              </div>
            </div>
            <div class="moneyContainer columns">
              <div class="money column col-2">来银：</div>
              <div class="amount">{{data.total_fine}}</div>
            </div>
            <div class="cashierContainer columns">
              <div class="cashier column col-2">收银人：</div>
              <div class="cashierName">{{data.teacher}}</div>
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
            && obj.cn_name
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
  data: () => ({
    active: false,
  }),
};
</script>

<style>

</style>
