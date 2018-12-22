<template>
  <div id="_rent columns">
    <sidebar :data="sidebar">
      Main page goes here
    </sidebar>
  </div>
</template>

<script>
import sidebar from '../layouts/sidebar'
export default {
  components: {
    sidebar
  },
  data: () => ({
    sidebar: [
      {
        title: '器材',
        list: [
          { title: '租借器材 ( 个人 )', target: '/rent' },
          { title: '租借器材 ( 团队 )', target: '/rent' },
          { title: '管理器材'        , target: '/rent' },
        ]
      },
      {
        title: '统计',
        list: [
          { title: '年月度报表', target: '/rent' },
          { title: '器材丢失和赔偿', target: '/rent' }  
        ]
      }
    ]
  })
}
</script>

<style >

</style>
