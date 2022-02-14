<template>
  <!-- <div class="flex justify-between items-center mb-4">
    <button class="btn-red" type="button" @click="$refs.form.openModal()">Tambah</button>

    <h2 class="text-2xl font-semibold">Pengguna</h2>
  </div>

  <datatable :columns="columns" :data="data">
    <template #verified_at="{ item }">
      <not-available :value="item.verified_at" />
    </template>
    <template #role="{ item }">
      {{ item.role.name }}
    </template>
    <template #action="{ item }">
      <div class="flex space-x-2">
        <button @click="$refs.form.openModal(item)" class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2" type="button">
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </button>

        <button @click="$refs.delete.openModal(item)" class="bg-red-500 p-2 rounded-md focus:ring-2 focus:ring-red-500 focus:outline-none focus:ring-offset-2" type="button">
          <icon name="TrashIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
      </div>
    </template>
  </datatable>

  <modal ref="form" @open="check($event)">
    <template #content>
      <form @submit.prevent="save" class="flex flex-col space-y-4">
        <text-input label="Name" v-model="form.name" :error="form.errors.name" />
        <text-input label="Email" type="email" v-model="form.email" :error="form.errors.email" />
        <select-input v-model="form.role" :error="form.errors.role" label="Role">
          <option :value="null" />
          <option v-for="(role, index) in roles" :key="index" :value="role.id">{{ role.name }}</option>
        </select-input>
        <text-input label="Password" type="password" v-model="form.password" :error="form.errors.password" />
        <text-input label="Password Confirmation" type="password" v-model="form.passwordConfirmation" :error="form.errors.passwordConfirmation" />
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
  </modal> -->

  <v-datatable :title="title" :allow-filter="false" :filters="datatable.filters" :data="datatable.data" :columns="datatable.columns">
    <template #action>
      <div class="flex space-x-2">
        <button
          type="button"
          class="bg-yellow-400 p-2 rounded-md focus:ring-2 focus:ring-yellow-400 focus:outline-none focus:ring-offset-2"
        >
          <icon name="PencilIcon" type="solid" class="w-3 h-3 text-white" />
        </button>
        <button
          type="button"
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
            this.form.reset();
            this.$refs.form.closeModal();
          },
        });
      }

      if (this.form.id !== null) {
        this.form.put(`/setting/user/${this.form.id}`, {
          onSuccess: (event) => {
            this.form.reset();
            this.$refs.form.closeModal();
          },
        });
      }
    },
    check(item) {
      if (typeof item === "undefined") {
        this.form.reset();
      } else {
        this.form.id = item.id;
        this.form.email = item.email;
        this.form.name = item.name;
        this.form.role = item.role.id;
      }
    },
    destroy(id) {
      this.form.delete(`/setting/user/${id}`, {
        onSuccess: (event) => {
          this.$refs.delete.closeModal();
        },
      });
    },
  },
};
</script>