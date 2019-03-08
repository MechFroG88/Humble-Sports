<template>
  <div id="app">
    <sidebar :data="sidebar" :username="username"
    v-if="$route.name !== 'login'">
      <router-view/>
    </sidebar>
    <router-view v-else/>
    <flash-message class="notification"></flash-message>
  </div>
</template>

<script>
import { getCurrentUser } from '@/api/user';

import sidebar from './layouts/sidebar';

export default {
  components: {
    sidebar,
  },
  mounted() {
    if (this.$route.name !== 'login') {
      getCurrentUser().then(({ data }) => {
        this.username = data.cn_name;
      }).catch((err) => {
        console.log(err);
      })
    }
  },
  data: () => ({
    username: '',
    sidebar: [
      {
        title: '器材',
        list: [
          { title: '租借器材 ( 个人 )', target: { name: 'personal' } },
          { title: '租借器材 ( 团队 )', target: { name: 'group' } },
          { title: '管理器材', target: { name: 'management' } },
        ],
      },
      {
        title: '统计',
        list: [
          { title: '年月度报表',     target: {'name': 'stats'} },
        ]
      },
      {
        title: '系统管理',
        list: [
          { title: '用户管理', target: { name: 'users' } },
        ],
      },
    ],
  }),
  watch: {
    $route(to, from) {
      if (from.name == 'login' && to.name != 'login') {
        getCurrentUser().then(({ data }) => {
          this.username = data.cn_name;
        }).catch((err) => {
          console.log(err);
        })
      }
    }
  }
};
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
