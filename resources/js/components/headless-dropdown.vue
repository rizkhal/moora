<template>
  <div>
    <Menu as="div" class="relative inline-block text-left" v-slot="{ open }">
      <div>
        <MenuButton class="p-2 inline-flex justify-center rounded-full focus:outline-none" :class="{ 'bg-red-500 bg-opacity-20': open }">
          <FilterIcon class="w-6 h-6 text-red-500" aria-hidden="true" />
        </MenuButton>
      </div>

      <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
        <MenuItems class="absolute right-0 w-56 mt-2 origin-top-right bg-white divide-y divide-gray-100 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }">
              <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
                <TrashIcon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
                Edit
              </button>
            </MenuItem>
            <MenuItem v-slot="{ active }">
              <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
                <TrashIcon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
                Duplicate
              </button>
            </MenuItem>
          </div>
          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }">
              <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
                <TrashIcon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
                Archive
              </button>
            </MenuItem>
            <MenuItem v-slot="{ active }">
              <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
                <TrashIcon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
                Move
              </button>
            </MenuItem>
          </div>

          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }">
              <button :class="[active ? 'bg-violet-500 text-white' : 'text-gray-900', 'group flex rounded-md items-center w-full px-2 py-2 text-sm']">
                <TrashIcon :active="active" class="w-5 h-5 mr-2 text-violet-400" aria-hidden="true" />
                Delete
              </button>
            </MenuItem>
          </div>
        </MenuItems>
      </transition>
    </Menu>
  </div>
</template>

<script>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon, FilterIcon, TrashIcon } from '@heroicons/vue/outline'

export default {
  components: {
    Menu,
    MenuItem,
    MenuItems,
    TrashIcon,
    FilterIcon,
    MenuButton,
    ChevronDownIcon,
  },
}
</script>
