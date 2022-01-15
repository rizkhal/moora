import { createApp, h } from 'vue'
import appLayout from './layouts/layout.vue';
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import {registerGlobalComponent, helper} from './plugins/index';

InertiaProgress.init()

createInertiaApp({
  resolve: name => {
    const module = require(`./pages/${name}.vue`);

    module.default.layout = appLayout;

    return module.default;
  },
  title: title => `${title} - Skripsi`,
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) }).use(plugin);
    
    app.config.productionTip = false;
    app.config.globalProperties.$helper = helper;
    app.use(registerGlobalComponent);

    app.mount(el);
    return app;
  },
})