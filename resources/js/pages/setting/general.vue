<template>
  <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
    <div>
      <div class="bg-white rounded-md shadow-md border p-4">
        <h1 class="text-xl font-bold">Email SMTP</h1>
        <form @submit.prevent="save" class="flex flex-col space-y-4 mt-8">
          <text-input v-model="form.host" :error="form.errors.host" label="Host" />
          <text-input v-model="form.port" :error="form.errors.port" label="Port" />
          <text-input v-model="form.username" :error="form.errors.username" label="Username" />
          <text-input v-model="form.password" :error="form.errors.password" label="Password" />
          <text-input v-model="form.encryption" :error="form.errors.encryption" label="Encryption" />
          <text-input v-model="form.from_address" :error="form.errors.from_address" label="From Address" />
          <text-input v-model="form.from_name" :error="form.errors.from_name" label="From Name" />
          <loading-button :loading="form.processing" class="btn-red" type="submit">Save</loading-button>
        </form>
      </div>
    </div>
    <div>
      <div class="bg-white rounded-md shadow-md border p-4">
        <h1 class="text-xl font-bold">Situs</h1>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    email: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: this.email.id,
        host: this.email.host,
        port: this.email.port,
        username: this.email.username,
        password: this.email.password,
        encryption: this.email.encryption,
        from_address: this.email.from_address,
        from_name: this.email.from_name,
      }),
    };
  },
  methods: {
    save() {
      this.form.post("/setting/general/email/smtp", {
        onError: (error) => {
          console.log(error);
        },
      });
    },
  },
};
</script>