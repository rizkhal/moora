import { createApp, h } from 'vue'
import appLayout from './layouts/layout.vue';
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { globalComponent } from './plugins/index';

InertiaProgress.init()

createInertiaApp({
  resolve: name => {
    const module = require(`./pages/${name}.vue`);

    if (name != 'auth/login' && name != 'welcome') {
      module.default.layout = appLayout;
    }

    return module.default;
  },
  title: title => `${title} - Skripsi`,
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) }).use(plugin);
    app.config.productionTip = false;

    app.use(globalComponent);
    app.mount(el);
    return app;
  },
})