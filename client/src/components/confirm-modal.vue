<template>
  <div id="_confirm_modal" class="modal" :class="{'active': active}">
    <a class="modal-overlay" aria-label="Close"
    @click="active = false"/>
    <div class="modal-container">
      <div class="modal-header">
        <div class="modal-title h3">{{title}}</div>
        <i class="icon icon-x-circle float-right close-button" @click="active = false"
        v-if="closable"/>
      </div>
      <div class="modal-body">
        此项操作将无法挽回。
      </div>
      <div class="modal-footer">
        <div class="button-group">
          <div class="btn btn-lg mr-2 cancel" @click="active = false">取消</div>
          <div class="btn btn-primary btn-lg confirm" @click="trigger()">确定</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    closable: {
      type: Boolean,
      default: true,
    },
    trigger: Function,
    title: String,
  },
  data: () => ({
    active: false,
  }),
};
</script>

<style>

</style>
