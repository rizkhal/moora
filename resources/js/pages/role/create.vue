<template>
  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-sm">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />
      <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
    </div>

    <div class="grid grid-cols-4 gap-4">
      <button
        v-for="(type, index) in this.$helper.permissionTypes"
        :key="index"
        @click="active = index"
        type="button"
        class="p-4 rounded-lg shadow-sm focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:outline-none transition duration-150 text-white"
        :class="[index === active ? 'bg-red-500' : 'bg-white text-gray-800']"
      >
        {{ type }}
      </button>
    </div>

    <div class="w-full my-4 p-4 rounded-md bg-white shadow-sm">
      <span class="form-error">{{ form.errors.permissionChecked }}</span>

      <component v-if="permissions[active + 1]" :is="currentTabComponent" :permissions="permissions[active + 1]" :form="form" :selected="role ? permissionSelected[active + 1] : null" />

      <div v-else class="flex text-gray-500 flex-col justify-center items-center space-y-1">
        <icon name="InboxIcon" type="outline" class="w-8 h-8" />
        <span>Kosong</span>
      </div>
    </div>

    <loading-button v-if="!role" :loading="form.processing" class="btn-red ml-auto" @click.prevent="store" type="button"> Save </loading-button>
    <loading-button v-else :loading="form.processing" class="btn-red ml-auto" @click.prevent="update" type="button"> Update </loading-button>
  </div>
</template>
<script>
import tab from "./tab.vue";
export default {
  props: {
    role: {
      title: String,
      type: Object,
      default: null,
    },
    permissionSelected: {
      type: Object,
      default: null,
    },
    permissions: Object,
  },
  data() {
    return {
      active: 0,
      form: this.$inertia.form({
        id: this.role ? this.role.id : null,
        name: this.role ? this.role.name : null,
        description: this.role ? this.role.description : null,
        permissionChecked: [],
      }),
    };
  },
  computed: {
    currentTabComponent() {
      return tab;
    },
  },
  methods: {
    store() {
      this.form.post("/setting/role", {
        onSuccess: (event) => {
          this.$toast.success('Berhasil menambah role');
          
          this.form.reset();
        },
      });
    },
    update() {
      this.form.put(`/setting/role/${this.role.id}`, {
        onSuccessonError: (error) => {
          this.$toast.success('Berhasil mengubah role');
        },
      });
    },
  },
};
</script>