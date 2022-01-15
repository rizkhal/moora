<template>
  <div class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-6 bg-white p-4 rounded-md shadow-sm">
      <text-input label="Nama" v-model="form.name" :error="form.errors.name" />
      <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />
    </div>

    <div class="grid grid-cols-4 gap-4">
      <button v-for="(type, index) in this.$helper.permissionTypes" :key="index" @click="activate(index)" type="button" class="p-4 rounded-lg shadow-sm transition duration-150 text-white" :class="[index === active ? 'bg-red-500' : 'bg-white text-gray-800']">{{ type }}</button>
    </div>

    <div class="w-full my-4 p-4 rounded-md bg-white shadow-sm">
      <div>
        <div class="flex space-x-4 mb-6">
          <a class="text-gray-700 cursor-pointer font-semibold underline decoration-[3px] decoration-blue-500" @click="$wire.call('selectPermission', tab)"> Select All </a>
          <a class="text-gray-700 cursor-pointer font-semibold underline decoration-[3px] decoration-red-500" @click="$wire.call('clearSelectedPermission', tab)"> Clear All </a>
        </div>

        <div>
          <component :is="currentTabComponent" :permissions="permissions" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CreateTab from './tabs/c.vue'
import ReadTab from './tabs/r.vue'
import UpdateTab from './tabs/u.vue'
import DeleteTab from './tabs/d.vue'

export default {
  props: {
    permissions: Object,
  },
  data() {
    return {
      active: 0,
      form: this.$inertia.form({
        name: null,
        description: null,
      }),
    }
  },
  computed: {
    currentTabComponent() {
      // return () => import(path); not working
      if (this.active === 0) return CreateTab
      if (this.active === 1) return ReadTab
      if (this.active === 2) return UpdateTab
      if (this.active === 3) return DeleteTab
    },
  },
  methods: {
    activate(index) {
      return (this.active = index)
    },
    store() {
      this.form.post(`${window.location.pathname}`, {
        onSuccess: (event) => {
          this.$refs.modalForm.closeModal()
          console.log('dwdw')
        },
        onError: (error) => {
          console.log(error)
        },
      })
    },
  },
}
</script>