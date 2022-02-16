<template>
  <v-datatable :title="title" :allow-filter="false" :filters="datatable.filters" :data="datatable.data" :columns="datatable.columns" />
</template>
<script>
export default {
  props: {
    datatable: Object,
  },
};
</script>