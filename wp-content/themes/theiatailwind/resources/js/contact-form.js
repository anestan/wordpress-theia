/**
 * Contact Form
 */
import Vue from 'vue';
import store from './store';
import ContactForm from './components/ContactForm.vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.config.devtools = true;
Vue.config.silent = false;
Vue.use(VueSweetalert2);

new Vue({
  el: '#contact-form',
  store: store,
  render: h => h(ContactForm),
});
