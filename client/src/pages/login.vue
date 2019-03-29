<template>
  <div id="_login">
    <div class="container col-4">
      <div class="title">体育处系统</div>
      <div class="slogan">用科技贯穿校园</div>
      <div class="slogan">创造一个数据驱动化的系统</div>
      <form @submit.prevent="login()">
        <div class="input-group username-input" 
        :class="{'error-input': errors.first('用户名')}">
          <span class="error" v-if="errors.first('用户名')">
            <i class="icon icon-alert-triangle"></i>
            <span class="toast toast-error">{{errors.first('用户名')}}</span>
          </span>
          <label class="input-label" for="username">用户名</label>
          <input class="username" type="text" id="username" name="用户名"
          placeholder="请输入用户名" v-model="username" v-validate="'required'">
        </div>
        <div class="input-group password-input"
        :class="{'error-input': errors.first('密码')}">
        <span class="error" v-if="errors.first('密码')">
            <i class="icon icon-alert-triangle"></i>
            <span class="toast toast-error">{{errors.first('密码')}}</span>
          </span>
          <label class="input-label" for="password">密码</label>
          <input class="password" type="password" id="password" name="密码"
          placeholder="请输入密码" v-model="password" v-validate="'required'">
        </div>
        <div class="form-group">
          <label class="form-checkbox">
            <input type="checkbox" v-model="remember">
            <i class="form-icon"></i> 记住我
          </label>
          <span class="forgot c-hand" @click="forgotPassword()">忘记密码?</span>
        </div>
        <button class="btn btn-primary submit" 
        :class="{'loading': loading}" type="submit">登入</button>
      </form>
    </div>
    <div class="pic col-8"></div>
  </div>
</template>

<script>
import { userLogin } from '@/api/user';

export default {
  data: () => ({
    username: '',
    password: '',
    remember: false,
    loading: false,
  }),
  methods: {
    forgotPassword() {
      console.log('forgot password');
    },
    login() {
      this.loading = true;
      userLogin({
        username: this.username,
        password: this.password,
      }).then(() => {
        this.loading = false;
        this.$router.push('/rent');
      }).catch((err) => {
        this.notification('登录失败！请重试！', 'error');
        this.loading = false;
      });
    },
  },
};
</script>

<style>
</style>
