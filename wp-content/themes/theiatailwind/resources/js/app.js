import 'alpinejs';

/**
 * Google Maps
 */
import { Loader } from '@googlemaps/js-api-loader';

new Loader({
  apiKey: window.wp_obj.google_maps_api_key,
  version: 'weekly',
  libraries: ['places']
}).load().then(() => {
  new google.maps.Map(document.getElementById('map'), {
    center: {
      lat: 0,
      lng: 0
    },
    zoom: 4
  });
}).catch(e => {
  console.log(e);
});
