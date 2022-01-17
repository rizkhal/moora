import { createApp, h } from 'vue'
import appLayout from './layouts/app-layout.vue';
import { globalComponent } from './plugins/index';
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

InertiaProgress.init()

createInertiaApp({
  resolve: name => {
    const module = require(`./pages/${name}.vue`);

    if (name != 'auth/login' && name != 'auth/register' && name != 'auth/notice' && name != 'welcome') {
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