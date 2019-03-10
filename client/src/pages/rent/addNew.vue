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
              <label class="form-label" for="phone_no">联络号码：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" placeholder="联络号码"
              type="text" id="phone_no" v-model="data.phone_no">
            </div>
          </div>
          <div class="item h5 mb-2">器材管理</div>
          <div class="form-group">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="item_id">种类：</label>
            </div>
            <div class="col-10 col-sm-12">
              <select class="form-select" name="item_id" id="item_id" 
              v-model="selected_item">
                <option v-for="item in items" :key="item.id"
                :value="item">{{ item.type }}</option>
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
                <option v-for="index in id_range"
                :key="index">{{ index }}</option>
              </select>
            </div>
          </div>
          <div class="form-group" v-if="$route.params.state === 'group'">
            <div class="col-2 col-sm-12">
              <label class="form-label" for="amount">数量：</label>
            </div>
            <div class="col-10 col-sm-12">
              <input class="form-input" placeholder="数量"
              type="number" id="amount" v-model="data.amount">
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
      <div class="btn btn-lg btn-primary" :class="{'loading': is_loading}"
      @click="createRent">借出</div>
    </div>
  </div>
</template>

<script>
import { postPersonalRent, postGroupRent } from '@/api/rental';
import { getItem } from '@/api/item';

export default {
  mounted() {
    getItem().then(({data}) => {
      this.items = data;
    })
  },
  data: () => ({
    date: '',
    is_loading: false,
    items: [],
    selected_item: {},
    id_range: 0,
    data: {
      amount: '',
      group_name: '',
      student_id: null,
      phone_no: '',
      item_id: '',
      item_tag: '',
      due_date: '',
    }
  }),
  methods: {
    createRent() {
      this.is_loading = true;

      this.data.due_date = this.date.replace('T', ' ').concat(':00');
      this.data.item_id  = this.selected_item.id;
      
      if (this.$route.params.state === 'personal') {
        postPersonalRent(this.data).then((msg) => {
          this.is_loading = false;
          this.$router.push(`/rent/${this.$route.params.state}`)
        }).catch((err) => {
          this.is_loading = false;
          console.log(err);
        });
      } else if (this.$route.params.state === 'group') {
        postGroupRent(this.data).then((msg) => {
          this.is_loading = false;
          this.$router.push(`/rent/${this.$route.params.state}`)
        }).catch((err) => {
          this.is_loading = false;
          console.log(err);
        });
      }
    },
  },
  watch: {
    selected_item: function(new_value) {
      this.id_range = new_value.end_id - new_value.start_id + 1;
    }
  }
};
</script>

<style>

</style>
