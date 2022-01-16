<template>
  <app-head title="Pengguna" />

  <div class="flex justify-between items-center mb-4">
    <button class="btn-red" type="button" @click="$refs.form.openModal()">Tambah</button>

    <h2 class="text-2xl font-semibold">Hak Akses</h2>
  </div>

  <datatable :columns="columns" :data="data">
    <template #description="{ item }">
      <not-available :value="item.description" />
    </template>
    <template #action="{ item }">
      <div class="flex space-x-2">
        <button @click.prevent="$refs.form.openModal(item)" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2" type="button">
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
        <button @click.prevent="$refs.delete.openModal(item)" class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2" type="button">
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </datatable>

  <modal ref="form" @open="check($event)">
    <template #content>
      <form @submit.prevent="save" class="flex flex-col space-y-4">
        <text-input label="Nama" v-model="form.name" :error="form.errors.name" />
        <select-input v-model="form.type" :error="form.errors.type" label="Tipe">
          <option :value="null" />
          <option v-for="(type, index) in this.$helper.permissionTypes" :key="index" :value="++index">{{ type }}</option>
        </select-input>
        <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
      </form>
    </template>
    <template #button>
      <button type="button" class="btn-close" @click="$refs.form.closeModal()">Close</button>
      <loading-button :loading="form.processing" class="btn-red ml-auto" @click.prevent="save" type="button">
        {{ form.id ? "Update" : "Save" }}
      </loading-button>
    </template>
  </modal>

  <modal ref="delete">
    <template #content="{ data: { id } }">
      <modal-delete :loading="form.processing" @close="$refs.delete.closeModal()" @destroy="destroy(id)" />
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
    datatable,
    modalDelete,
    notAvailable,
  },
  props: {
    data: Object,
    columns: Object,
  },
  remember: "form",
  data() {
    return {
      form: this.$inertia.form({
        id: null,
        name: null,
        type: null,
        description: null,
      }),
    };
  },
  methods: {
    save() {
      if (this.form.id === null) {
        this.form.post(`/setting/permission`, {
          onSuccess: (event) => {
            this.form.reset();
            this.$refs.form.closeModal();
          },
        });
      }

      if (this.form.id !== null) {
        this.form.put(`/setting/permission/${this.form.id}`, {
          onSuccess: (event) => {
            this.form.reset();
            this.$refs.form.closeModal();
          },
        });
      }
    },
    destroy(id) {
      this.form.delete(`/setting/permission/${id}`, {
        onSuccess: (event) => {
          this.$refs.delete.closeModal();
        },
      });
    },
    check(item) {
      if (typeof item === "undefined") {
        this.form.reset();
      } else {
        let p = this.$helper.permissionTypes;

        this.form.id = item.id;
        this.form.name = item.name;
        this.form.type = p.indexOf(item.type) + 1;
        this.form.description = item.description;
      }
    },
  },
};
</script>