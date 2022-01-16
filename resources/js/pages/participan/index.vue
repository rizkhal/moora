<template>
  <app-head title="Participan" />

  <datatable :columns="columns" :data="data">
    <template #verified_at="{ item }">
      <not-available :value="item.verified_at" />
    </template>
  </datatable>
</template>
<script>
import datatable from "@/components/table/datatable.vue";
import notAvailable from "@/components/table/not-available.vue";

export default {
  components: {
    datatable,
    notAvailable,
  },
  props: {
    data: Object,
    columns: Object,
  },
};
</script>