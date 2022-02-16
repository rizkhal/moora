import { createApp, h } from 'vue'
import except from './layouts/except';
import appLayout from './layouts/app-layout.vue';
import { component } from './plugins/index';
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

// toast notification
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

// custom plugins component
import VueModal from './plugins/modal/index';

InertiaProgress.init({
  showSpinner: true
});

createInertiaApp({
  resolve: name => {
    const page = require(`./pages/${name}.vue`).default;

    if (page.layout === undefined && !except.includes(name)) {
      page.layout = appLayout;
    }

    return page;
  },
  title: title => `${title} - Skripsi`,
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) }).use(plugin);
    app.config.productionTip = false;

    app.use(component);

    app.use(VueToast, {
      position: 'top-right'
    });

    app.use(VueModal);

    app.mount(el);
    return app;
  },
})