<template>
  <div id="_statistics">
    <GChart
    :settings="{packages: ['bar']}"    
    :data="chartData"
    :options="chartOptions"
    :createChart="(el, google) => new google.charts.Bar(el)"
    @ready="onChartReady"
    />
  </div>
</template>

<script>
import { GChart } from 'vue-google-charts'
export default {
  components: {
    GChart
  },
  data: () => ({
    chartsLib: null, 
    // Array will be automatically processed with visualization.arrayToDataTable function
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
        chart: {
          title: '年度统计表'
        },
        bars: 'vertical', // Required for Material Bar Charts.
        hAxis: { format: 'short' },
        height: 300,
        bar: { groupWidth: '30%'},
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
