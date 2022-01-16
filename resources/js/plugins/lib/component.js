import appModal from '../components/app-modal'

const modal = {
    install(app, options) {
        
        app.config.globalProperties.$modal = {
            open() {
                // ...
            }
        }

        app.component('app-modal', appModal);
    }
};

export {
    modal,
}