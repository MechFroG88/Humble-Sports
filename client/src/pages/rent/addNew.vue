<template>
  <div id="_addNew">
    <div class="modal-header">
      <router-link :to="{'name': 'personal'}" tag="div" class="float-right">
        <i class="icon icon-x"></i>
      </router-link>
      <div class="modal-title h2">新增租借记录</div>
    </div>
    <div class="modal-body">
      <div class="content">
        <div class="info h5 mb-2">
          {{$route.params.state === 'personal' ? '学生资料' : '负责人资料'}}
        </div>
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="number">学号：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="number" placeholder="学号">
            </div>
          </div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="phonenum">联络号码：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="text" id="phonenum" placeholder="联络号码">
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- <div class="modal-footer">
      ...
    </div> -->
  </div>
</template>

<script>
export default {
  mounted() {
    console.log(this.$route.params.state)
  }
}
</script>

<style>

</style>
