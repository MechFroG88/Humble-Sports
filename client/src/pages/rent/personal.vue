<template>
  <div id="_personal">
    <div class="btn btn-lg btn-primary"
    @click="$router.push({
      'name': 'addNew',
      'params': {
        'state': 'personal'
      }
    })">新增</div>
    <!-- temporary fine receipt button -->
    <div class="btn btn-lg btn-primary" style="margin-left: 2rem;" @click="$refs.add.active = true"> fine </div>

    <receiptModal ref="add" title="罚款" closable>
      <div slot="header" class="header">
        <div class="fine">总计罚款金额：</div>
        <div class="fineAmount">RM1.80</div>
      </div>
      <div slot="body">
        <div class="container">
          <div class="left-container">
            <div class="lend">借出时间</div>
            <div class="lendDate">2018 年 9 月 18 日
            </div>
            <div class="lendTime">早上 8：15</div>
          </div>
          <div class="box1">
            <div class="dottedLine"></div>
          </div>
          <div class="center-container">
            <i class="icon icon-x-circle" ></i>
          </div>
          <div class="box2">
            <div class="dottedLine"></div>
          </div>
          <div class="right-container">
            <div class="return">归还时间</div>
            <div class="returnDate">2018 年 9 月 22 日</div>
            <div class="returnTime">早上 8：45</div>
          </div>
        </div>
        <div class="lateContainer">
          <span class="late">已逾期 </span>
          <span class="lateTime">1 天 3 小时</span>
          <div class="lateFine">1 x RM 1.80 = RM 1.80 
          </div>
        </div>
        <div class="detailsContainer">
          <div class="payerContainer">
            <div class="payer">支付者：</div>
            <div class="payerName"> 140549 陈智霖</div>
          </div>
          <div class="itemContainer">
            <div class="item">项目：</div>
            <div class="itemGroup">
              <div class="itemType">篮球逾期 1 天 3 小时
              </div>
              <div class="code">追踪代码：KL145-2</div>
            </div>
          </div>
          <div class="moneyContainer">
            <div class="money">来银：</div>
            <div class="amount">RM 1.80</div>
          </div>
          <div class="cashierContainer">
            <div class="cashier">收银人：</div>
            <div class="cashierName">董顺忠老师</div>
          </div>
        </div>
      </div>
      <div slot="footer" class="footer">
        <div class="print">（点击已收取便能列印收据）</div>
        <div class="btn btn-lg btn-primary" @click="add()">已收取
        </div>
      </div>
     </receiptModal> 


      <receiptModal ref="add2" title="罚款" closable>
        <div slot="header" class="header">
          <div class="fine">总计罚款金额：</div>
          <div class="fineAmount">RM1.80</div>
        </div>
        <div slot="body">
          <div class="container">
            <div class="left-container">
              <div class="lend">借出时间</div>
              <div class="lendDate">2018 年 9 月 18 日
              </div>
              <div class="lendTime">早上 8：15</div>
            </div>
            <div class="box1">
              <div class="dottedLine"></div>
            </div>
            <div class="center-container">
              <i class="icon icon-x-circle" ></i>
            </div>
            <div class="box2">
              <div class="dottedLine"></div>
            </div>
            <div class="right-container">
              <div class="return">归还时间</div>
              <div class="returnDate">2018 年 9 月 22 日</div>
              <div class="returnTime">早上 8：45</div>
            </div>
          </div>
          <div class="lateContainer">
            <span class="late">已逾期 </span>
            <span class="lateTime">1 天 3 小时</span>
            <div class="lateFine">1 x RM 1.80 = RM 1.80 
            </div>
          </div>
          <div class="detailsContainer">
            <div class="payerContainer">
              <div class="payer">支付者：</div>
              <div class="payerName"> 140549 陈智霖</div>
            </div>
            <div class="itemContainer">
              <div class="item">项目：</div>
              <div class="itemGroup">
                <div class="itemType">篮球逾期 1 天 3 小时
                </div>
                <div class="code">追踪代码：KL145-2</div>
              </div>
            </div>
            <div class="moneyContainer">
              <div class="money">来银：</div>
              <div class="amount">RM 1.80</div>
            </div>
            <div class="cashierContainer">
              <div class="cashier">收银人：</div>
              <div class="cashierName">董顺忠老师</div>
            </div>
          </div>
        </div>
        <div slot="footer" class="footer">
          <div class="btn btn-lg printBtn">列印</div>
          <div class="btn btn-lg btn-primary " @click="add2()">完成
          </div>
        </div>
     </receiptModal>

    <!-- temporary compensation receipt button -->
    <div class="btn btn-lg btn-primary" style="margin-left: 2rem;" @click="$refs.comp.active = true"> comp </div>

    <receiptModal ref="comp" title="赔偿" closable>  
      <div slot="header" class="header">
        <div class="comp">总计赔偿金额：</div>
        <div class="compAmount">RM25.00</div>
      </div>
      <div slot="body">
        <cpTable width="100" class="mt-2" ref="table" :columns="columns[1]">

        </cpTable>
        <div class="detailsContainer">
          <div class="payerContainer">
            <div class="payer">支付者：</div>
            <div class="payerName"> 140549 陈智霖</div>
          </div>
          <div class="itemContainer">
            <div class="item">项目：</div>
            <div class="itemGroup">
              <div class="itemType">篮球逾期 1 天 3 小时
              </div>
              <div class="code">追踪代码：KL145-2</div>
            </div>
          </div>
          <div class="moneyContainer">
            <div class="money">来银：</div>
            <div class="amount">RM 1.80</div>
          </div>
          <div class="cashierContainer">
            <div class="cashier">收银人：</div>
            <div class="cashierName">董顺忠老师</div>
          </div>
        </div>
      </div>
    </receiptModal>



    <cp-table width="100" class="mt-2" ref="table"
    :columns="columns[0]" :tableData="data" title navbar="搜寻学号或名字">
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
          已丢失 <div class="fine"><a href="">索取赔偿</a>
          </div>
        </span>
      </template>
    </cp-table>
  </div>
</template>

<script>
import { getPersonalRent } from '@/api/rental';

import receiptModal from '@/components/modal';
import cpTable from '@/components/tables';
import { personal_column } from '@/api/tableColumns';
import { comp_column } from '@/api/tableColumns';

export default {
  components: {
    cpTable,
    receiptModal,
  },
  data: () => ({
    columns:[ personal_column,comp_column ], 
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
    add(){
      this.$refs.add.active = false;
      this.$refs.add2.active = true;
    },
    add2(){
      this.$refs.add2.active = false;
    },
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
