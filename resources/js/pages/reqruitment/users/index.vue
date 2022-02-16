<template>
  <v-datatable :title="title" :allow-filter="false" :filters="datatable.filters" :data="datatable.data" :columns="datatable.columns">
    <template #attributes>
      <app-link :href="`/reqruitment/${reqruitment.id}/users/ranks`" class="btn-red">
        Lihat Penilaian
      </app-link>
    </template>
  </v-datatable>
</template>

<script>
export default {
  props: {
    title: String,
    datatable: Object,
    reqruitment: Object,
  },
  data() {
    return {
      deleteId: null,
      deleteLoading: false,
    }
  },
}
</script>

<style>

</style>