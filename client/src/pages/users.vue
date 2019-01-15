<template>
  <div id="_users">
    <div class="btn btn-lg btn-primary addBtn" 
    style="margin-bottom: 3.8rem;"
    @click="$refs.add.active = true">新增</div>

    <userTable title :columns="users" :data="data" width="40">
      <div slot="privilege" class="form-group">
        <select class="form-select">
          <option selected disabled>请选择权限</option>
          <option>管理员</option>
          <option>老师</option>
        </select>
      </div>
      <div slot="action" class="btn btn-primary addBtn" style="margin-bottom: 0; margin: 0 auto;">asdasdas</div>
    </userTable>
  </div>
</template>

<script>
import userTable from '@/components/tables'
import { users } from '@/api/tableColumns'
export default {
  components: {
    userTable
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
  })
}
</script>

<style>

</style>
