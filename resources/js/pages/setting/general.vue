<template>
  <app-head title="Pengaturan umum" />

  <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
    <div>
      <div class="bg-white rounded-md shadow-md border p-4">
        <h1 class="text-xl font-bold">Email SMTP</h1>
        <form @submit.prevent="saveEmail" class="flex flex-col space-y-4 mt-8">
          <text-input v-model="emailEnv.host" :error="emailEnv.errors.host" label="Host" />
          <text-input v-model="emailEnv.port" :error="emailEnv.errors.port" label="Port" />
          <text-input v-model="emailEnv.username" :error="emailEnv.errors.username" label="Username" />
          <text-input v-model="emailEnv.password" :error="emailEnv.errors.password" label="Password" />
          <text-input v-model="emailEnv.encryption" :error="emailEnv.errors.encryption" label="Encryption" />
          <text-input v-model="emailEnv.from_address" :error="emailEnv.errors.from_address" label="From Address" />
          <text-input v-model="emailEnv.from_name" :error="emailEnv.errors.from_name" label="From Name" />
          <loading-button :loading="emailEnv.processing" class="btn-red" type="submit">Simpan</loading-button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    email: Object,
    status: Object,
  },
  data() {
    return {
      emailEnv: this.$inertia.form({
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
    saveEmail() {
      this.emailEnv.post("/setting/general/email/smtp", {
        onError: (error) => {
          console.log(error);
        },
      });
    },
  },
};
</script>