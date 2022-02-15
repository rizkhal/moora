import DialogComponent from './dialog.vue';

import eventBus from '../utils/bus'

const Dialog = {
    install(app, options) {
        app.component('v-dialog', DialogComponent);

        app.config.globalProperties.$dialog = {
            show(params) {                
                eventBus.emit('show', params);
            },
            hide() {
                eventBus.emit('hide');
            }
        }
    }
};

export default Dialog;