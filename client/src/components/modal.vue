<template>
  <div id="_modal" class="modal" :class="[
    active ? 'active' : ''
  ]">
    <a class="modal-overlay" aria-label="Close"
    @click="active = false"/>
    <div class="modal-container">
      <div class="modal-header">
        <div class="modal-title h3">{{title}}</div>
        <slot name="header" />
        <i class="icon icon-x-circle float-right close-button" @click="active = false"
        v-if="closable">
      </div>
      <div class="modal-body">
        <slot name="body" class="content"/>
      </div>
      <div class="modal-footer">
        <slot name="footer"/>
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
    title: String,
  },
  data: () => ({
    active: false,
  }),
};
</script>

<style>

</style>
