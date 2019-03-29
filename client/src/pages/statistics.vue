<template>
  <div id="_statistics">
    <div class="columns">
      <div class="column col-4">
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
      <div class="column col-4">
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
      <div class="column col-4">
        <div class="tile tile-centered loss" :class="{'loading loading-lg': loading}">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.paid_count}}</p>
            <p class="tile-subtitle">本月罚款数量</p>
          </div>
          <div class="tile-action">
            <p class="tile-title mb-2">RM{{data.total_paid}}</p>
            <p class="tile-subtitle">总额</p>
          </div>
        </div>
      </div>
    </div>
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
    getReportGraph().then(({ data }) => {
      data.forEach(element => {
        this.tableData.push([`${element.month}月`, element.total]);
      });
      console.log(this.tableData);
    }).catch((err) => {
      console.log(err);
    })
  },
  data: () => ({
    loading: true,
    data: {},
    tableData: [['', '总借出量']],
    chartsLib: null,
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
    }
  }
}
</script>

<style>

</style>
