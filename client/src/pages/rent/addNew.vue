<template>
  <div id="_addNew">
    <div class="modal-header">
      <router-link :to="$route.params.state === 'personal' ? {'name': 'personal'} : {'name': 'group'}" tag="div" class="link float-right c-hand">
        <i class="icon icon-x"></i>
      </router-link>
      <div class="modal-title h2">新增租借记录</div>
    </div>
    <div class="modal-body">
      <div class="content">
        <form class="form-horizontal">
          <div class="group h5 mb-2" v-if="$route.params.state === 'group'">团体资料</div>
          <div class="form-group" v-if="$route.params.state === 'group'">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="group_name">名称：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="group_name" placeholder="名称">
            </div>
          </div>
          <div class="info h5 mb-2">
            {{$route.params.state === 'personal' ? '学生资料' : '负责人资料'}}
          </div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="number">学号：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="number" placeholder="学号">
            </div>
          </div>
          <div class="form-group" v-if="$route.params.state === 'group'">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="phonenum">联络号码：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="phonenum" placeholder="联络号码">
            </div>
          </div>
          <div class="item h5 mb-2">器材管理</div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="type">种类：</label>
            </div>
            <div class="col-10 col-sm-12">
              <select class="form-select" name="type" id="type">
                <option value="basketball">篮球</option>
                <option value="football">足球</option>
                <option value="volleyball">排球</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="serial">编号：</label>
            </div>
            <div class="col-10 col-sm-12">
              <select class="form-select" name="serial" id="serial">
                <option value="1">B-001</option>
                <option value="2">B-002</option>
                <option value="3">B-003</option>
              </select>
            </div>
          </div>
          <div class="time h5 mb-2">时间</div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="expired">逾期时间：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="datetime-local" name="expired" id="expired">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <div class="btn btn-lg btn-primary">借出</div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    // console.log(this.$route.params.state)
  }
}
</script>

<style>

</style>
