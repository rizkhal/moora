<template>
  <app-head title="Participan" />

  <datatable :columns="columns" :data="data"></datatable>
</template>
<script>
import datatable from '@/components/table/datatable.vue'

export default {
  components: {
    datatable,
  },
  props: {
    data: Object,
    columns: Object,
  },
}
</script>