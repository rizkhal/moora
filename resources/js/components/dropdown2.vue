<template>
  <v-popover class="relative w-24" v-slot="{ open }">
    <v-popover-button class="btn-red flex items-center space-x-2">
      <span v-if="text">{{ text }}</span>
      <span v-if="pill" class="py-[1px] px-[5px] rounded-lg bg-purple-500/70">{{ pill }}</span>
      <icon v-if="icon" :name="icon" type="outline" class="w-5 h-5" aria-hidden="true" />
    </v-popover-button>

    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="translate-y-1 opacity-0"
      enter-to-class="translate-y-0 opacity-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="translate-y-0 opacity-100"
      leave-to-class="translate-y-1 opacity-0"
    >
      <v-popover-panel
        :class="[position == 'right' ? 'right-0' : position == 'left' ? 'left-0' : position]"
        class="absolute right-0 min-w-[12rem] mt-2 origin-top-right py-1 bg-white dark:bg-cool-gray-600 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
      >
        <slot />
      </v-popover-panel>
    </transition>
  </v-popover>
</template>
<script>
export default {
  props: {
    position: {
      type: String,
      default: "right",
    },
    icon: {
      type: String,
      required: false,
    },
    text: {
      type: String,
      required: false,
    },
    pill: {
      type: [String, Number],
      default: null,
    },
  },
};
</script>