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
      <form v-else @submit="edit = !edit">
        <div class="input-group">
          <input type="text" class="form-input" placeholder="请输入用户名" v-model="username">
          <button class="btn btn-primary confirmBtn input-group-btn" type="submit">确认</button>
        </div>
      </form>
      <div class="safety">安全</div>
      <button class="btn btn-primary safetyBtn">更改密码</button>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    name: '董顺忠',
    username: 'dong1234',
    edit: false
  }),
  methods:{
    
  }
}
</script>

<style>

</style>
