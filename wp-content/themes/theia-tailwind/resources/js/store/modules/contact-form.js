import moment from 'moment';

export default {
  state: () => ({
    wp_nonce: window.contact_script_data.wp_nonce,
    wp_ajax: window.contact_script_data.wp_ajax,
    wp_action: window.contact_script_data.wp_action,
    google_recaptcha_site_key: window.contact_script_data.google_recaptcha_site_key,
    form_data: {
      name: '',
      phone: '',
      email: '',
      date: '',
      message: '',
      photo_id: null,
      tnc: false,
      g_recaptcha_response: '',
    },
  }),
  mutations: {
    UPDATE_NAME: (state, value) => {
      state.form_data.name = value;
    },
    UPDATE_PHONE: (state, value) => {
      state.form_data.phone = value;
    },
    UPDATE_EMAIL: (state, value) => {
      state.form_data.email = value;
    },
    UPDATE_DATE: (state, value) => {
      state.form_data.date = moment(value).format('DD/MM/YYYY');
    },
    UPDATE_MESSAGE: (state, value) => {
      state.form_data.message = value;
    },
    UPDATE_PHOTO_ID: (state, value) => {
      state.form_data.photo_id = value;
    },
    UPDATE_TNC: (state, value) => {
      state.form_data.tnc = value;
    },
    UPDATE_RECAPTCHA: (state, value) => {
      state.form_data.g_recaptcha_response = value;
    },
  },
  actions: {
    updateName: ({commit, state}, value) => {
      commit('UPDATE_NAME', value);
      return state.form_data.name;
    },
    updatePhone: ({commit, state}, value) => {
      commit('UPDATE_PHONE', value);
      return state.form_data.phone;
    },
    updateEmail: ({commit, state}, value) => {
      commit('UPDATE_EMAIL', value);
      return state.form_data.email;
    },
    updateDate: ({commit, state}, value) => {
      commit('UPDATE_DATE', value);
      return state.form_data.date;
    },
    updateMessage: ({commit, state}, value) => {
      commit('UPDATE_MESSAGE', value);
      return state.form_data.message;
    },
    updatePhotoId: ({commit, state}, value) => {
      commit('UPDATE_PHOTO_ID', value);
      return state.form_data.photo_id;
    },
    updateTnc: ({commit, state}, value) => {
      commit('UPDATE_TNC', value);
      return state.form_data.tnc;
    },
    updateRecaptcha: ({commit, state}, value) => {
      commit('UPDATE_RECAPTCHA', value);
      return state.form_data.g_recaptcha_response;
    },
  },
};
