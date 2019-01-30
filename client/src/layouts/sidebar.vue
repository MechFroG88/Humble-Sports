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
        <div class="user c-hand">
          <i class="icon icon-user mr-2"></i>
          {{username}}
        </div>
        <div>
          <i class="icon icon-settings mr-2 c-hand"
          @click="$router.push('/settings')"></i>
          <i class="icon icon-log-out ml-2 c-hand" 
          @click="$router.push('/login')"></i>
        </div>
      </div>
    </div>
    <div class="main col-10">
      <slot/>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    data: Array,
    username: String
  },
  data: () => ({
    active: '',
    targets: []
  }),
  mounted() {
    this.active = this.data[0].list[0].target.name;
  },
  watch: {
    $route(to, from) {
      this.active = to.name
    }
  }
}
</script>

<style>

</style>
