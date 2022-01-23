<template>
  <app-head title="Tambah Kriteria" />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-md border">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />
      <text-input label="Bobot" type="number" v-model="form.weight" :error="form.errors.weight" />
      <select-input class="w-full" v-model="form.weight_type" :error="form.errors.weight_type" label="Jenis">
        <option :value="null" />
        <option v-for="(type, value) in weightTypes" :key="value" :value="value">{{ type }}</option>
      </select-input>

      <div>
        <span>Pilihan:</span>
        <div class="flex flex-col space-y-4 p-4 border-dashed border mt-2 rounded-md">
          <div class="flex-none">
            <label class="inline-flex items-center">
              <input v-model="form.allow_file_upload" type="checkbox" class="form-checkbox h-5 w-5 text-red-600 border-gray-400 focus:outline-none focus:ring-0" />
              <span class="ml-2 text-gray-700">Izinkan upload file</span>
            </label>
          </div>
          <div v-for="(option, index) in form.options" :key="index" class="flex flex-col md:flex-row gap-4">
            <text-input class="w-full" label="Text" v-model="option.text" :error="form.errors[`options.${index}.text`]" />
            <text-input class="w-full" label="Bobot" type="number" v-model="option.weight" :error="form.errors[`options.${index}.weight`]" />
            <div class="flex-none">
              <button @click.prevent="remove(index)" :disabled="form.options.length === 1" class="disabled:opacity-75 disabled:cursor-not-allowed btn-red btn-ring md:w-12 w-full md:mt-6 py-3">
                <icon name="XIcon" type="solid" class="w-4" />
              </button>
            </div>
          </div>
          <div class="flex-none">
            <button @click.prevent="clone" class="btn-red btn-ring">Tambah</button>
          </div>
        </div>
      </div>

      <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
      <loading-button @click.prevent="store" :loading="form.processing" class="btn-red ml-auto" type="button">Simpan</loading-button>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    weightTypes: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        weight: null,
        weight_type: null,
        description: null,
        allow_file_upload: false,
        options: [],
      }),
    };
  },
  created() {
    this.clone();
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
    clone() {
      this.form.options.push({
        text: null,
        weight: null,
      });
    },
    remove(index) {
      this.form.options.splice(index, 1);
    },
  },
};
</script>