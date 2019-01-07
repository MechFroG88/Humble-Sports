<template>
  <div id="_login">
    <div class="container col-4">
      <div class="title">体育处系统</div>
      <div class="slogan">用科技贯穿校园</div>
      <div class="slogan">创造一个数据驱动化的系统</div>
      <form @submit.prevent="login()">
        <div class="input-group">
          <label class="input-label" for="username">用户名</label>
          <input class="username" type="text" id="username" 
          placeholder="请输入用户名" v-model="username">
          <label class="input-label" for="password">密码</label>
          <input class="password" type="password" id="password" 
          placeholder="请输入密码" v-model="password">
        </div>
        <div class="form-group">
          <label class="form-checkbox">
            <input type="checkbox" v-model="remember">
            <i class="form-icon"></i> 记住我
          </label>
          <span class="forgot c-hand" @click="forgotPassword()">忘记密码?</span>
        </div>
        <button class="btn btn-primary submit" type="submit">登入</button>
      </form>
    </div>
    <div class="pic col-8"></div>
  </div>
</template>

<script>
export default {
  data: () => ({
    username: '',
    password: '',
    remember: false,
  }),
  methods: {
    forgotPassword() {
      alert('forgot password')
    },
    login() {
      this.$router.push('/rent');
    }
  }
};
</script>

<style>
</style>
