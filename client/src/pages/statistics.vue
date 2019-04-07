<template>
  
  <div id="_statistics">
    <div class="columns">
      <div class="column col-4 col-xl-6">
        <div class="tile tile-centered unreturned" :class="{'loading loading-lg': loading}">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.unreturned}}</p>
            <p class="tile-subtitle">未归还数量</p>
          </div>
        </div>
      </div>
      <div class="column col-4 col-xl-6">
        <div class="tile tile-centered expired" :class="{'loading loading-lg': loading}">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.expired}}</p>
            <p class="tile-subtitle">本月逾期数量</p>
          </div>
        </div>
      </div>

      <div class="column col-4 col-xl-6">
        <div class="tile tile-centered loss" :class="{'loading loading-lg': loading}">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.lost}}</p>
            <p class="tile-subtitle">本月丢失数量</p>
          </div>
        </div>
      </div>

      <div class="column col-6 col-xl-6">
        <div class="tile tile-centered count " :class="{'loading loading-lg': loading}">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.fine_paid_count}}</p>
            <p class="tile-subtitle">本月罚款数量</p>
          </div>
          <div class="tile-action">
            <p class="tile-title mb-2">RM{{data.fine_total_paid}}</p>
            <p class="tile-subtitle">总额</p>
          </div>
        </div>
      </div>

       <div class="column col-6 col-xl-6">
        <div class="tile tile-centered count" :class="{'loading loading-lg': loading}">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.lost_paid_count}}</p>
            <p class="tile-subtitle">本月赔偿数量</p>
          </div>
          <div class="tile-action">
            <p class="tile-title mb-2">RM{{data.lost_total_paid}}</p>
            <p class="tile-subtitle">总额</p>
          </div>
        </div>
      </div>
    </div>
    <div class="enterYear">
      <h5 class="title">年度统计</h5>
      <div class="form-horizontal">
        <div class="form-group">
          <div class="col-2 col-xl-4 col-sm-12">
            <label class="form-label">年份：</label>
          </div>
          <div class="col-6 col-xl-8 col-sm-12">
            <div>
              <input class="form-input" :class="{'error-input': errors.first('年份')}"
              type="text" id="year" name="年份" placeholder="请输入想查阅的年份"
              v-model="year" v-validate="'required'">
            </div>
            <p class="form-input-hint text-error">{{ errors.first('年份') }}</p>
          </div>
          <div class="col-3">
            <div class="btn btn-lg btn-primary" type="submit" @click="showGraph()">确认</div>
          </div>
        </div>
       </div>

    </div>
      
    <!-- <div class="columns">
      <div class="column col-4 col-ml-auto">
        <div class="tile tile-centered total" :class="{'loading loading-lg': loading}">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">RM{{data.total_paid}}</p>
            <p class="tile-subtitle">总额</p>
          </div>
        </div>
      </div>
    </div> -->
    <div class="chart" v-if="tableData.length > 1" :class="{'loading loading-lg': loading}">
      <h4 class="chart-title">年月度统计表</h4>
      <GChart
      align="center"
      :settings="{packages: ['bar']}"    
      :data="tableData"
      :options="chartOptions"
      :createChart="(el, google) => new google.charts.Bar(el)"
      @ready="onChartReady"
      />
    </div>
  </div>
</template>

<script>
import { getReport, getReportGraph } from '@/api/report'

import { GChart } from 'vue-google-charts'

export default {
  components: {
    GChart
  },
  mounted() {
    getReport().then(({ data }) => {
      this.loading = false;
      this.data = data;
    }).catch((err) => {
      console.log(err);
    })
  },
  data: () => ({
    loading: true,
    data: {},
    tableData: [['', '总借出量']],
    chartsLib: null,
    year:''
  }),
  computed: {
    chartOptions () {
      if (!this.chartsLib) return null
      return this.chartsLib.charts.Bar.convertOptions({
        bars: 'vertical',
        hAxis: { format: 'short' },
        height: 300,
        width: 1100,
        bar: { groupWidth: '25%' },
        legend: { position: 'none' },
        colors: ['#17B9B2']
      })
    }
  },
  methods: {
    onChartReady (chart, google) {
      this.chartsLib = google;
    },
    showGraph() {
      getReportGraph(this.year).then(({ data }) => {
      this.tableData = [['', '总借出量']];
      data.forEach(element => {
        this.tableData.push([`${element.month}月`, element.total]);
      });
    }).catch((err) => {
      console.log(err);
    })
    }
  }
}
</script>

<style>

</style>
