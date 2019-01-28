<template>
  <div id="app">
    <sidebar :data="sidebar" username="董顺忠老师"
    v-if="$route.name !== 'login'">
      <router-view/>
    </sidebar>
    <router-view v-else/>
  </div>
</template>

<script>
import sidebar from './layouts/sidebar'
export default {
  components: {
    sidebar
  },
  data: () => ({
    sidebar: [
      {
        title: '器材',
        list: [
          { title: '租借器材 ( 个人 )', target: {'name': 'personal'} },
          { title: '租借器材 ( 团队 )', target: {'name': 'group'} },
          { title: '管理器材'       , target: {'name': 'management'} },
        ]
      },
      {
        title: '统计',
        list: [
          { title: '年月度报表',     target: '/rent' },
          { title: '器材丢失和赔偿', target:'/rent'}
        ]
      },
      {
        title: '系统管理',
        list: [
          { title: '用户管理', target: {'name': 'users'} }
        ]
      }
    ]
  })
}
</script>

<style lang="scss">
#app {
  font-family: "Noto Sans SC";
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2D4059;
}

body {
  padding: 0;
  margin: 0;
}
</style>
