<template>
  <div class="flex flex-col space-y-4">
    <div class="flex-none">
      <label class="inline-flex items-center">
        <input v-model="form.allow_file_upload" type="checkbox" class="form-checkbox h-5 w-5 text-red-600 border-gray-400 focus:outline-none focus:ring-0" />
        <span class="ml-2 text-gray-700">Izinkan upload file</span>
      </label>
    </div>
    <div v-for="(option, index) in form.options" :key="index" class="flex flex-col md:flex-row gap-4">
      <text-input class="w-full" label="Text" v-model="option.text" :error="form.errors[`options.${index}.text`]" />
      <text-input class="w-full" label="Bobot" type="number" v-model="option.value" :error="form.errors[`options.${index}.value`]" />
      <select-input class="w-full" v-model="option.value_type" :error="form.errors[`options.${index}.value_type`]" label="Jenis Kriteria">
        <option :value="null" />
        <option v-for="(type, value) in weights" :key="value" :value="value">{{ type }}</option>
      </select-input>
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
</template>
<script>
export default {
  props: {
    form: Object,
    weights: Object,
  },
  created() {
    if (this.form.options.length == 0) {
      this.clone();
    }
  },
  methods: {
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