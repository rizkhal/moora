<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" :initialFocus="focusRef" @close="closeModal">
      <div class="fixed inset-0 z-10 overflow-y-auto transition duration-100 backdrop-blur-sm bg-white/30">
        <div class="min-h-screen px-4 text-center">
          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
            <DialogOverlay class="fixed inset-0" />
          </TransitionChild>

          <span class="inline-block h-screen align-middle" aria-hidden="true"> &#8203; </span>

          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <div class="inline-block w-full max-w-md my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-cool-gray-800 shadow-xl rounded-lg border border-gray-200">
              <DialogTitle v-if="title" as="h3" class="p-4 bg-gray-50 border-b text-xl"> {{ title }} </DialogTitle>

              <!-- slot -->
              <slot name="content" />
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from "vue";
import { TransitionRoot, TransitionChild, Dialog, DialogOverlay, DialogTitle } from "@headlessui/vue";

const isOpen = ref(false);
const focusRef = ref();

const emit = defineEmits(["open"]);

const props = defineProps({
  title: {
    type: String,
    default: null,
  },
});

const closeModal = function () {
  isOpen.value = false;
};

const openModal = function (attr) {
  isOpen.value = true;
  this.$emit("open", attr);
};

defineExpose({
  openModal,
  closeModal,
});
</script>
