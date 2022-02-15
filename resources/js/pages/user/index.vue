<template>
  <v-datatable :title="title" :allow-filter="false" :filters="datatable.filters" :data="datatable.data" :columns="datatable.columns">
    <template #attributes>
      <button class="btn-red" type="button" @click="$refs.form.openModal()">Tambah Pengguna</button>
    </template>
    
    <template #action="{ item }">
      <div class="flex space-x-2">
        <button
          type="button"
          @click.prevent="$refs.form.openModal(item)"
          class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2"
        >
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
        <button
          type="button"
          @click.prevent="destroy(item.id)"
          class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2"
        >
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </v-datatable>

  <v-modal ref="form" @open="edit($event)">
    <template #content>
      <div class="px-4 py-5 bg-gray-100 border-b">
        <h1>{{ form.id ? 'Ubah pengguna' : 'Tambah pengguna baru' }}</h1>
      </div>
      <form @submit.prevent="save" class="flex flex-col space-y-4 p-4">
        <text-input label="Name" v-model="form.name" :error="form.errors.name" />
        <text-input label="Email" type="email" v-model="form.email" :error="form.errors.email" />
        <select-input v-model="form.role" :error="form.errors.role" label="Role">
          <option :value="null" />
          <option v-for="(role, index) in roles" :key="index" :value="role.id">{{ role.name }}</option>
        </select-input>
        <text-input label="Password" type="password" v-model="form.password" :error="form.errors.password" />
        <text-input label="Password Confirmation" type="password" v-model="form.passwordConfirmation" :error="form.errors.passwordConfirmation" />
      </form>
      <div class="p-4 bg-gray-100 border-t flex flex-row justify-end space-x-2">
        <button type="button" class="btn-close" @click="$refs.form.closeModal()">Tutup</button>
        <loading-button :loading="form.processing" class="btn-red" @click.prevent="save" type="button">
          {{ form.id ? "Ubah" : "Simpan" }}
        </loading-button>
      </div>
    </template>
  </v-modal>
</template>
<script>
export default {
  props: {
    title: String,
    roles: Object,
    datatable: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: null,
        name: null,
        email: null,
        password: null,
        passwordConfirmation: null,
        role: null,
      }),
    };
  },
  methods: {
    save() {
      if (this.form.id === null) {
        this.form.post(`/setting/user`, {
          onSuccess: (event) => {
            this.$toast.success('Berhasil menambah pengguna');

            this.form.reset();
            this.$refs.form.closeModal();
          },
        });
      }

      if (this.form.id !== null) {
        this.form.put(`/setting/user/${this.form.id}`, {
          onSuccess: (event) => {
            this.$toast.success('Berhasil mengubah pengguna');

            this.form.reset();
            this.$refs.form.closeModal();
          },
        });
      }
    },
    edit(item) {
      if (typeof item === "undefined") {
        this.form.reset();
      } else {
        this.form.id = item.id;
        this.form.email = item.email;
        this.form.name = item.name;
        this.form.role = item.role_id;
      }
    },
    destroy(id) {
      this.$dialog.show({
        message: 'Ini akan menghapus pengguna secara permanen',
        onConfirm: () => {
            this.form.delete(`/setting/user/${id}`, {
            onSuccess: (event) => {
              this.$dialog.hide();

              this.$toast.success('Berhasil menghapus pengguna');
            },
          });
        }
      })
    },
  },
};
</script>