<template>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal">
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
              <div class="p-5 text-center">
                <div class="rounded-full bg-red-200 flex items-center justify-center w-24 h-24 flex-shrink-0 mx-auto">
                  <icon name="TrashIcon" type="solid" class="w-16 h-16 text-red-500" />
                </div>
                <div class="text-3xl mt-5">{{ attr.title }}</div>
                <div class="text-gray-600 mt-2 leading-7">
                  {{ attr.message }}
                </div>
              </div>
              <div class="p-5 flex justify-center space-x-2 mt-4">
                <button @click.prevent="closeModal" type="button" class="btn-close">Tutup</button>
                <button @click.prevent="confirm" type="button" class="btn-red">Hapus</button>
              </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script>
import { ref, reactive } from 'vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogOverlay,
  DialogTitle,
} from '@headlessui/vue'
import eventBus from '../utils/bus.js';

export default {
  components: {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
  },

  setup() {
    const isOpen = ref(false)
    const confirm = ref(null);

    const attr = reactive({
      title: null,
      message: null,
    })

    const closeModal = () => {
      isOpen.value = false;
    }

    const openModal = () => {
      isOpen.value = true;
    }

    eventBus.on('show', ({title, message, onConfirm}) => {
      if (typeof title === 'undefined') {
        attr.title = "Apakah anda yakin?";
      } else {
        attr.title = title;
      }

      attr.message = message;
      confirm.value = onConfirm;

      openModal();
    });

    eventBus.on('hide', () => {
      closeModal();
    });

    return {
      attr,
      isOpen,
      openModal,
      closeModal,
      confirm,
    }
  },
}
</script>