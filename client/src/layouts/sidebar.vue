<template>
  <div id="_sidebar">
    <div class="side col-2">
      <div style="width: 100%; display: flex; flex-direction: column;">
        <span class="title h2">体育处系统</span>
        <div v-for="c in data" :key="c.title" class="section">
          <span class="category_title">{{c.title}}</span>
          <ul>
            <li v-for="item in c.list" :key="item.title"
            :class="{'active': active == item.target.name}" @click="active = item.target.name">
              <router-link :to="item.target" tag="div">
                {{item.title}}
                <span class="link_extender"></span>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
      <div class="footer">
        <div class="user c-hand" :class="{'loading loading-lg': loading}">
          <div class="popover popover-top">
            <i class="icon icon-user mr-2"></i>
            <span class="popover-container">
              {{username}}
            </span>
          </div>
          <span class="username">{{username}}</span>
        </div>
        <div>
          <i class="icon icon-settings mr-2 c-hand"
          @click="$router.push('/settings')"></i>
          <i class="icon icon-log-out ml-2 c-hand"
          @click="logout()"></i>
        </div>
      </div>
    </div>
    <div class="main col-10">
      <slot/>
    </div>
  </div>
</template>

<script>
import { userLogout, getCurrentUser } from '@/api/user';

export default {
  props: {
    data: Array,
  },
  data: () => ({
    active: '',
    targets: [],
    username: '',
    loading: true,
  }),
  mounted() {
    this.active = this.data[0].list[0].target.name;
    getCurrentUser().then(({ data }) => {
      this.loading = false;
      this.username = data.cn_name;
    }).catch((err) => {
      console.log(err);
    });
  },
  methods: {
    logout() {
      userLogout().then(() => {
        this.$router.push('/login');
      }).catch((err) => {
        console.log('Error with logging out');
        console.log(err);
      });
    },
  },
  methods: {
    logout() {
      this.$router.push('/login');
      userLogout().catch((err) => {
        console.log('Error with logging out');
        console.log(err);
      });
    },
  },
  watch: {
    $route(to, from) {
      this.active = to.name;
      if (from.name == 'login' && to.name != 'login') {
        getCurrentUser().then(({ data }) => {
          this.username = data.cn_name;
        }).catch((err) => {
          console.log(err);
        })
      }
    }
  },
};
</script>

<style>

</style>
