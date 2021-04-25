/**
 * Google Maps
 */
import { Loader } from '@googlemaps/js-api-loader';

new Loader({
  apiKey: window.google_maps_script_data.google_maps_api_key,
  version: 'weekly',
  libraries: ['places']
}).load().then(() => {
  let coordinates = {lat: -36.9063145, lng: 174.6874676};

  let map = new google.maps.Map(document.getElementById('map'), {
    center: coordinates,
    zoom: 18,
    disableDefaultUI: true,
    styles: [
      {
        'featureType': 'administrative',
        'elementType': 'all',
        'stylers': [
          {
            'saturation': '-100'
          }
        ]
      },
      {
        'featureType': 'administrative.province',
        'elementType': 'all',
        'stylers': [
          {
            'visibility': 'off'
          }
        ]
      },
      {
        'featureType': 'landscape',
        'elementType': 'all',
        'stylers': [
          {
            'saturation': -100
          },
          {
            'lightness': 65
          },
          {
            'visibility': 'on'
          }
        ]
      },
      {
        'featureType': 'poi',
        'elementType': 'all',
        'stylers': [
          {
            'saturation': -100
          },
          {
            'lightness': '50'
          },
          {
            'visibility': 'simplified'
          }
        ]
      },
      {
        'featureType': 'road',
        'elementType': 'all',
        'stylers': [
          {
            'saturation': '-100'
          }
        ]
      },
      {
        'featureType': 'road.highway',
        'elementType': 'all',
        'stylers': [
          {
            'visibility': 'simplified'
          }
        ]
      },
      {
        'featureType': 'road.arterial',
        'elementType': 'all',
        'stylers': [
          {
            'lightness': '30'
          }
        ]
      },
      {
        'featureType': 'road.local',
        'elementType': 'all',
        'stylers': [
          {
            'lightness': '40'
          }
        ]
      },
      {
        'featureType': 'transit',
        'elementType': 'all',
        'stylers': [
          {
            'saturation': -100
          },
          {
            'visibility': 'simplified'
          }
        ]
      },
      {
        'featureType': 'water',
        'elementType': 'geometry',
        'stylers': [
          {
            'hue': '#ffff00'
          },
          {
            'lightness': -25
          },
          {
            'saturation': -97
          }
        ]
      },
      {
        'featureType': 'water',
        'elementType': 'labels',
        'stylers': [
          {
            'lightness': -25
          },
          {
            'saturation': -100
          }
        ]
      }
    ]
  });

  new google.maps.Marker({
    position: coordinates,
    map,
    icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/parking_lot_maps.png',
  });
}).catch(e => {
  console.log(e);
});
