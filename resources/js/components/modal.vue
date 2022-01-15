<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal">
      <div class="fixed inset-0 z-10 overflow-y-auto transition duration-100 backdrop-blur-sm bg-white/30">
        <div class="min-h-screen px-4 text-center">
          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
            <DialogOverlay class="fixed inset-0" />
          </TransitionChild>

          <span class="inline-block h-screen align-middle" aria-hidden="true"> &#8203; </span>

          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
            <div class="inline-block w-full max-w-md my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl border border-gray-200">
              <div class="p-6">
                <slot name="content" />
              </div>

              <div class="flex space-x-2 px-6 py-4 bg-gray-50 border-t border-gray-100" v-if="$slots['button']">
                <slot name="button" />
              </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'
import { TransitionRoot, TransitionChild, Dialog, DialogOverlay, DialogTitle } from '@headlessui/vue'

const isOpen = ref(false)

const emit = defineEmits(['open'])

const closeModal = function () {
  isOpen.value = false
  // this.$emit('closeModal')
}

const openModal = function (attr) {
  isOpen.value = true
  this.$emit('open', attr)
}

defineExpose({
  openModal,
  closeModal,
})
</script>
