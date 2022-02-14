import { createApp, h } from 'vue'
import except from './layouts/except';
import appLayout from './layouts/app-layout.vue';
import { globalComponent } from './plugins/index';
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
// toast
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

InertiaProgress.init();

createInertiaApp({
  resolve: name => {
    const module = require(`./pages/${name}.vue`);

    if (!except.includes(name)) {
      module.default.layout = appLayout;
    }

    return module.default;
  },
  title: title => `${title} - Skripsi`,
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) }).use(plugin);
    app.config.productionTip = false;

    app.use(globalComponent);

    app.use(VueToast, {
      position: 'top-right'
    });

    app.mount(el);
    return app;
  },
})