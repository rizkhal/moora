<template>
  <div class="flex flex-col space-y-4">
    <div class="flex-none">
      <label class="inline-flex items-center">
        <input v-model="form.allow_file_upload" type="checkbox" class="form-checkbox h-5 w-5 text-red-600 border-gray-400 focus:outline-none focus:ring-0" />
        <span class="ml-2 text-gray-700">Izinkan upload file</span>
      </label>
    </div>
    <text-input label="Bobot" type="number" v-model="form.texts.value" :error="form.errors['texts.value']" />
    <select-input v-model="form.texts.value_type" :error="form.errors['texts.value_type']" label="Jenis Kriteria">
      <option :value="null" />
      <option v-for="(type, value) in weights" :key="value" :value="value">{{ type }}</option>
    </select-input>
  </div>
</template>
<script>
export default {
  props: {
    form: Object,
    weights: Object,
  },
};
</script>