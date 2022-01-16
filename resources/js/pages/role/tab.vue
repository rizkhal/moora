<template>
  <div>
    <div v-for="(permission, index) in permissions" :key="index" class="form-check mt-3">
      <input
        :value="permission.id"
        v-model="form.permissionChecked"
        type="checkbox"
        :id="`id-${permission.id}`"
        class="
          appearance-none
          h-4
          w-4
          border border-gray-300
          rounded-sm
          bg-white
          focus:ring-red-500
          checked:bg-red-500 checked:border-red-500
          focus:outline-none
          transition
          duration-200
          align-top
          bg-no-repeat bg-center bg-contain
          float-left
          mr-2
          cursor-pointer
        "
      />
      <label :for="`id-${permission.id}`" class="inline-block text-gray-800 cursor-pointer"> {{ permission.name }} </label>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    form: Object,
    selected: {
      type: Object,
      default: null,
    },
    permissions: Object,
  },
  methods: {
    setSelected() {
      if (this.selected !== null) {
        this.selected.some((value) => {
          this.form.permissionChecked[value.id] = value.id;
        });
      }
    },
  },
  created() {
    this.setSelected();
  },
  watch: {
    selected: {
      handler() {
        this.setSelected();
      },
      deep: true,
    },
  },
};
</script>