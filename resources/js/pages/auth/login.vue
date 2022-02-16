<template>
  <app-head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-red-500">
    <div class="w-full max-w-md">
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="login">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Masuk</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="form.email" :error="form.errors.email" class="mt-10" label="Email" type="email" autofocus autocapitalize="off" />
          <text-input v-model="form.password" :error="form.errors.password" class="mt-6" label="Kata sandi" type="password" />
          <label class="flex items-center mt-6 select-none" for="remember">
            <input id="remember" v-model="form.remember" class="mr-[12px]" type="checkbox" />
            <span class="text-sm">Ingar saya?</span>
          </label>
        </div>
        <div class="flex items-center px-10 py-4 bg-gray-100 border-t border-gray-100">
          <app-link href="/register" class="text-sm text-red-500">Belum punya akun?</app-link>
          <loading-button :loading="form.processing" class="btn-red ml-auto" type="submit">Masuk</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        email: "admin@mail.com",
        password: "secret123",
        remember: false,
      }),
    };
  },
  methods: {
    login() {
      this.form.post("/login");
    },
  },
};
</script>
