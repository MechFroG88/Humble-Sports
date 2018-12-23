<template>
  <div id="_table">
    <table :style="`width:${width};`" :class="{
      'striped': striped,
      'hoverable': hoverable
    }">
      <tr class="title" v-if="title">
        <slot name="title"/>
      </tr>

      <tr class="table_columnns">
        <th v-for="column in columns" :key="column.name"
        :class="`col_${column.name}`">{{column.name}}</th>
      </tr>

      <tr v-for="(row, row_num) in data" :key="row_num">
        <td v-for="index in columns.length" :key="index"
        :class="`col_${field(index)}`">
          {{row[field(index)]}}
          <slot :name="field(index)" 
          v-if="!row[field(index)] && row[field(index)] != ''"/>
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
    title: Boolean
  },
  computed: {
    field(index) {
      return this.columns[index-1].field;
    }
  }
}
</script>

<style>

</style>
