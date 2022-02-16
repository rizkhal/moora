import helper from './helper';
import icon from '@/components/icon.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

// common custom
import modal from '@/components/modal.vue'
import textInput from '@/components/text-input.vue'
import selectInput from '@/components/select-input.vue'
import textareaInput from '@/components/textarea-input.vue'
import loadingButton from '@/components/loading-button.vue'
import fileInput from '@/components/file-input.vue'
import radioInput from "@/components/radio-input.vue";
import dropdown2 from '@/components/dropdown2.vue';

// datatable custom
import datatable from '@/components/datatable/datatable.vue';
import notAvailable from '@/components/datatable/not-available.vue';

// headlessui
import {
  MenuItem,
  MenuItems,
  MenuButton,
  Menu as MainMenu,
  Popover,
  PopoverButton,
  PopoverPanel }
from "@headlessui/vue";

export default {
  install: (app, options) => {
    app.component('icon', icon);
    app.component('app-head', Head);
    app.component('app-link', Link);

    // headlessui
    app.component('v-popover', Popover);
    app.component('v-popover-panel', PopoverPanel);
    app.component('v-popover-button', PopoverButton);

    app.component('v-modal', modal);
    app.component('v-dropdown2', dropdown2);

    app.component('text-input', textInput);
    app.component('file-input', fileInput);
    app.component('radio-input', radioInput);
    app.component('select-input', selectInput);
    app.component('textarea-input', textareaInput);
    app.component('loading-button', loadingButton);

    // datatable
    app.component('v-datatable', datatable);
    app.component('v-not-available', notAvailable);

    app.config.globalProperties.$helper = helper;
  }
};