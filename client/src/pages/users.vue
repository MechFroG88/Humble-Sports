<template>
  <div id="_users">
    <div class="btn btn-lg btn-primary addBtn" 
    style="margin-bottom: 3.8rem;"
    @click="$refs.add.active = true">新增</div>

    <userTable title :columns="users" :data="data" width="40">
      <div slot="title">用户管理</div>
      <div slot="privilege" class="form-group">
        <select class="form-select">
          <option selected disabled>请选择权限</option>
          <option>管理员</option>
          <option>老师</option>
        </select>
      </div>
      <div slot="action" class="btn btn-primary addBtn" @click="confirm">删除</div>
    </userTable>

    <modal ref="add" title="添加用户">
      <div slot="body">
        <div class="form-group">
          <label class="form-label" for="name">name</label>
          <input class="form-input" type="text" id="name" placeholder="Name">
        </div>
        <div class="form-group">
          <label class="form-label" for="input-example-1">Name</label>
          <input class="form-input" type="text" id="input-example-1" placeholder="Name">
        </div>
        <div class="form-group">
          <label class="form-label" for="input-example-1">Name</label>
          <input class="form-input" type="text" id="input-example-1" placeholder="Name">
        </div>
      </div>
    </modal>

    <cmodal ref="confirm_modal" title="确认删除用户">
    </cmodal>
  </div>
</template>

<script>
import userTable from '@/components/tables'
import modal from '@/components/modal'
import cmodal from '@/components/confirm-modal'
import { users } from '@/api/tableColumns'
export default {
  components: {
    userTable,
    modal,
    cmodal
  },
  data: () => ({
    users: users,
    data: [
      {
        name: '董顺忠'
      },
      {
        name: 'XXX'
      }
    ]
  }),
  methods: {
    confirm() {
      this.$refs.confirm_modal.active = true;
    }
  }
}
</script>

<style>

</style>
