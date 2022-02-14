<template>
  <v-datatable :title="title" :allow-filter="false" :filters="datatable.filters" :data="datatable.data" :columns="datatable.columns">
    <template #attributes>
      <app-link href="/setting/role/create" class="btn-red">Tambah Role</app-link>
      <app-link href="/setting/permission" class="btn-red">Lihat Permission</app-link>
    </template>

    <template #description="{ item: { description } }">
      <v-not-available :value="description" />
    </template>

     <template #action="{ item }">
      <div class="flex space-x-2">
        <app-link
          as="button"
          type="button"
          :disabled="checkRole(item.name)"
          :href="`/setting/role/${item.id}`"
          :class="{ 'opacity-40 cursor-not-allowed': checkRole(item.name) }"
          class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2"
        >
          <icon name="EyeIcon" type="solid" class="w-3 h-3 text-white" />
        </app-link>
        <button
          type="button"
          :disabled="checkRole(item.name)"
          @click="$refs.delete.openModal(item)"
          :class="{ 'opacity-40 cursor-not-allowed': checkRole(item.name) }"
          class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2"
        >
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </v-datatable>
</template>
<script>
export default {
  props: {
    title: String,
    datatable: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: null,
      }),
    };
  },
  methods: {
    checkRole(role) {
      return ["admin", "peserta"].includes(role.toLowerCase());
    },
    destroy(id) {
      this.form.delete(`/setting/role/${id}`, {
        onSuccess: (event) => {
          this.$refs.delete.closeModal();
        },
      });
    },
  },
};
</script>