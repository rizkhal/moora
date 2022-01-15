<template>
  <app-head title="Pengguna" />

  <div class="flex justify-between items-center mb-4">
    <button class="btn-red" type="button" @click="$refs.modalForm.openModal()">Tambah</button>

    <h2 class="text-2xl font-semibold">Hak Akses</h2>
  </div>

  <datatable :columns="columns" :data="data">
    <template #action="{ item }">
      <div class="flex space-x-2">
        <button @click.prevent="$refs.modalForm.openModal(item)" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2" type="button">
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
        <button @click.prevent="$refs.modalDelete.openModal(item)" class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2" type="button">
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </datatable>

  <modal ref="modalForm" @open="check($event)">
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
      <button type="button" class="btn-close" @click="$refs.modalForm.closeModal()">Close</button>
      <loading-button :loading="form.processing" class="btn-red ml-auto" @click.prevent="save" type="button">
        {{ form.id ? 'Update' : 'Save' }}
      </loading-button>
    </template>
  </modal>

  <modal ref="modalDelete">
    <template #content>
      <div class="p-5 text-center">
        <div class="rounded-full bg-red-200 flex items-center justify-center w-24 h-24 flex-shrink-0 mx-auto">
          <icon name="TrashIcon" type="solid" class="w-16 h-16 text-red-500" />
        </div>
        <div class="text-3xl mt-5">Are you sure?</div>
        <div class="text-gray-600 mt-2 leading-7">Do you really want to delete these records? This process cannot be undone.</div>
      </div>
      <div class="flex justify-center space-x-2 mt-4">
        <button type="button" class="btn-close" @click="$refs.modalDelete.closeModal()">Close</button>
        <button type="button" class="btn-indigo">Delete</button>
      </div>
    </template>
  </modal>
</template>
<script>
import modal from '@/components/modal.vue'
import modalDelete from '@/components/modal-delete.vue'
import datatable from '@/components/table/datatable.vue'

export default {
  components: {
    modal,
    datatable,
    modalDelete,
  },
  props: {
    data: Object,
    columns: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        id: null,
        name: null,
        type: null,
        description: null,
      }),
    }
  },
  methods: {
    save() {
      if (this.form.id === null) {
        this.form.post(`/setting/permission`, {
          onSuccess: (event) => {
            this.form.reset()
            this.$refs.modalForm.closeModal()
          },
        })
      }

      if (this.form.id !== null) {
        this.form.put(`/setting/permission/${this.form.id}`, {
          onSuccess: (event) => {
            this.form.reset()
            this.$refs.modalForm.closeModal()
          },
        })
      }
    },
    check(item) {
      if (typeof item === 'undefined') {
        this.form.reset()
      } else {
        let p = this.$helper.permissionTypes

        this.form.id = item.id
        this.form.name = item.name
        this.form.type = p.indexOf(item.type) + 1
        this.form.description = item.description
      }
    },
  },
}
</script>