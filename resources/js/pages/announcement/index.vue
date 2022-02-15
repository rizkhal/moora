<template>
  <div class="grid grid-cols-12 gap-4">
    <div class="col-span-2">
      <div class="bg-white shadow-md rounded border">
        <div class="flex flex-col">
          <div class="p-4 flex items-center justify-center border-b border-gray-300">
            <button @click.prevent="changeComponent(0)" class="bg-red-500 w-full p-3 flex items-center rounded-md text-white">
              <icon name="SparklesIcon" class="w-4 h-4 mr-2" />
              Buat Pengumuman
            </button>
          </div>
          <div class="p-2">
            <div class="flex flex-col space-y-2">
              <button v-for="(m, index) in menu" :key="index" @click.prevent="changeComponent(m.component)" type="button" class="flex flex-row p-2 items-center transition rounded-md text-gray-600 hover:bg-red-500 hover:text-white">
                <icon :name="m.icon" type="outline" class="w-6 h-6 mr-2" />
                <span class="text-md">{{ m.text }}</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-span-10">
      <div class="flex flex-col">
        <div>
          <component :is="componentState" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import menu from './menu.json';
import list from './list.vue';
import create from './create.vue';

export default {
  props: {
    title: String,
  },
  data() {
    return {
      active: 0,
      menu: menu,
    }
  },
  methods: {
    changeComponent(active) {
      this.active = active;
    }
  },
  computed: {
    componentState() {
      if (this.active == 0) {
        return create;
      }

      if (this.active == 1) {
        return list;
      }
    }
  }
}
</script>