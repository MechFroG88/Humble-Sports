<template>
  <div id="_addNew">
    <div class="modal-header">
      <router-link tag="div" class="link float-right c-hand" 
      :to="$route.params.state === 'personal' ? {'name': 'personal'} : {'name': 'group'}">
        <i class="icon icon-x"></i>
      </router-link>
      <div class="modal-title h2">新增租借记录</div>
    </div>
    <form @submit.prevent="createRent">
      <div class="modal-body">
        <div class="content">
          <div class="form-horizontal">
            <div class="group h5 mb-2" v-if="$route.params.state === 'group'">团体资料</div>
            <div class="form-group" v-if="$route.params.state === 'group'">
              <div class="col-2 col-sm-12">
                <label class="form-label" for="group_name">名称：</label>
              </div>
              <div class="col-10 col-sm-12">
                <input class="form-input" :class="{'error-input': errors.first('团体名称')}" placeholder="名称"
                type="text" id="group_name" name="团体名称" v-model="data.group_name" v-validate="'required'">
                <p class="form-input-hint text-error">{{ errors.first('团体名称') }}</p>
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
                <input class="form-input" :class="{'error-input': errors.first('学号')}" placeholder="学号"
                type="text" id="student_id" name="学号" v-model="data.student_id" v-validate="'required|digits:6'">
                <p class="form-input-hint text-error">{{ errors.first('学号') }}</p>
              </div>
            </div>
            <div class="form-group" v-if="$route.params.state === 'group'">
              <div class="col-2 col-sm-12">
                <label class="form-label" for="phone_no">联络号码：</label>
              </div>
              <div class="col-10 col-sm-12">
                <input class="form-input" :class="{'error-input': errors.first('联络号码')}" placeholder="联络号码"
                type="text" id="phone_no" name="联络号码" v-model="data.phone_no" v-validate="{
                  'required': true,
                  'regex': /^(\+6)?0(1(1|5)-?\d{8}|1[02-46-9]-?\d{7}|[2-79]-?\d{8}|8[0-9]-?\d{6})$/
                }">
                <p class="form-input-hint text-error">{{ errors.first('联络号码') }}</p>
              </div>
            </div>
            <div class="item h5 mb-2">器材管理</div>
            <div class="form-group">
              <div class="col-2 col-sm-12">
                <label class="form-label" for="item_id">种类：</label>
              </div>
              <div class="col-10 col-sm-12">
                <select class="form-select" :class="{'error-input': errors.first('器材种类')}" 
                name="器材种类" id="item_id" v-model="selected_item" v-validate="'required'">
                  <option v-for="item in items" :key="item.id"
                  :value="item">{{ item.type }}</option>
                </select>
                <p class="form-input-hint text-error">{{ errors.first('器材种类') }}</p>
              </div>
            </div>
            <div class="form-group">
              <div class="col-2 col-sm-12">
                <label class="form-label" for="item_tag">编号：</label>
              </div>
              <div class="col-10 col-sm-12">
                <select class="form-select" :class="{'error-input': errors.first('编号')}"
                name="编号" id="item_tag" v-model="data.item_tag" v-validate="'required'">
                  <option v-for="index in id_range"
                  :key="index" :value="index">{{ index }}</option>
                </select>
                <p class="form-input-hint text-error">{{ errors.first('编号') }}</p>
              </div>
            </div>
            <div class="form-group" v-if="$route.params.state === 'group'">
              <div class="col-2 col-sm-12">
                <label class="form-label" for="amount">数量：</label>
              </div>
              <div class="col-10 col-sm-12">
                <input class="form-input" :class="{'error-input': errors.first('数量')}" placeholder="数量"
                type="text" id="amount" name="数量" v-model="data.amount" v-validate="'required|numeric'">
                <p class="form-input-hint text-error">{{ errors.first('数量') }}</p>
              </div>
            </div>
            <div class="form-group">
              <label class="form-checkbox">
                <input type="checkbox" v-model="manual">
                <i class="form-icon"></i> 自行设定逾期时间
              </label>
            </div>
            <div v-if="$route.params.state === 'group' || manual">
              <div class="time h5 mb-2">时间</div>
              <div class="form-group">
                <div class="col-2 col-sm-12">
                  <label class="form-label" for="due_date">逾期时间：</label>
                </div>
                <div class="col-10 col-sm-12">
                  <datetime class="datetime" :class="{'error-input': errors.first('逾期时间')}"
                  name="due_date" id="due_date" type="datetime" v-model="date" v-validate="'required'"
                  :phrases="{ok: '确定', cancel: '取消'}"
                  value-zone="UTC+8"
                  auto
                  use12-hour />
                  <p class="form-input-hint text-error">{{ errors.first('逾期时间') }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-lg btn-primary" :class="{'loading': is_loading}" type="submit">借出</button>
      </div>
    </form>
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
    manual: false,
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

      this.data.due_date = this.date.slice(0, this.date.indexOf('.')).replace('T', ' ');
      this.data.item_id  = this.selected_item.id;
      
      if (this.$route.params.state === 'personal') {
        postPersonalRent(this.data).then((msg) => {
          this.is_loading = false;
          this.$router.push(`/rent/${this.$route.params.state}`)
        }).catch((err) => {
          this.notification('表格提交错误！请检查表格后再重试', 'error')
          this.is_loading = false;
          console.log(err);
        });
      } else if (this.$route.params.state === 'group') {
        postGroupRent(this.data).then((msg) => {
          this.is_loading = false;
          this.$router.push(`/rent/${this.$route.params.state}`)
        }).catch((err) => {
          this.notification('表格提交错误！请检查表格后再重试', 'error')
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
