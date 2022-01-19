<template>
  <div class="flex flex-col space-y-4">
    <text-input label="Bobot" type="number" v-model="form.files.value" :error="form.errors['files.value']" />
    <select-input v-model="form.files.value_type" :error="form.errors['files.value_type']" label="Jenis Kriteria">
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