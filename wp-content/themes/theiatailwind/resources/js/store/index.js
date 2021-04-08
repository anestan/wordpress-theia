import Vuex from 'vuex';
import Vue from 'vue';
import contact_form from './modules/contact-form';

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    contact_form: contact_form,
  }
});
