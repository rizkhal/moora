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
          <loading-button :loading="emailEnv.processing" class="btn-red" type="submit">Save</loading-button>
        </form>
      </div>
    </div>
    <div>
      <div class="bg-white rounded-md shadow-md border p-4">
        <h1 class="text-xl font-bold">Penerimaan</h1>
        <form @submit.prevent="saveReqruitment" class="flex flex-col space-y-4 mt-8">
          <text-input v-model="reqEnv.pas_min" :error="reqEnv.errors.pas_min" label="Nilai Minimum Kelulusan" type="number" />
          <select-input v-model="reqEnv.status" :error="reqEnv.errors.status" label="Status">
            <option :value="null" />
            <option v-for="(name, value) in status" :key="value" :value="value">{{ name }}</option>
          </select-input>
          <loading-button :loading="emailEnv.processing" class="btn-red" type="submit">Save</loading-button>
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
    reqruitment: Object,
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
      reqEnv: this.$inertia.form({
        id: this.reqruitment.id,
        pas_min: this.reqruitment.pas_min,
        status: this.reqruitment.req_status,
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
    saveReqruitment() {
      // wip..
    },
  },
};
</script>