<template>
  <div id="_settings">
    <div class="container">
      <div class="title">您的资料</div>
      <div class="nameTitle">名字</div>
      <div class="name">{{name}}</div>
      <div class="usernameTitle">用户名</div>

      <div v-if="!edit" class="user">
        <span class="username">{{username}}</span>
        <i class="icon icon-edit-2" @click="edit = true"></i>
      </div>
      <form v-else @submit.prevent="editUsername">
        <div class="input-group">
          <input type="text" class="form-input" :class="{'error-input': errors.first('用户名')}" name="用户名" placeholder="请输入用户名" v-model="username" v-validate="'required'">
          <p class="form-input-hint text-error">{{ errors.first('用户名') }}</p>
          <button class="btn btn-primary confirmbtn input-group-btn" :class="{'loading': username_loading}"
          type="submit">确认</button>
        </div>
      </form>
      <div class="safety">安全</div>
      <div class="btn btn-primary safetyBtn" @click="$refs.change_password.active = true">更改密码</div>
    </div>

    <pwModal ref="change_password" title="更改密码" closable>
      <div slot="body">
        <div class=form-group>
          <label class="newPw" for="password">新密码</label>
          <input type="password" class="form-input" :class="{'error-input': errors.first('密码')}" placeholder="请输入新密码" 
          name="密码" id="password" v-model="password" v-validate="'required'">
          <p class="form-input-hint text-error">{{ errors.first('密码') }}</p>
        </div>
        <div class=form-group>
          <label class="confirmPw" for="confirm_password">确认新密码</label>
          <input type="password" class="form-input" :class="{'error-input': errors.first('新密码')}" placeholder="请再次输入新密码" 
          name="新密码" id="confirm_password" v-model="confirm_password" v-validate="'required'">
          <p class="form-input-hint text-error">{{ errors.first('新密码') }}</p>
        </div>
      </div>
      <div slot="footer">
        <div class="button-group">
          <div class="btn btn-lg btn-primary cancel" 
          @click="$refs.change_password.active = false">取消</div>
          <div class="btn btn-lg btn-primary ok" :class="{'loading': password_loading}"
          @click="editPassword">确定</div>
        </div>
      </div>
    </pwModal>
  </div>
</template>

<script>
import { getCurrentUser, updateUserUsername, updateUserPassword } from '@/api/user';

import pwModal from '@/components/modal';

export default {
  components: {
    pwModal
  },
  mounted() {
    getCurrentUser().then(({ data }) => {
      console.log(data);
      this.name = data.cn_name;
      this.username = data.username;
    })
  },
  data: () => ({
    name: '',
    username: '',
    edit: false,
    username_loading: false,
    password_loading: false,
    password: '',
    confirm_password: ''
  }),
  methods: {
    editUsername() {
      this.username_loading = true;
      updateUserUsername({username: this.username}).then((msg) => {
        this.username_loading = false;
        this.edit = false;
      }).catch((err) => {
        this.notification('更改用户名失败！请重试！', 'error');
        console.log(err);
      })
    },
    editPassword() {
      if (this.password == this.confirm_password) {
        this.loading = true;
        updateUserPassword({password: this.password}).then((msg) => {
          this.notification('成功更改密码', 'success');
          this.loading = false;
          this.$refs.change_password.active = false;
        }).catch((err) => {
          this.notification('密码更换失败！请重试！', 'error');
          this.loading = false;
          console.log(err);
        })
      } else {
        console.log('hi');
        this.notification('密码必须一致', 'warning');
      }
    }
  }
}
</script>

<style>

</style>
