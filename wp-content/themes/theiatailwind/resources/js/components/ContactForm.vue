<template>
  <div class="container mx-auto mb-[100px] px-[15px]">
    <ValidationObserver ref="form">
      <form @submit.prevent="onSubmit">
        <div class="grid grid-cols-12 gap-y-[15px] gap-x-[30px]">
          <div class="col-span-12 xl:col-span-6">
            <ValidationProvider rules="nameRequired" v-slot="{ errors }">
              <input class="w-full" v-model="name" type="text" placeholder="Name*">
              <small class="text-red-500">{{ errors.length ? errors[0] : '&nbsp;' }}</small>
            </ValidationProvider>
          </div>
          <div class="col-span-12 xl:col-span-6">
            <ValidationProvider rules="phoneRequired" v-slot="{ errors }">
              <input class="w-full" v-model="phone" type="text" placeholder="Phone*">
              <small class="text-red-500">{{ errors.length ? errors[0] : '&nbsp;' }}</small>
            </ValidationProvider>
          </div>
          <div class="col-span-12 xl:col-span-6">
            <ValidationProvider rules="emailRequired|emailValid" v-slot="{ errors }">
              <input class="w-full" v-model="email" type="email" placeholder="Email*">
              <small class="text-red-500">{{ errors.length ? errors[0] : '&nbsp;' }}</small>
            </ValidationProvider>
          </div>
          <div class="col-span-12 xl:col-span-6">
            <ValidationProvider rules="dateRequired" v-slot="{ errors }">
              <datepicker :input-class="'w-full'" v-model="date" :format="formatDate" placeholder="Date*"></datepicker>
              <small class="text-red-500">{{ errors.length ? errors[0] : '&nbsp;' }}</small>
            </ValidationProvider>
          </div>
          <div class="col-span-12">
            <ValidationProvider rules="messageRequired" v-slot="{ errors }">
              <textarea class="w-full" v-model="message" :rows="5" placeholder="Message*"></textarea>
              <small class="text-red-500">{{ errors.length ? errors[0] : '&nbsp;' }}</small>
            </ValidationProvider>
          </div>
          <div class="col-span-12">
            <ValidationProvider rules="photoIdRequired|photoIdImage" v-slot="{ errors, validate }">
              <div>
                <label>Photo ID*:</label>
                <input type="file" v-if="photoIdEnabled" @change="handlePhotoId($event) || validate($event)">
              </div>
              <small class="text-red-500">{{ errors.length ? errors[0] : '&nbsp;' }}</small>
            </ValidationProvider>
          </div>
          <div class="col-span-12">
            <ValidationProvider rules="tncRequired" v-slot="{ errors }">
              <div>
                <label>I accept the terms and conditions.</label>
                <input v-model="tnc" type="checkbox">
              </div>
              <small class="text-red-500">{{ errors.length ? errors[0] : '&nbsp;' }}</small>
            </ValidationProvider>
          </div>
          <div class="col-span-12">
            <vue-recaptcha ref="recaptcha" :sitekey="google_recaptcha_site_key" :loadRecaptchaScript="true"></vue-recaptcha>
          </div>
          <div class="col-span-12">
            <div class="flex">
              <svg v-if="loading" class="animate-spin h-5 w-5 mr-[5px]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <button type="submit">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </ValidationObserver>
  </div>
</template>
<script>
import { mapState } from 'vuex';
import axios from 'axios';
import moment from 'moment';
import Datepicker from 'vuejs-datepicker';
import { extend, ValidationProvider, ValidationObserver } from 'vee-validate';
import { email, image, required } from 'vee-validate/dist/rules';
import VueRecaptcha from 'vue-recaptcha';

extend('nameRequired', {
  ...required,
  message: 'Please fill in your full name'
});

extend('phoneRequired', {
  ...required,
  message: 'Please fill in your phone number'
});

extend('emailRequired', {
  ...required,
  message: 'Please fill in your email address'
});

extend('emailValid', {
  ...email,
  message: 'Please fill in a valid email address'
});

extend('dateRequired', {
  ...required,
  message: 'Please select a date'
});

extend('messageRequired', {
  ...required,
  message: 'Please fill in your message'
});

extend('photoIdRequired', {
  ...required,
  message: 'Please upload your photo id'
});

extend('photoIdImage', {
  ...image,
  message: 'Please upload a valid photo id image'
});

extend('tncRequired', {
  ...required,
  params: [
    {
      allowFalse: false
    }
  ],
  message: 'Please accept the terms and conditions'
});

extend('recaptchaRequired', {
  ...required,
  message: 'Please complete the recaptcha'
});

export default {
  name: 'ContactForm',
  components: {
    Datepicker,
    ValidationObserver,
    ValidationProvider,
    VueRecaptcha,
  },
  data () {
    return {
      loading: false,
      photoIdEnabled: true,
    };
  },
  computed: {
    ...mapState({
      wp_nonce: state => state.wp_nonce,
      wp_ajax: state => state.wp_ajax,
      wp_action: state => state.wp_action,
      google_recaptcha_site_key: state => state.google_recaptcha_site_key,
    }),
    name: {
      get () {
        return this.$store.state.form_data.name;
      },
      set (value) {
        this.$store.dispatch('updateName', value);
      }
    },
    phone: {
      get () {
        return this.$store.state.form_data.phone;
      },
      set (value) {
        this.$store.dispatch('updatePhone', value);
      }
    },
    email: {
      get () {
        return this.$store.state.form_data.email;
      },
      set (value) {
        this.$store.dispatch('updateEmail', value);
      }
    },
    date: {
      get () {
        return this.$store.state.form_data.date;
      },
      set (value) {
        this.$store.dispatch('updateDate', value);
      }
    },
    message: {
      get () {
        return this.$store.state.form_data.message;
      },
      set (value) {
        this.$store.dispatch('updateMessage', value);
      }
    },
    photo_id: {
      get () {
        return this.$store.state.form_data.photo_id;
      },
      set (value) {
        this.$store.dispatch('updatePhotoId', value);
      }
    },
    tnc: {
      get () {
        return this.$store.state.form_data.tnc;
      },
      set (value) {
        this.$store.dispatch('updateTnc', value);
      }
    },
  },
  methods: {
    formatDate (date) {
      return moment(date).format('DD/MM/YYYY');
    },
    handlePhotoId (event) {
      this.photo_id = event.target.files[0];
    },
    onSubmit () {
      this.$refs.form.validate().then(success => {
        if (success) {
          this.loading = true;

          let formData = new FormData();
          formData.append('action', this.wp_action);
          formData.append('wp_nonce', this.wp_nonce);
          formData.append('name', this.name);
          formData.append('phone', this.phone);
          formData.append('email', this.email);
          formData.append('date', this.date);
          formData.append('message', this.message);
          formData.append('photo_id', this.photo_id);
          formData.append('tnc', this.tnc);
          formData.append('g_recaptcha_response', document.getElementById('g-recaptcha-response').value);

          axios({
            method: 'POST',
            url: this.wp_ajax,
            headers: {
              'Content-Type': 'multipart/form-data'
            },
            data: formData,
          }).then(response => {
            if (response.data.status === 1) {
              this.$swal('Success', response.data.message, 'success');

              this.name = this.phone = this.email = this.date = this.message = '';
              this.photo_id = null;
              this.tnc = false;
              this.photoIdEnabled = false;

              this.$nextTick(() => {
                this.$refs.form.reset();
                this.photoIdEnabled = true;
              });
            } else {
              this.$swal('Error', response.data.message, 'error');
            }

            this.$refs.recaptcha.reset();
            this.loading = false;
            console.log(response);
          }).catch(error => {
            this.$refs.recaptcha.reset();
            this.loading = false;
            console.log(error);
          });
        }
      });
    },
  },
  mounted () {
    this.$refs.recaptcha.$on('verify', response => {
      console.log(response);
    });
  }
};
</script>
<style lang="scss">
</style>
