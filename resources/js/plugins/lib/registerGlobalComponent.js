import icon from '@/components/icon.vue'
import layout from '@/layouts/layout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3'

import textInput from '@/components/text-input.vue'
import selectInput from '@/components/select-input.vue'
import textareaInput from '@/components/textarea-input.vue'
import loadingButton from '@/components/loading-button.vue'

const GlobalComponent = {
  install(app, options) {    
    app.component('icon', icon);
    app.component('app-head', Head);
    app.component('app-link', Link);
    app.component('app-layout', layout);
    
    app.component('text-input', textInput);
    app.component('select-input', selectInput);
    app.component('textarea-input', textareaInput);
    app.component('loading-button', loadingButton);
  }
};

export default GlobalComponent;