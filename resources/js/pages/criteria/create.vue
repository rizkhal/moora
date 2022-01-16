<template>
  <app-head title="Tambah Kriteria" />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-sm">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />
      <select-input v-model="form.type" :error="form.errors.type" label="Tipe">
        <option :value="null" />
        <option v-for="(type, value) in types" :key="value" :value="value">{{ type }}</option>
      </select-input>
      <div v-if="isFile()">FILE</div>
      <div v-if="isOption()">OPTION</div>
      <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
    </div>
  </div>
</template>
<script>
const FILE = 0;
const OPTION = 1;

export default {
  props: {
    types: {
      type: Object,
    },
  },
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        type: null,
        description: null,
      }),
    };
  },
  methods: {
    isFile() {
      return this.form.type === FILE;
    },
    isOption() {
      return this.form.type === OPTION;
    },
  },
};
</script>