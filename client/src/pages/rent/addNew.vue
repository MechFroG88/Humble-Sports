<template>
  <div id="_addNew">
    <div class="modal-header">
      <router-link tag="div" class="link float-right c-hand" 
      :to="$route.params.state === 'personal' ? {'name': 'personal'} : {'name': 'group'}">
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
              <input class="form-input" placeholder="名称"
              type="text" id="group_name" v-model="data.group_name">
            </div>
          </div>
          <div class="info h5 mb-2">
            {{$route.params.state === 'personal' ? '学生资料' : '负责人资料'}}
          </div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="student_id">学号：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" placeholder="学号"
              type="number" id="student_id" v-model="data.student_id">
            </div>
          </div>
          <div class="form-group" v-if="$route.params.state === 'group'">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="phone">联络号码：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" placeholder="联络号码"
              type="text" id="phone" v-model="data.phone">
            </div>
          </div>
          <div class="item h5 mb-2">器材管理</div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="item_type">种类：</label>
            </div>
            <div class="col-10 col-sm-12">
              <select class="form-select" name="item_type" id="item_type" 
              v-model="data.item_type">
                <option value="basketball">篮球</option>
                <option value="football">足球</option>
                <option value="volleyball">排球</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="item_tag">编号：</label>
            </div>
            <div class="col-10 col-sm-12">
              <select class="form-select" name="item_tag" id="item_tag" 
              v-model="data.item_tag">
                <option value="1">B-001</option>
                <option value="2">B-002</option>
                <option value="3">B-003</option>
              </select>
            </div>
          </div>
          <div class="time h5 mb-2">时间</div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="due_date">逾期时间：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" type="datetime-local" 
              name="due_date" id="due_date" v-model="date">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <div class="btn btn-lg btn-primary" @click="createRent">借出</div>
    </div>
  </div>
</template>

<script>
import { postPersonalRent, postGroupRent } from '@/api/rental'
export default {
  data: () => ({
    date: '',
    data: {
      group_name: '',
      student_id: null,
      phone: '',
      item_type: '',
      item_tag: 0,
      due_date: '',
    }
  }),
  methods: {
    createRent() {
      this.data.due_date = this.date.replace('T', ' ').concat(':00');
      this.data.student_id = parseInt(this.data.student_id);
      this.data.item_tag = parseInt(this.data.item_tag);
      // console.log(this.data)
      if (this.$route.params.state === 'personal') {
        postPersonalRent(this.data).then((msg) => {
          console.log(msg);
        }).catch((err) => {
          console.log(err);
        });
      } else if (this.$route.params.state === 'group') {
        postGroupRent(this.data).then((msg => {
          console.log(msg);
        })).catch((err) => {
          console.log(err);
        });
      }
    }
  }
};
</script>

<style>

</style>
