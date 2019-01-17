<template>
  <div id="_table">
    <table
      :style="`width:${width};`"
      :class="{
      'striped': striped,
      'hoverable': hoverable
    }">
      <tr class="title" v-if="title" :class="navbar ? 'navbar_title' : ''">
        <td align="justify" :colspan="columns.length">
          <span class="title_name">
            <slot name="title"/>
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

      <tr v-for="(row, row_num) in data" :key="row_num" :class="`row row_${row_num}`">
        <td v-for="index in columns.length" :key="index" :class="`col_${columns[index-1].field}`">
          {{row[columns[index-1].field]}}
          <slot
            :name="columns[index-1].field"
            v-if="!row[columns[index-1].field] && row[columns[index-1].field] != ''"
          />
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    columns: Array,
    data: Array,
    width: String,
    striped: Boolean,
    hoverable: Boolean,
    title: Boolean,
    navbar: String
  }
};
</script>

<style>

</style>