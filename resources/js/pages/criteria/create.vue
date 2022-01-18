<template>
  <app-head title="Tambah Kriteria" />

  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-md border">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />

      <span>Jenis Input</span>
      <div class="flex items-center space-x-4">
        <radio-input @input="form.type = $event.target.value" class="-mt-4" v-for="(type, index) in types" :key="index" :label="index" :value="type" />
      </div>

      <div v-if="form.type == types.text">
        <div class="flex flex-col space-y-4">
          <label class="inline-flex items-center">
            <input type="checkbox" class="form-checkbox h-5 w-5 text-red-600 border-gray-400 focus:outline-none focus:ring-0" />
            <span class="ml-2 text-gray-700">Izinkan upload file</span>
          </label>
          <text-input label="Label" v-model="form.weight" :error="form.errors.weight" />
          <text-input label="Bobot" v-model="form.weight" :error="form.errors.weight" />
        </div>
      </div>

      <div v-if="form.type == types.option" class="flex flex-col space-y-4">
        <label class="inline-flex items-center">
          <input type="checkbox" class="form-checkbox h-5 w-5 text-red-600 border-gray-400 focus:outline-none focus:ring-0" />
          <span class="ml-2 text-gray-700">Izinkan upload file</span>
        </label>
        <text-input label="Label" v-model="form.weight" :error="form.errors.weight" />
        <div v-for="(option, index) in form.options" :key="index" class="flex flex-col md:flex-row items-center gap-4">
          <text-input class="w-full" label="Text" v-model="option.text" :error="form.errors.text" />
          <text-input class="w-full" label="Bobot" v-model="option.weight" :error="form.errors.weight" />
          <button @click.prevent="remove(index)" :disabled="form.options.length === 1" class="disabled:opacity-75 disabled:cursor-not-allowed btn-red btn-ring md:w-12 w-full md:mt-6 py-3">
            <icon name="XIcon" type="solid" class="w-4" />
          </button>
        </div>
        <div class="flex-none">
          <button @click.prevent="clone" class="btn-red btn-ring">Duplikat</button>
        </div>
      </div>

      <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        description: null,
        options: [],
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