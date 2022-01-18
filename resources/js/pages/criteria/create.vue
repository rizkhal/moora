<template>
  <app-head title="Tambah Kriteria" />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-md border">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />

      <span>Jenis Input</span>
      <div class="flex items-center space-x-4">
        <radio-input :error="form.input_type" @input="form.input_type = $event.target.value" class="-mt-4" v-for="(type, index) in types" :key="index" :label="index" :value="type" />
      </div>

      <!-- text -->
      <div v-if="form.input_type == types.text">
        <div class="flex flex-col space-y-4">
          <div class="flex-none">
            <label class="inline-flex items-center">
              <input v-model="form.allow_file_upload" type="checkbox" class="form-checkbox h-5 w-5 text-red-600 border-gray-400 focus:outline-none focus:ring-0" />
              <span class="ml-2 text-gray-700">Izinkan upload file</span>
            </label>
          </div>
          <text-input label="Label" v-model="form.texts.label" :error="form.errors['texts.label']" />
          <text-input label="Bobot" type="number" v-model="form.texts.value" :error="form.errors['texts.value']" />
          <select-input v-model="form.texts.value_type" :error="form.errors['texts.value_type']" label="Jenis Kriteria">
            <option :value="null" />
            <option v-for="(type, value) in weightTypes" :key="value" :value="value">{{ type }}</option>
          </select-input>
        </div>
      </div>

      <!-- option -->
      <div v-if="form.input_type == types.option" class="flex flex-col space-y-4">
        <div class="flex-none">
          <label class="inline-flex items-center">
            <input v-model="form.allow_file_upload" type="checkbox" class="form-checkbox h-5 w-5 text-red-600 border-gray-400 focus:outline-none focus:ring-0" />
            <span class="ml-2 text-gray-700">Izinkan upload file</span>
          </label>
        </div>
        <text-input label="Label" v-model="form.options.label" :error="form.errors['options.label']" />
        <div v-for="(option, index) in form.options.items" :key="index" class="flex flex-col md:flex-row gap-4">
          <text-input class="w-full" label="Text" v-model="option.text" :error="form.errors[`options.items.${index}.text`]" />
          <text-input class="w-full" label="Bobot" type="number" v-model="option.value" :error="form.errors[`options.items.${index}.value`]" />
          <select-input class="w-full" v-model="option.value_type" :error="form.errors[`options.items.${index}.value_type`]" label="Jenis Kriteria">
            <option :value="null" />
            <option v-for="(type, value) in weightTypes" :key="value" :value="value">{{ type }}</option>
          </select-input>
          <div class="flex-none">
            <button @click.prevent="remove(index)" :disabled="form.options.items.length === 1" class="disabled:opacity-75 disabled:cursor-not-allowed btn-red btn-ring md:w-12 w-full md:mt-6 py-3">
              <icon name="XIcon" type="solid" class="w-4" />
            </button>
          </div>
        </div>
        <div class="flex-none">
          <button @click.prevent="clone" class="btn-red btn-ring">Duplikat</button>
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
        input_type: null,
        description: null,
        allow_file_upload: false,
        texts: {
          label: null,
          value: null,
          value_type: null,
        },
        options: {
          label: null,
          items: [],
        },
      }),
      types: {
        text: 1,
        option: 2,
      },
    };
  },
  created() {
    this.clone();
  },
  methods: {
    store() {
      this.form.post("/criteria", {
        onSuccess: (success) => {
          console.log(success);
        },
        onError: (error) => {
          console.log(error);
        },
      });
    },
    clone() {
      this.form.options.items.push({
        text: null,
        value: null,
        value_type: null,
      });
    },
    remove(index) {
      this.form.options.items.splice(index, 1);
    },
  },
};
</script>