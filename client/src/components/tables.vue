<template>
  <div id="_table">
    <table :style="`width:${width};`" :class="{
      'striped': striped,
      'hoverable': hoverable
    }">
      <tr class="title" v-if="title" :class="navbar ? 'navbar_title' : ''">
        <td>
          <div class="title_name">
            <slot name="title"/>
          </div>
        </td>
        <td :colspan="columns.length - 2"></td>
        <td class="navbar">
          <div class="input-group input-inline has-icon-right" v-if="navbar">
            <input class="form-input" type="text" :placeholder="navbar">
            <i class="form-icon icon icon-search"></i>
          </div>
        </td>
      </tr>

      <tr class="table_columnns">
        <th v-for="column in columns" :key="column.name"
        :class="`col_${column.name}`">{{column.name}}</th>
      </tr>

      <tr v-for="(row, row_num) in data" :key="row_num">
        <td v-for="index in columns.length" :key="index"
        :class="`col_${columns[index-1].field}`">
          {{row[columns[index-1].field]}}
          <slot :name="columns[index-1].field" 
          v-if="!row[columns[index-1].field] && row[columns[index-1].field] != ''"/>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    title: String,
    columns: Array,
    data: Array,
    width: String,
    striped: Boolean,
    hoverable: Boolean,
    title: Boolean,
    navbar: String
  }
}
</script>

<style>

</style>
