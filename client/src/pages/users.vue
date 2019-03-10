<template>
  <div id="_users">
    <div class="btn btn-lg btn-primary addBtn"
    style="margin-bottom: 3.8rem;"
    @click="$refs.add.active = true">新增</div>

    <userTable title ref="table" :columns="users" :tableData="data" width="40">
      <template slot="title">用户管理</template>
      <template slot="type" slot-scope="{ data }" class="form-group">
        <select class="form-select" v-model="data.type" @change="update(data.id, data.type)">
          <option selected disabled>请选择权限</option>
          <option :value="0">管理员</option>
          <option :value="1">使用者</option>
        </select>
      </template>
      <template slot="action" slot-scope="{ data }" class="btn btn-primary addBtn">
        <div class="btn btn-primary addBtn" @click="openCmodal(data.id)">删除</div>
      </template>
    </userTable>

    <modal ref="add" title="添加用户">
      <div slot="body">
        <div class="form-group">
          <label class="form-label" for="cn_name">名字</label>
          <input class="form-input" type="text" id="cn_name" 
          placeholder="中文名字" v-model="user.cn_name">
        </div>
        <div class="form-group">
          <label class="form-label" for="username">用户名</label>
          <input class="form-input" type="text" id="username" 
          placeholder="用户名" v-model="user.username">
        </div>
        <div class="form-group col-7">
          <label class="form-label" for="privilege">权限</label>
          <select class="form-select" name="privilege" v-model="user.type">
            <option disabled>请选择权限</option>
            <option :value="0">管理员</option>
            <option :value="1">使用者</option>
          </select>
        </div>
      </div>

      <div slot="footer">
        <div class="button-group">
          <div class="btn btn-lg mr-2 cancel" @click="$refs.add.active = false">取消</div>
          <div class="btn btn-primary btn-lg confirm" :class="{'loading loading-lg': loading}"
          @click="addUser">确定</div>
        </div>
      </div>
    </modal>

    <cmodal ref="cancel" :trigger="removeUser"></cmodal>
  </div>
</template>

<script>
import { getAllUsers, createUser, updateUserType, deleteUser } from '@/api/user';

import userTable from '@/components/tables';
import modal from '@/components/modal';
import cmodal from '@/components/confirm-modal';
import { users_column } from '@/api/tableColumns';

export default {
  components: {
    userTable,
    modal,
    cmodal,
  },
  data: () => ({
    users: users_column,
    loading: false,
    data: [],
    user: {
      username: '',
      cn_name: '',
      password: '',
      type: 0
    },
    deleteId: '',
  }),
  mounted() {
    this.getAll();
  },
  methods: {
    getAll() {
      getAllUsers().then(({ data }) => {
        this.data = data;
        this.$refs.table.is_loading = false;
      }).catch((err) => {
        this.notification('数据读取失败！请重试！', 'error');
        console.log(err);
      });
    },
    update(id, type) {
      updateUserType(id, {type: type}).then(() => {
        this.notification('成功更改资料', 'success');
      }).catch(() => {
        this.notification('您没有权限进行此项操作', 'error');
      });
    },
    addUser() {
      this.loading = true;
      this.user.password = this.user.username;
      createUser(this.user).then((msg) => {
        this.$refs.add.active = false;
        this.loading = false;
        this.notification('成功添加用户', 'success');
        this.getAll();
      }).catch((err) => {
        this.loading = false;
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      });
    },
    openCmodal(id) {
      this.deleteId = id;
      this.$refs.cancel.active = true;
    },
    removeUser() {
      deleteUser(this.deleteId).then((msg) => {
        this.$refs.cancel.active = false;
        this.notification('成功删除用户', 'success');
        this.getAll();
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    }
  },
};
</script>

<style>

</style>
