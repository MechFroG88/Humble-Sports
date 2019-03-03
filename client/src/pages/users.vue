<template>
  <div id="_users">
    <div class="btn btn-lg btn-primary addBtn"
    style="margin-bottom: 3.8rem;"
    @click="$refs.add.active = true">新增</div>

    <userTable title ref="table" :columns="users" :tableData="data" width="40">
      <template slot="title">用户管理</template>
      <template slot="type" slot-scope="{ data }" class="form-group">
        <select class="form-select" v-model="data.type" @change="update(data.id)">
          <option selected disabled>请选择权限</option>
          <option :value="0">管理员</option>
          <option :value="1">使用者</option>
        </select>
      </template>
      <template slot="action" class="btn btn-primary addBtn">
        <div class="btn btn-primary addBtn" @click="openCmodal()">删除</div>
      </template>
    </userTable>

    <cmodal ref="cancel" :trigger="removeUser"></cmodal>
  </div>
</template>

<script>
import { getAllUsers } from '@/api/user';

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
    data: [],
  }),
  mounted() {
    console.log(this.$refs.cancel);
    getAllUsers().then(({ data }) => {
      this.data = data;
      this.$refs.table.isLoading = false;
    }).catch((err) => {
      console.log(err);
    });
  },
  methods: {
    update(id) {
      console.log(id);
    },
    openCmodal() {
      this.$refs.cancel.active = true;
    },
    removeUser() {
      console.log("hey");
    }
  },
};
</script>

<style>

</style>
