<template>
  <div id="_comp" class="modal" :class="[
    active ? 'active' : ''
  ]">
    <a class="modal-overlay" aria-label="Close"
    @click="active = false"/>
    <div class="modal-container">
      <div class="modal-header">
        <div class="modal-title-group">
          <div class="modal-title h3">赔偿</div>
          <div class="header ml-2">
            <div class="comp">总计赔偿金额：</div>
            <div class="amount">{{data.total_fine}}
            </div>
          </div>
        </div>
        <i class="icon icon-x-circle float-right close-button" @click="active = false"
        v-if="closable"></i>
      </div>
      <div class="modal-body">
        <div class="content">
          <cpTable width="100" class="mt-2" ref="table" :columns="comp_columns">

          </cpTable>
          <div class="detailsContainer mt-2">
            <div class="payerContainer columns">
              <div class="payer column col-2">支付者：</div>
              <div class="payerName"> {{data.student_id}}{{data.cn_name}}</div>
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
              <div class="amount">{{data.total_fine}}
              </div>
            </div>
            <div class="cashierContainer columns">
              <div class="cashier column col-2">收银人：</div>
              <div class="cashierName">{{data.teacher}}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="footer">
          <div class="btn btn-lg printBtn mr-2">列印</div>
          <div class="btn btn-lg btn-primary ml-2" @click="active = false">完成</div>
        </div>
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
        return (obj.id)
        && (obj.student_id)
        && (obj.cn_name)
        && (obj.item_out)
        && (obj.item_in)
        && (obj.days)
        && (obj.fine)
        && (obj.total)
        && (obj.item_type)
        && (obj.teacher)
      }
    }
  },
  components: {
    cpTable
  },
  data: () => ({
    comp_columns: comp_column,
    active: false,
  }),
};
</script>

<style>

</style>
