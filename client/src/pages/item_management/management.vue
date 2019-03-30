<template>
  <div id="_management">
    <div class="btn btn-lg btn-primary addBtn"
    style="margin-bottom: 3.8rem;"
    @click="open">新增</div>
    <mg-table width="45" ref="table"
    :columns="columns" :tableData="data" title>
      <template slot="title">器材管理</template>
      <template slot="serialNumber" slot-scope="{ data }">
        {{data.start_id}} - {{data.end_id}}
      </template>

      <template slot="price" slot-scope="{ data }">
        RM{{data.price}}
      </template>

      <template slot="record" slot-scope="{ data }">
        <i class="icon icon-external-link c-hand" @click="$router.push({
            'name':'management_details',
            'params': {
              'id': data.id
            }
          })" ></i>
      </template>
      <template slot="action" slot-scope="{ data }" >
        <span class="btn btn-primary addBtn deleteBtn" @click="openModal(data.id)">删除</span>
        <span class="btn btn-primary addBtn editBtn" @click="openEditModal(data.id)">修改</span>
      </template>
    </mg-table>

    <div class="expired">
      <h5 style="font-weight: 400;">器材逾期</h5>
      <form class="form-horizontal" @submit.prevent="changeFine()">
        <div class="form-group">
          <div class="col-3 col-xl-4 col-sm-12">
            <label class="form-label" for="price">罚款金额：</label>
          </div>
          <div class="col-9 col-xl-8 col-sm-12">
            <div>
              <input class="form-input mr-2" :class="{'error-input': errors.first('罚款价钱')}"
              type="number" step="0.01" id="price" name="罚款价钱" ref="input"
              v-model="fine_price" v-validate="'required|decimal:2'">
              / 天
            </div>
            <p class="form-input-hint text-error">{{ errors.first('罚款价钱') }}</p>
          </div>
        </div>
        <div class="btn btn-lg btn-primary" type="submit" @click="changeFine()">储存</div>
      </form>
    </div>

    <cpModal class="imodal" ref="add" title="新增器材" closable>
      <div slot="body">
        <form class="form-horizontal" ref="form">
          <div class="item h5 mb-2">器材资料</div>
          <div class="form-group type">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="type">种类：</label>
            </div>
            <div class="col-9 col-sm-12">
              <div>
                <input class="form-input input-sm" :class="{'error-input': errors.first('器材种类')}"
                type="text" id="type" name="器材种类"
                v-model="item.type" v-validate="'required'" @keyup.enter="add">
              </div>
              <p class="form-input-hint text-error">{{errors.first('器材种类')}}</p>
            </div>
          </div>
          <div class="form-group serial">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="serial">编号：</label>
            </div>
            <div class="col-9 col-sm-12">
              <div>
                <input class="form-input input-sm mr-2" :class="{'error-input': errors.first('编号')}" 
                type="text" id="serial" name="编号"
                v-model="item.start_id" v-validate="'required|numeric'" @keyup.enter="add">
                至
                <input class="form-input input-sm ml-2" :class="{'error-input': errors.first('编号')}" 
                type="text" id="serial" name="编号"
                v-model="item.end_id" v-validate="'required|numeric'" @keyup.enter="add">
              </div>
              <p class="form-input-hint text-error">{{errors.first('编号')}}</p>
            </div>
          </div>
          <div class="form-group price">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="price">价钱：</label>
            </div>
            <div class="col-9 col-sm-12">
              <div>
                <input class="form-input input-sm" :class="{'error-input': errors.first('价钱')}" 
                type="number" id="price" name="价钱"
                v-model="item.price" v-validate="'required|decimal:2'" @keyup.enter="add">
              </div>
              <p class="form-input-hint text-error">{{errors.first('价钱')}}</p>
            </div>
          </div>
        </form>
      </div>
      <div slot="footer"
      class="btn btn-lg btn-primary" :class="{'loading': is_loading}"
      @click="add">新增</div>
    </cpModal>

    <editModal class="imodal" ref="edit" title="更改器材资料" closable>
      <div slot="body">
        <form class="form-horizontal" ref="form">
          <div class="item h5 mb-2">器材资料</div>
          <div class="form-group type">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="type">种类：</label>
            </div>
            <div class="col-9 col-sm-12">
              <div>
                <input class="form-input input-sm" :class="{'error-input': errors.first('器材种类')}"
                type="text" id="type" name="器材种类"
                v-model="item.type" v-validate="'required'" @keyup.enter="add">
              </div>
              <p class="form-input-hint text-error">{{errors.first('器材种类')}}</p>
            </div>
          </div>
          <div class="form-group serial">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="serial">编号：</label>
            </div>
            <div class="col-9 col-sm-12">
              <div>
                <input class="form-input input-sm mr-2" :class="{'error-input': errors.first('编号')}" 
                type="text" id="serial" name="编号"
                v-model="item.start_id" v-validate="'required|numeric'" @keyup.enter="add">
                至
                <input class="form-input input-sm ml-2" :class="{'error-input': errors.first('编号')}" 
                type="text" id="serial" name="编号"
                v-model="item.end_id" v-validate="'required|numeric'" @keyup.enter="add">
              </div>
              <p class="form-input-hint text-error">{{errors.first('编号')}}</p>
            </div>
          </div>
          <div class="form-group price">
            <div class="col-3 col-sm-12">
              <label class="form-label" for="price">价钱：</label>
            </div>
            <div class="col-9 col-sm-12">
              <div>
                <input class="form-input input-sm" :class="{'error-input': errors.first('价钱')}" 
                type="number" id="price" name="价钱"
                v-model="item.price" v-validate="'required|decimal:2'" @keyup.enter="editSingleItem(singleItemData.id,singleItemData.type,singleItemData.start_id,singleItemData.end_id,singleItemData.price)">
              </div>
              <p class="form-input-hint text-error">{{errors.first('价钱')}}</p>
            </div>
          </div>
        </form>
      </div>
      <div slot="footer"
      class="btn btn-lg btn-primary" :class="{'loading': is_loading}"
      @click="editSingleItem(singleItemData.id,singleItemData.type,singleItemData.start_id,singleItemData.end_id,singleItemData.price)">确认更改</div>
    </editModal>
  

    <cmodal class="confirmModal" ref="cancel" :trigger="removeItem"></cmodal>

  </div>
</template>

<script>
import { postFine, getFine} from '@/api/fine';
import { getItem, postItem, deleteItem, editItem, getSingleItem } from '@/api/item';

import mgTable from '@/components/tables';
import cpModal from '@/components/modal';
import editModal from '@/components/modal';
import cmodal from '@/components/confirm-modal';
import { management_column } from '@/api/tableColumns';

export default {
  components: {
    editModal,
    mgTable,
    cpModal,
    cmodal,
  },
  mounted() {
    this.getAll();
  },
  data: () => ({
    columns: management_column,
    data: [],
    singleItemData: [],
    fine_price: null,
    is_loading: false,
    add_loading: false,
    item: {
      type: '',
      start_id: '',
      end_id: '',
      price: ''
    },
    deleteId: '',
  }),
  methods: {
    getAll(){
      getFine().then(({ data }) =>{
      this.fine_price = data[0].fine;
      console.log(fine_price)
    })
      getItem().then(({ data }) => {
        this.data = data;
        this.$refs.table.is_loading = false;
      }).catch((err) => {
        console.log(err);
      })
    },
    changeFine() {
      this.add_loading = true;
      let fine = parseInt(this.fine_price).toFixed(2);
      postFine({ fine }).then((msg) => {
        this.notification(成功更改罚款金额, 'success');
        this.$nextTick(() => {
          this.$nextTick(() => {
            this.errors.clear();
          })
        });
        this.fine_price = null;
        this.add_loading = false;
      }).catch((err) => {
        this.notification('罚款金额更换失败！请重试！', 'error');
        this.add_loading = false;
        console.log(err)
      })
    },
    open() {
      this.item.type = '';
      this.item.start_id = '';
      this.item.end_id = '';
      this.item.price = '';
      this.errors.clear();
      this.$refs.form.reset();
      this.$refs.add.active = true;
    },
    add() {
      this.is_loading = true;
      this.item.price = parseInt(this.item.price).toFixed(2);
      postItem(this.item).then((msg) => {
        this.is_loading = false;
        this.$refs.add.active = false;
        for (let i of Object.keys(this.item)) {
          this.item[i] = '';
        }
        this.$refs.table.is_loading = true;
        getItem().then(({ data }) => {
          this.data = data;
          this.$refs.table.is_loading = false;
        })
      }).catch((err) => {
        console.log(err);
        this.$refs.add.active = false;
      })
    },
    openModal(id) {
      this.deleteId = id;
      this.$refs.cancel.active = true;
    },
    removeItem(){
      deleteItem(this.deleteId).then((msg) => {
        this.$refs.cancel.active = false;
        this.getAll();
        this.notification('成功删除器材', 'success');
      }).catch((err) => {
        this.notification('操作失败！请重试！', 'error');
        console.log(err);
      })
    },
    
    editSingleItem(id,type,start_id,end_id,price) {
      editItem(id,{
        type: this.item.type,
        start_id: this.item.start_id,
        end_id: this.item.end_id,
        price: this.item.price,
        }).then((msg) => {
          console.log(this.item.price);
          this.$refs.edit.active = false;
          this.notification('成功更改器材资料', 'success');
          this.getAll();
      }).catch((err) => {
        this.notification('更改器材资料失败！请重试！', 'error');
        console.log(err);
      })
    },
    openEditModal(id){
      this.$refs.edit.active = true;
      getSingleItem(id).then(({ data }) => {
        this.singleItemData = data;
        this.item.type = data.type;
        this.item.start_id = data.start_id;
        this.item.end_id = data.end_id;
        this.item.price = data.price;
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
