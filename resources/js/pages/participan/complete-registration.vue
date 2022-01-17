<template>
  <div class="flex justify-center mb-8">
    <img :src="auth.user.photo" :alt="auth.user.name" class="w-64 rounded-md" />
  </div>
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
          <div>
            <label for="ktp" class="form-label">Kartu Tanda Penduduk:</label>
            <input type="file" id="ktp" name="ktp" class="form-input" accept="application/pdf" />
          </div>
          <div>
            <label for="ktp" class="form-label">Kartu Keluarga:</label>
            <input type="file" id="ktp" name="ktp" class="form-input" accept="application/pdf" />
          </div>
          <div>
            <label for="ktp" class="form-label">Surat Keterangan Dokter:</label>
            <input type="file" id="ktp" name="ktp" class="form-input" accept="application/pdf" />
          </div>
          <div>
            <label for="ktp" class="form-label">Surat Pernyataan:</label>
            <input type="file" id="ktp" name="ktp" class="form-input" accept="application/pdf" />
          </div>
          <div>
            <label for="ktp" class="form-label">Surat Kelakuan Baik:</label>
            <input type="file" id="ktp" name="ktp" class="form-input" accept="application/pdf" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <loading-button :loading="false" class="mt-6 btn-red ml-auto" type="submit">Upload</loading-button>
</template>
<script>
export default {
  props: {
    auth: Object,
    user: Object,
    genders: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: this.user.name,
        email: this.user.email,
        nik: this.user.participan?.nik,
        phone: this.user.participan?.phone,
        gender: this.user.participan?.gender,
        birth_place: this.user.participan?.birth_place,
        birth_date: this.user.participan?.birth_date,
        religion: this.user.participan?.religion,
        province: this.user.participan?.province,
        city: this.user.participan?.city,
        district: this.user.participan?.district,
        sub_district: this.user.participan?.sub_district,
      }),
    };
  },
};
</script>