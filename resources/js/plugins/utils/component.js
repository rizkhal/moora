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
import radioInput from "@/components/radio-input";

// datatable custom
import datatable from '@/components/datatable/datatable.vue';
import notAvailable from '@/components/datatable/not-available.vue';

export default {
  install: (app, options) => {
    app.component('icon', icon);
    app.component('app-head', Head);
    app.component('app-link', Link);
    
    app.component('v-modal', modal);
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