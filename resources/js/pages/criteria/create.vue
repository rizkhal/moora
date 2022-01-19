<template>
  <app-head title="Tambah Kriteria" />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-md border">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />

      <span>Jenis Input</span>
      <div class="flex items-center space-x-4">
        <radio-input :error="form.input_type" @input="form.input_type = $event.target.value" class="-mt-4" v-for="(type, index) in types" :key="index" :label="index" :value="type" />
      </div>

      <type-text v-if="form.input_type == types.text" :form="form" :weights="weightTypes" />
      <type-option v-if="form.input_type == types.option" :form="form" :weights="weightTypes" />
      <type-file v-if="form.input_type == types.file" :form="form" :weights="weightTypes" />

      <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
      <loading-button @click.prevent="store" :loading="form.processing" class="btn-red ml-auto" type="button">Simpan</loading-button>
    </div>
  </div>
</template>
<script>
import typeFile from "./input/type-file.vue";
import typeText from "./input/type-text.vue";
import typeOption from "./input/type-option.vue";

export default {
  components: {
    typeFile,
    typeText,
    typeOption,
  },
  props: {
    weightTypes: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        input_type: null,
        description: null,
        allow_file_upload: false,
        options: [],
        texts: {
          value: null,
          value_type: null,
        },
        files: {
          value: null,
          value_type: null,
        },
      }),
      types: {
        text: 1,
        option: 2,
        file: 3,
      },
    };
  },
  methods: {
    store() {
      this.form.post("/criteria", {
        onSuccess: (success) => {
          this.form.reset();
        },
        onError: (error) => {
          console.log(error);
        },
      });
    },
  },
};
</script>