<template>
  <app-head title="Pengguna" />

  <div class="flex justify-between items-center mb-4">
    <div class="flex space-x-2">
      <app-link href="/setting/role/create" class="btn-red">Tambah Role</app-link>
      <app-link href="/setting/permission" class="btn-red">Kelola Permission</app-link>
    </div>

    <h2 class="text-2xl font-semibold">Role</h2>
  </div>

  <datatable :number="true" :columns="columns" :data="data">
    <template #action="{ item }">
      <div class="flex space-x-2">
        <app-link :href="`/setting/role/${item.id}`" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2" as="button" type="button">
          <icon name="EyeIcon" type="solid" class="w-3 h-3 text-white" />
        </app-link>
        <button class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2" type="button">
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </datatable>
</template>
<script>
import datatable from "@/components/table/datatable.vue";

export default {
  components: {
    datatable,
  },
  props: {
    data: Object,
    columns: Object,
  },
};
</script>