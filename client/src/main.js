import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import './assets/scss/style.scss';
import '../node_modules/spectre.css/src/spectre.scss';
import './dist/icons/style.css';
import 'vue-flash-message/dist/vue-flash-message.min.css';

import VueFlashMessage from 'vue-flash-message';
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
