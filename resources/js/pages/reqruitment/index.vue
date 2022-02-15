<template>
  <v-datatable :title="title" :allow-filter="false" :filters="datatable.filters" :data="datatable.data" :columns="datatable.columns">
    <template #attributes>
      <app-link href="/reqruitment/create" class="btn-red">
        Tambah Penerimaan
      </app-link>
    </template>

    <template #description="{ item: { description } }">
      <v-not-available :value="description" />
    </template>

    <template #action="{ item }">
      <div class="flex space-x-2">
        <app-link :href="`/reqruitment/${item.id}/users`" class="bg-purple-500 p-2 rounded-md focus:ring-2 focus:ring-purple-500 focus:outline-none focus:ring-offset-2">
          <icon name="UserGroupIcon" class="w-3 h-3 text-white" />
        </app-link>
        <app-link :href="`/reqruitment/${item.id}`" class="bg-blue-500 p-2 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-offset-2">
          <icon name="EyeIcon" type="solid" class="w-3 h-3 text-white" />
        </app-link>
        <app-link :href="`/reqruitment/${item.id}/edit`" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2">
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </app-link>
        <button @click.prevent="destroy(item.id)" type="button" class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2">
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
      deleteId: null,
      deleteLoading: false,
    }
  },
  methods: {
    destroy(id) {
      this.$dialog.show({
        message: 'Ini akan menghapus penerimaan secara permanen',
        onConfirm: () => {
          this.$inertia.delete(`/reqruitment/${this.deleteId}`, {
            onSuccess: () => {
              this.$toast.success('Berhasil menghapus penerimaan');
              this.$dialog.hide();
            }
          });
        }
      })
    }
  }
}
</script>

<style>

</style>