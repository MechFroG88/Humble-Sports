<template>
  <div id="_settings">
    <div class="container">
      <div class="title">您的资料</div>
      <div class="nameTitle">名字</div>
      <div class="name">{{name}}</div>
      <div class="usernameTitle">用户名</div>

      <div v-if="!edit" class="user">
        <span class="username">{{username}}</span>
        <i class="icon icon-edit-2" @click="edit = !edit"></i>
      </div>
      <form v-else @submit.prevent="edit = !edit">
        <div class="input-group">
          <input type="text" class="form-input" placeholder="请输入用户名" v-model="username">
          <button class="btn btn-primary confirmbtn input-group-btn" type="submit">确认</button>
        </div>
      </form>
      <div class="safety">安全</div>
      <div class="btn btn-primary safetyBtn" @click="$refs.add.active = true">更改密码
      </div>
    </div>

    <pwModal ref="add" title="更改密码" closable>
      <div slot="body">
        <form class=form-group>
          <label class="newPw">新密码</label>
          <input type="password" class="form-input" placeholder="请输入新密码" id="password">
        </form>
        <form class=form-group>
          <label class="confirmPw">确认新密码</label>
          <input type="password" class="form-input" placeholder="请再次输入新密码" id="password">
        </form>
      </div>
      <div slot="footer">
        <div class="button-group">
          <div class="btn btn-lg btn-primary cancel" 
          @click="$refs.add.active = false">取消</div>
          <div class="btn btn-lg btn-primary ok"
          @click="add()">确定</div>
        </div>
      </div>
    </pwModal>
  </div>
</template>

<script>
import pwModal from '@/components/modal'
export default {
  components: {
    pwModal
  },
  data: () => ({
    name: '董顺忠',
    username: 'dong1234',
    edit: false,
  }),
  methods: {
    add() {
      this.$refs.add.active = false
    }
  }
}
</script>

<style>

</style>
