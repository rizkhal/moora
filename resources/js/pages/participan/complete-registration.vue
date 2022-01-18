<template>
  <div class="flex flex-col items-center justify-center mb-8">
    <img
      :alt="auth.user.name"
      class="w-64 rounded-md shadow border"
      @click.prevent="$refs.profilePicture.click()"
      :class="{ 'border-red-500': form.errors.profile_picture }"
      :src="auth.user.detail ? auth.user.detail.profile_picture : defaultPicture"
    />
    <input @input="profilePictureHandler($event.target.files[0])" accept="image/png,image/jpeg" ref="profilePicture" type="file" style="display: none" />
    <span v-if="form.progress"> {{ form.progress.percentage }}% </span>
    <div v-if="form.errors.profile_picture" class="form-error">{{ form.errors.profile_picture }}</div>
  </div>
  <form @submit.prevent="upload">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <div class="bg-white p-6 border rounded-md shadow-md">
          <div class="flex flex-col space-y-6">
            <text-input v-model="form.name" :error="form.errors.name" label="Nama Lengkap" disabled />
            <text-input v-model="form.email" :error="form.errors.email" label="Email" disabled />
            <text-input v-model="form.nik" :error="form.errors.nik" type="number" label="Nik" />
            <text-input v-model="form.phone" :error="form.errors.phone" type="number" label="Nomor HP" />
            <select-input v-model="form.gender" :error="form.errors.gender" label="Jenis Kelamin">
              <option :value="null" />
              <option v-for="(gender, index) in genders" :key="index" :value="index">{{ gender }}</option>
            </select-input>
          </div>
        </div>
      </div>
      <div>
        <div class="bg-white p-4 border rounded-md shadow-md">
          <div class="flex flex-col space-y-5">
            <file-input label="Kartu tanda penduduk" @input="form.ktp = $event.target.files[0]" :error="form.errors.ktp" accept="application/pdf" />
            <file-input label="Kartu keluarga" @input="form.kk = $event.target.files[0]" :error="form.errors.kk" accept="application/pdf" />
            <file-input label="Surat keterangan dokter" @input="form.skd = $event.target.files[0]" :error="form.errors.skd" accept="application/pdf" />
            <file-input label="Kartu pernyataan" @input="form.sp = $event.target.files[0]" :error="form.errors.sp" accept="application/pdf" />
            <file-input label="Surat kelakuan baik" @input="form.skck = $event.target.files[0]" :error="form.errors.skck" accept="application/pdf" />
          </div>
        </div>
      </div>
    </div>
    <loading-button :loading="form.loading" class="mt-6 btn-red ml-auto" type="submit">Upload</loading-button>
  </form>
</template>
<script>
export default {
  props: {
    auth: Object,
    genders: Object,
  },
  data() {
    return {
      defaultPicture: "../img/sample.jpg",
      form: this.$inertia.form({
        name: this.auth.user.name,
        email: this.auth.user.email,
        nik: this.auth.user.detail?.nik,
        phone: this.auth.user.detail?.phone,
        gender: this.auth.user.detail?.gender,
        profile_picture: null,
        ktp: null,
        kk: null,
        skd: null,
        sp: null,
        skck: null,
      }),
    };
  },
  methods: {
    profilePictureHandler(file) {
      this.form.profile_picture = file;

      let reader = new FileReader();
      reader.onload = (e) => (this.defaultPicture = e.target.result);
      reader.readAsDataURL(file);
    },
    upload() {
      this.form.post("/participan/complete-registration");
    },
  },
};
</script>