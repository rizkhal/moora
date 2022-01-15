<template>
  <headless-dropdown>
    <template #button="{ open }">
      <menu-button class="p-2 inline-flex justify-center rounded-full focus:outline-none" :class="{ 'bg-red-500 bg-opacity-20': open }">
        <filter-icon class="w-6 h-6 text-red-500" aria-hidden="true" />
      </menu-button>
    </template>

    <template #content>
      <div class="px-1 py-1">
        <menu-item v-slot="{ active }">
          <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
            <trash-icon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
            Edit
          </button>
        </menu-item>
        <menu-item v-slot="{ active }">
          <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
            <trash-icon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
            Duplicate
          </button>
        </menu-item>
      </div>
      <div class="px-1 py-1">
        <menu-item v-slot="{ active }">
          <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
            <trash-icon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
            Archive
          </button>
        </menu-item>
        <menu-item v-slot="{ active }">
          <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
            <trash-icon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
            Move
          </button>
        </menu-item>
      </div>

      <div class="px-1 py-1">
        <menu-item v-slot="{ active }">
          <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
            <trash-icon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
            Delete
          </button>
        </menu-item>
      </div>
    </template>
  </headless-dropdown>
</template>
<script>
import { MenuButton, MenuItem } from '@headlessui/vue'
import headlessDropdown from '@/components/headless-dropdown.vue'
import { ChevronDownIcon, FilterIcon, TrashIcon } from '@heroicons/vue/outline'

export default {
  components: {
    MenuItem,
    TrashIcon,
    FilterIcon,
    MenuButton,
    ChevronDownIcon,
    headlessDropdown,
  },
}
</script>