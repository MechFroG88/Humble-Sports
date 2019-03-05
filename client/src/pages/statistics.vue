<template>
  <div id="_statistics">
    <div class="columns">
      <div class="column col-4">
        <div class="tile tile-centered unreturned">
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
        <div class="tile tile-centered expired">
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
        <div class="tile tile-centered loss">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.lost}}</p>
            <p class="tile-subtitle">本月丢失数量</p>
          </div>
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column col-6">
        <div class="tile tile-centered fine">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.paid_fine_count}}</p>
            <p class="tile-subtitle">未归还数量</p>
          </div>
          <div class="tile-action">
            <p class="tile-title mb-2">RM{{data.paid_fine}}</p>
            <p class="tile-subtitle">总额</p>
          </div>
        </div>
      </div>
      <div class="column col-6">
        <div class="tile tile-centered payment">
          <div class="tile-icon mr-2">
            <i class="icon icon-users centered"></i>
          </div>
          <div class="tile-content">
            <p class="tile-title mb-2">{{data.paid_lost_count}}</p>
            <p class="tile-subtitle">本月逾期数量</p>
          </div>
          <div class="tile-action">
            <p class="tile-title mb-2">RM{{data.paid_lost}}</p>
            <p class="tile-subtitle">总额</p>
          </div>
        </div>
      </div>
    </div>
    <div class="chart" v-if="data.year">
      <h4 class="chart-title">年月度统计表</h4>
      <GChart
      align="center"
      :settings="{packages: ['bar']}"    
      :data="chartData"
      :options="chartOptions"
      :createChart="(el, google) => new google.charts.Bar(el)"
      @ready="onChartReady"
      />
    </div>
  </div>
</template>

<script>
import { getReport } from '@/api/report'

import { GChart } from 'vue-google-charts'

export default {
  components: {
    GChart
  },
  mounted() {
    getReport().then(({ data }) => {
      console.log(data);
      this.data = data;
    }).catch((err) => {
      console.log(err)
    })
  },
  data: () => ({
    data: {},
    chartsLib: null,
    chartData: [
      ['', '总借出量'],
      ['12月', 70],
      ['1月', 80],
      ['2月', 42],
      ['3月', 97],
      ['4月', 67],
      ['5月', 73]
    ]
  }),
  computed: {
    chartOptions () {
      if (!this.chartsLib) return null
      return this.chartsLib.charts.Bar.convertOptions({
        bars: 'vertical',
        hAxis: { format: 'short' },
        vAxis: {
          gridlines: {
            color: 'transparent'
          }
        },
        height: 300,
        width: 900,
        bar: { groupWidth: '30%'},
        legend: { position: 'none' },
        colors: ['#17B9B2']
      })
    }
  },
  methods: {
    onChartReady (chart, google) {
      this.chartsLib = google
    }
  }
}
</script>

<style>

</style>
