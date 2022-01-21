<template>
  <app-head title="Participan" />

  <div class="flex items-center mb-4">
    <h2 class="text-2xl font-semibold">Penilaian Peserta</h2>
  </div>

  <datatable :columns="columns" :data="data">
    <template #upload_file="{ item }">
      <div v-if="item.upload_file" class="flex items-center space-x-2">
        <icon name="CheckCircleIcon" type="solid" class="text-green-500 w-4 h-4" />
        <span>enabled</span>
      </div>
      <div v-else class="flex items-center space-x-2">
        <icon name="XCircleIcon" type="solid" class="text-red-500 w-4 h-4" />
        <span>disabled</span>
      </div>
    </template>
    <template #keterangan="{ item: { description } }">
      <not-available :value="description" />
    </template>
    <template #action="{ item: { id } }">
      <div class="flex space-x-2">
        <app-link as="button" type="button" :href="`/criteria/${id}/edit`" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2">
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </app-link>
        <button type="button" @click="$refs.delete.openModal(id)" class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2">
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </datatable>
  <modal ref="delete">
    <template #content="{ data }">
      <modal-delete :loading="form.processing" @close="$refs.delete.closeModal()" @destroy="destroy(data)" />
    </template>
  </modal>
</template>
<script>
import modal from "@/components/modal.vue";
import modalDelete from "@/components/modal-delete.vue";
import datatable from "@/components/table/datatable.vue";
import notAvailable from "@/components/table/not-available.vue";

export default {
  components: {
    modal,
    modalDelete,
    datatable,
    notAvailable,
  },
  props: {
    data: Object,
    columns: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: null,
      }),
    };
  },
  methods: {
    destroy(id) {
      this.form.delete(`/criteria/${id}`, {
        onSuccess: (event) => {
          this.$refs.delete.closeModal();
        },
      });
    },
  },
};
</script>