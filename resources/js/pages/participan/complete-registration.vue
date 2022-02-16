<template>
  <div v-if="auth.user.detail">
    <div class="flex flex-col items-center justify-center">
      <icon name="BadgeCheckIcon" type="solid" class="w-32 h-32 text-green-400" />
      <p class="leading-snug max-w-md text-center mt-6">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dignissimos alias, maxime deleniti veritatis quos possimus, voluptatum officiis cum fuga aliquam iste aspernatur laudantium atque. Sed, esse
        tempore corporis illo, accusantium accusamus, cupiditate tenetur aperiam rerum ab non. Ipsa voluptatem ut voluptates deserunt tempora aut inventore, ratione repellendus beatae error laborum soluta
        officiis praesentium minima? Earum nostrum saepe mollitia dolore porro!
      </p>
    </div>
  </div>

  <div v-else>
    <div class="flex flex-col items-center justify-center mb-8">
      <img
        :alt="auth.user.name"
        class="w-64 rounded-md shadow border"
        @click.prevent="$refs.profilePicture.click()"
        :class="{ 'border-red-500': form.errors.picture }"
        :src="auth.user.detail && !selectedPicture ? this.$helper.appUrl + auth.user.detail.picture : selectedPicture ? selectedPicture : `${this.$helper.appUrl}img/sample.jpg`"
      />
      <input @input="pictureHandler($event.target.files[0])" accept="image/png,image/jpeg" ref="profilePicture" type="file" style="display: none" />
      <span v-if="form.progress"> {{ form.progress.percentage }}% </span>
      <div v-if="form.errors.picture" class="form-error">{{ form.errors.picture }}</div>
    </div>
    <form @submit.prevent="upload">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <h1 class="text-2xl font-bold underline underline-offset-4 decoration-4 decoration-red-500/60">Informasi Umum</h1>
          <p class="leading-normal mt-4">
            Harap masukan informasi umum anda sesuai dengan Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti natus perferendis velit hic nihil laborum similique saepe. Ut eligendi ratione
            deleniti nulla officiis, cumque praesentium natus animi fugit quas placeat?
          </p>
        </div>
        <div class="col-span-2">
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
          <h1 class="text-2xl font-bold underline underline-offset-4 decoration-4 decoration-red-500/60">Kriteria Kelulusan</h1>
          <p class="leading-normal mt-4">
            Harap masukan informasi umum anda sesuai dengan Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti natus perferendis velit hic nihil laborum similique saepe. Ut eligendi ratione
            deleniti nulla officiis, cumque praesentium natus animi fugit quas placeat?
          </p>
        </div>
        <div class="col-span-2">
          <div class="bg-white p-4 border rounded-md shadow-md">
            <div class="flex flex-col space-y-5">
              <div v-for="(criteria, index) in criterias" :key="index">
                <div>
                  <span>{{ criteria.name }}</span>
                  <div class="mt-3 flex flex-col space-y-4 border-2 border-dashed p-4">
                    <select-input v-model="form[criteria.input_name]" :error="form.errors[criteria.input_name]" label="Pilih Opsi">
                      <option :value="null" />
                      <option v-for="(detail, index) in criteria.details" :key="index" :value="detail.id">{{ detail.text }}</option>
                    </select-input>
                    <file-input
                      label="Pilih File"
                      accept="application/pdf"
                      v-if="criteria.allow_file_upload"
                      :error="form.errors[criteria.input_file_name]"
                      @input="form[criteria.input_file_name] = $event.target.files[0]"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <loading-button :loading="form.processing" class="mt-6 btn-red ml-auto" type="submit">
        <icon name="CloudUploadIcon" type="outline" class="w-4 h-4 mr-1" v-show="!form.processing" />
        <span>Lengkapi Berkas</span>
      </loading-button>
    </form>
  </div>
</template>
<script>
export default {
  props: {
    auth: Object,
    genders: Object,
    criterias: Object,
  },
  data() {
    return {
      selectedPicture: null,
      form: this.$inertia.form({
        name: this.auth.user.name,
        email: this.auth.user.email,
        nik: this.auth.user.detail?.nik,
        phone: this.auth.user.detail?.phone,
        gender: this.auth.user.detail?.gender,
        picture: null,
        ...this.criterias.reduce((acc, elem) => {
          acc[elem.input_name] = null;
          acc[`${elem.input_name}_file`] = null;
          return acc;
        }, {}),
      }),
    };
  },
  methods: {
    pictureHandler(file) {
      this.form.picture = file;

      let reader = new FileReader();
      reader.onload = (e) => (this.selectedPicture = e.target.result);
      reader.readAsDataURL(file);
    },
    upload() {
      this.form.post("/participan/complete-registration");
    },
  },
};
</script>