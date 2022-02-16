<template>
  <app-head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-red-500">
    <div class="w-full max-w-md">
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="register">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Pendaftaran</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="form.name" :error="form.errors.name" class="mt-10" label="Nama Lengkap" autofocus />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-6" label="Email" type="email" />
          <select-input v-model="form.reqruitment" label="Jenis Pendaftaran" class="mt-6">
            <option v-for="(reqruitment, index) in reqruitments" :key="index" :value="reqruitment.id">{{ reqruitment.name }}</option>
          </select-input>
          <text-input v-model="form.password" :error="form.errors.password" class="mt-6" label="Kata sandi" type="password" />
          <text-input v-model="form.passwordConfirmation" :error="form.errors.passwordConfirmation" class="mt-6" label="Konfirmasi kata sandi" type="password" />
        </div>
        <div class="flex items-center px-10 py-4 bg-gray-100 border-t border-gray-100">
          <app-link href="/login" class="text-sm text-red-500">Sudah punya akun?</app-link>
          <loading-button :loading="form.processing" class="btn-red ml-auto" type="submit">Daftar</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    reqruitments: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: 'peserta',
        email: 'peserta@mail.com',
        password: 'secret123',
        reqruitment: '1',
        passwordConfirmation: 'secret123',
      }),
    };
  },
  methods: {
    register() {
      this.form.post("/register");
    },
  },
};
</script>
