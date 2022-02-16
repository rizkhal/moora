<template>
  <div class="flex items-center mb-4">
    <h2 class="text-2xl font-semibold">Daftar Peserta</h2>
  </div>

  <!-- <datatable :columns="columns" :data="data">
    <template #verified_at="{ item }">
      <not-available :value="item.verified_at" />
    </template>
    <template #action="{ item: { id } }">
      <div class="flex space-x-2">
        <app-link as="button" type="button" :href="`/participan/${id} `" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2">
          <icon name="EyeIcon" type="solid" class="w-3 h-3 text-white" />
        </app-link>
        <button type="button" @click="$refs.delete.openModal(id)" class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2">
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </datatable> -->

</template>
<script>
export default {
  components: {
    // 
  },
  props: {
    data: Object,
    columns: Object,
  },
};
</script>