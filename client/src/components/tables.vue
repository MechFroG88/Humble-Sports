<template>
  <div id="_table">
    <table
      :style="`width:${parseInt(width)}%;`"
      :class="{
      'striped': striped,
      'hoverable': hoverable,
      'loading loading-lg': isLoading
    }">
      <tr class="title" v-if="title || navbar" :class="navbar ? 'navbar_title' : ''">
        <td align="justify" :colspan="columns.length">
          <span class="title_name">
            <slot name="title" v-if="title" />
          </span>
          <div class="input-group input-inline has-icon-right" v-if="navbar">
            <input class="form-input" type="text" :placeholder="navbar">
            <i class="form-icon icon icon-search"></i>
          </div>
        </td>
      </tr>

      <tr class="table_columns">
        <td
          v-for="column in columns"
          :key="column.name"
          :class="`col_${column.field}`"
        >{{column.name}}</td>
      </tr>

      <tr v-for="(row, row_num) in tableData" :key="row_num" :class="`row row_${row_num}`">
        <td v-for="column in columns" :key="column.field" :class="`col_${column.field}`">
          <slot
            :name="column.field"
            :data="row">
            <template>
              {{row[column.field]}}
            </template>
          </slot>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    columns: Array,
    tableData: Array,
    width: {
      type: [Number, String],
      default: 100
    },
    striped: Boolean,
    hoverable: Boolean,
    title: Boolean,
    navbar: String
  },
  data: () => ({
    isLoading: true
  })
};
</script>

<style>

</style>