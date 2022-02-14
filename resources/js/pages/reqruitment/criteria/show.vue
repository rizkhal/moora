<template>
  <v-datatable :title="title" :allow-filter="false" :filters="datatable.filters" :data="datatable.data" :columns="datatable.columns">
    <template #description="{ item: { description } }">
      <v-not-available :value="description" />
    </template>

    <template #action="{ item: { id } }">
      <div class="flex space-x-2">
        <button @click.prevent="edit(id)" type="button" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2">
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
        <button @click.prevent="modalDelete(id)" type="button" class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2">
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </v-datatable>

  <v-modal ref="modalDelete">
    <template #content>
      <div class="p-5 text-center">
        <div class="rounded-full bg-red-200 flex items-center justify-center w-24 h-24 flex-shrink-0 mx-auto">
          <icon name="TrashIcon" type="solid" class="w-16 h-16 text-red-500" />
        </div>
        <div class="text-3xl mt-5">Apakah anda yakin?</div>
        <div class="text-gray-600 mt-2 leading-7">Tindakan ini akan menghapus penerima secara permanen.</div>
      </div>
      <div class="p-5 flex justify-center space-x-2 mt-4">
        <button type="button" class="btn-close" @click="$refs.modalDelete.closeModal()">Tutup</button>
        <loading-button :loading="deleteLoading" @click="destroy" class="btn-red" as="button" type="button">Hapus</loading-button>
      </div>
    </template>
  </v-modal>

  <v-modal ref="modalEdit">
    <template #content>
      <button>Click</button>
    </template>
  </v-modal>
</template>

<script>
export default {
  props: {
    title: String,
    datatable: Object,
  },
  data() {
    return {
      modelId: null,
      deleteLoading: false,
    }
  },
  methods: {
    edit(id) {
      this.modelId = id;
      this.$refs.modalEdit.openModal();
    },
    modalDelete(id) {
      this.modelId = id;
      this.$refs.modalDelete.openModal()
    },
    destroy() {
      this.$inertia.delete(`/reqruitment/${this.modelId}`, {
        onSuccess: () => {
          this.$toast.success('Berhasil menghapus penerimaan');
          this.$refs.modalDelete.closeModal();
        }
      })
    }
  }
}
</script>

<style>

</style>