import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import '../node_modules/spectre.css/src/spectre.scss';
import './assets/scss/style.scss';
import './dist/icons/style.css';

import VeeValidate, { Validator } from 'vee-validate';
import { errorBagConfig, errorMessage, errorMessageGlobal } from './validation';
import zh_CN from 'vee-validate/dist/locale/zh_TW';
Vue.use(VeeValidate, errorBagConfig);
Validator.localize('zh_CN', zh_CN);

import VueFlashMessage from 'vue-flash-message';
import 'vue-flash-message/dist/vue-flash-message.min.css';
Vue.use(VueFlashMessage, { 
  method: 'notification',
  messageOptions: {
    timeout: 4000
  }
});

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
