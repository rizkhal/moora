<template>
  <app-head :title="`Ubah Kriteria ${criteria.name}`" />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-md border">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />
      <text-input label="Bobot" type="number" v-model="form.weight" :error="form.errors.weight" />
      <select-input class="w-full" v-model="form.weight_type" :error="form.errors.weight_type" label="Jenis">
        <option :value="null" />
        <option v-for="(type, value) in weightTypes" :key="value" :value="value">{{ type }}</option>
      </select-input>

      <div class="flex flex-col space-y-4">
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
          <button @click.prevent="clone" class="btn-red btn-ring">Duplikat</button>
        </div>
      </div>

      <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
      <loading-button @click.prevent="update" :loading="form.processing" class="btn-red ml-auto" type="button">Ubah</loading-button>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    criteria: Object,
    weightTypes: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        id: this.criteria.id,
        name: this.criteria.name,
        weight: this.criteria.weight,
        weight_type: this.criteria.weight_type,
        description: this.criteria.description,
        allow_file_upload: this.criteria.allow_file_upload,
        options: [],
      }),
    };
  },
  mounted() {
    this.criteria.details.some((value) => {
      this.form.options.push({
        id: value.id,
        text: value.text,
        weight: value.weight,
      });
    });
  },
  methods: {
    update() {
      this.form.put(`/criteria/${this.criteria.id}`, {
        onError: (error) => {
          console.log(error);
        },
      });
    },
    clone() {
      this.form.options.push({
        text: null,
        value: null,
        value_type: null,
      });
    },
    remove(index) {
      this.form.options.splice(index, 1);
    },
  },
};
</script>