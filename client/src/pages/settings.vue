<template>
  <div id="_settings">
    <div class="container ">
    <div class="title">您的资料</div>
    <div class="nametitle">名字</div>
    <div class="name">{{name}}</div>
    <div class="usernametitle">用户名</div>

    <div v-if="edit" class="user">
    <span class="username">{{username}}</span>
    <i class="icon icon-edit-2"
          @click='edit =! edit'></i>
    </div>
    <div v-else class="user">
    <input class="form-input" type="text" id="username"  placeholder="请输入用户名" v-model="username">
    <button class="btn btn-primary confirmbtn" type="submit" @click='edit =! edit'>确认
    </button>
    <!-- <form @submit.prevent="submit()">
      <button class="btn btn-primary confirmbtn" type="submit" >确认</button>
    </form> -->
    </div>
 

    <div class="safety">安全</div>
    <button class="btn btn-primary safetybtn">更改密码</button>
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
