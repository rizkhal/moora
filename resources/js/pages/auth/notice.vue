<template>
  <app-head title="Verifikasi email" />

  <div class="flex items-center justify-center p-6 min-h-screen bg-red-500">
    <div class="w-full max-w-md">
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="register">
        <div class="px-10 py-12">
          <div class="flex items-center justify-center flex-col">
            <div class="p-4 bg-red-400 rounded-full">
              <icon name="MailIcon" type="solid" class="w-16 h-16 text-red-200" />
            </div>
            <h1 class="text-center text-3xl font-bold mt-4">Verifikasi Email</h1>
          </div>
          <div class="my-6 mx-auto w-24 border-b-2" />
          <p class="text-center leading-relaxed">
            Kami telah mengirim email berisi pesan verifikasi email ke akun <span class="font-bold">{{ auth.user.email }}</span
            >, silahkan verifikasi email anda terlebih dahulu.
          </p>
        </div>
        <div class="flex items-center px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button @click.prevent="sendNewEmail" :loading="form.processing" class="btn-red ml-auto" type="button">
            <span v-show="!form.processing">Kirim Email Baru</span>
            <span v-show="form.processing">Loading..</span>
          </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    auth: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        email: this.auth.email,
      }),
    };
  },
  methods: {
    sendNewEmail() {
      this.form.post("/verification/resend/email", {
        onSuccess: (success) => {
          console.log("dwdw");
        },
        onError: (error) => {
          console.log("eerrr");
        },
      });
    },
  },
};
</script>