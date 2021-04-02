import 'alpinejs';

/**
 * Header
 */
let header = document.getElementById('header');

if (window.scrollY > header.getBoundingClientRect().height) {
  header.classList.remove('bg-blue-500');
  header.classList.add('bg-gray-500');
}

document.addEventListener('scroll', () => {
  if (window.scrollY > header.getBoundingClientRect().height) {
    header.classList.remove('bg-blue-500');
    header.classList.add('bg-gray-500');
  } else {
    header.classList.add('bg-blue-500');
    header.classList.remove('bg-gray-500');
  }
});

import Swiper from 'swiper/bundle';
import PhotoSwipe from 'photoswipe';
import PhotoSwipeUI_Default from 'photoswipe/dist/photoswipe-ui-default';

/**
 * Banner Carousel
 */
let banner_carousel = new Swiper('.banner-carousel', {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  speed: 300,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

/**
 * Hover Link Carousel
 */
let hover_link_carousel = new Swiper('.hover-link-carousel', {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  speed: 300,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 15,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    1280: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
  },
});

/**
 * Sync Carousel
 */
let sync_primary_carousel = new Swiper('.sync-primary-carousel', {
  loop: true,
  speed: 300,
  allowTouchMove: false,
});

let sync_secondary_carousel = new Swiper('.sync-secondary-carousel', {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  speed: 300,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
  },
  slidesPerView: 3,
  spaceBetween: 30,
  on: {
    slidePrevTransitionStart: () => {
      sync_primary_carousel.slidePrev(300, true);
    },
    slideNextTransitionStart: () => {
      sync_primary_carousel.slideNext(300, true);
    },
  },
});

/**
 * Numbered Carousel
 */
let numbered_carousel = new Swiper('.numbered-carousel', {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  speed: 300,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    renderBullet: (index, className) => {
      return '<span class="' + className + ' bg-red-500 text-white h-[30px] w-[30px] rounded-full flex items-center justify-center mx-[15px]">' + (index + 1) + '</span>';
    },
  },
  init: false,
});

numbered_carousel.on('init', () => {
  document.getElementById('swiper-fraction').innerHTML = (numbered_carousel.realIndex + 1).toString().padStart(2, '0');
});
numbered_carousel.init();

numbered_carousel.on('slideChange', () => {
  document.getElementById('swiper-fraction').innerHTML = (numbered_carousel.realIndex + 1).toString().padStart(2, '0');
});

/**
 * Centered Carousel
 */
let centered_carousel = new Swiper('.centered-carousel', {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  speed: 300,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  slidesPerView: 3,
  centeredSlides: true,
});

/**
 * Halfway Carousel
 */
let halfway_carousel = new Swiper('.halfway-carousel', {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  speed: 300,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
  },
  slidesPerView: 'auto',
  spaceBetween: 30,
});

/**
 * MySwiper Carousel
 */
let mySwiper = new Swiper('.my-swiper', {
  loop: true,
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  speed: 300,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  pagination: {
    el: '.swiper-pagination',
  },
  slidesPerView: 3,
  spaceBetween: 30,
});

// 2 of 2 : PHOTOSWIPE
var initPhotoSwipeFromDOM = function (gallerySelector) {
  // parse slide data (url, title, size ...) from DOM elements
  // (children of gallerySelector)
  var parseThumbnailElements = function (el) {
    var thumbElements = el.childNodes,
      numNodes = thumbElements.length,
      items = [],
      figureEl,
      linkEl,
      size,
      item;

    for (var i = 0; i < numNodes; i++) {
      figureEl = thumbElements[i]; // <figure> element

      // include only element nodes
      if (figureEl.nodeType !== 1) {
        continue;
      }

      linkEl = figureEl.children[0]; // <a> element

      size = linkEl.getAttribute('data-size').split('x');

      // create slide object
      item = {
        src: linkEl.getAttribute('href'),
        w: parseInt(size[0], 10),
        h: parseInt(size[1], 10)
      };

      if (figureEl.children.length > 1) {
        // <figcaption> content
        item.title = figureEl.children[1].innerHTML;
      }

      if (linkEl.children.length > 0) {
        // <img> thumbnail element, retrieving thumbnail url
        item.msrc = linkEl.children[0].getAttribute('src');
      }

      item.el = figureEl; // save link to element for getThumbBoundsFn
      items.push(item);
    }

    return items;
  };

  // find nearest parent element
  var closest = function closest (el, fn) {
    return el && (fn(el) ? el : closest(el.parentNode, fn));
  };

  // triggers when user clicks on thumbnail
  var onThumbnailsClick = function (e) {
    e = e || window.event;
    e.preventDefault ? e.preventDefault() : (e.returnValue = false);

    var eTarget = e.target || e.srcElement;

    // find root element of slide
    var clickedListItem = closest(eTarget, function (el) {
      return el.tagName && el.tagName.toUpperCase() === 'LI';
    });

    if (!clickedListItem) {
      return;
    }

    // find index of clicked item by looping through all child nodes
    // alternatively, you may define index via data- attribute
    var clickedGallery = clickedListItem.parentNode,
      childNodes = clickedListItem.parentNode.childNodes,
      numChildNodes = childNodes.length,
      nodeIndex = 0,
      index;

    for (var i = 0; i < numChildNodes; i++) {
      if (childNodes[i].nodeType !== 1) {
        continue;
      }

      if (childNodes[i] === clickedListItem) {
        index = nodeIndex;
        break;
      }
      nodeIndex++;
    }

    if (index >= 0) {
      // open PhotoSwipe if valid index found
      openPhotoSwipe(index, clickedGallery);
    }
    return false;
  };

  // parse picture index and gallery index from URL (#&pid=1&gid=2)
  var photoswipeParseHash = function () {
    var hash = window.location.hash.substring(1),
      params = {};

    if (hash.length < 5) {
      return params;
    }

    var vars = hash.split('&');
    for (var i = 0; i < vars.length; i++) {
      if (!vars[i]) {
        continue;
      }
      var pair = vars[i].split('=');
      if (pair.length < 2) {
        continue;
      }
      params[pair[0]] = pair[1];
    }

    if (params.gid) {
      params.gid = parseInt(params.gid, 10);
    }

    return params;
  };

  var openPhotoSwipe = function (
    index,
    galleryElement,
    disableAnimation,
    fromURL
  ) {
    var pswpElement = document.querySelectorAll('.pswp')[0],
      gallery,
      options,
      items;

    items = parseThumbnailElements(galleryElement);

    // define options (if needed)

    options = {
      /* "showHideOpacity" uncomment this If dimensions of your small thumbnail don't match dimensions of large image */
      //showHideOpacity:true,

      // Buttons/elements
      closeEl: true,
      captionEl: true,
      fullscreenEl: true,
      zoomEl: true,
      shareEl: true,
      counterEl: false,
      arrowEl: true,
      preloaderEl: true,
      // define gallery index (for URL)
      galleryUID: galleryElement.getAttribute('data-pswp-uid'),

      getThumbBoundsFn: function (index) {
        // See Options -> getThumbBoundsFn section of documentation for more info
        var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
          pageYScroll =
            window.pageYOffset || document.documentElement.scrollTop,
          rect = thumbnail.getBoundingClientRect();

        return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
      }
    };

    // PhotoSwipe opened from URL
    if (fromURL) {
      if (options.galleryPIDs) {
        // parse real index when custom PIDs are used
        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
        for (var j = 0; j < items.length; j++) {
          if (items[j].pid == index) {
            options.index = j;
            break;
          }
        }
      } else {
        // in URL indexes start from 1
        options.index = parseInt(index, 10) - 1;
      }
    } else {
      options.index = parseInt(index, 10);
    }

    // exit if index not found
    if (isNaN(options.index)) {
      return;
    }

    if (disableAnimation) {
      options.showAnimationDuration = 0;
    }

    // Pass data to PhotoSwipe and initialize it
    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();

    /* EXTRA CODE (NOT FROM THE CORE) - UPDATE SWIPER POSITION TO THE CURRENT ZOOM_IN IMAGE (BETTER UI) */

    // photoswipe event: Gallery unbinds events
    // (triggers before closing animation)
    gallery.listen('unbindEvents', function () {
      // This is index of current photoswipe slide
      var getCurrentIndex = gallery.getCurrentIndex();
      // Update position of the slider
      mySwiper.slideTo(getCurrentIndex, false);
    });
  };

  // loop through all gallery elements and bind events
  var galleryElements = document.querySelectorAll(gallerySelector);

  for (var i = 0, l = galleryElements.length; i < l; i++) {
    galleryElements[i].setAttribute('data-pswp-uid', i + 1);
    galleryElements[i].onclick = onThumbnailsClick;
  }

  // Parse URL and open gallery if it contains #&pid=3&gid=1
  var hashData = photoswipeParseHash();
  if (hashData.pid && hashData.gid) {
    openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
  }
};

// execute above function
initPhotoSwipeFromDOM('.my-gallery');

/**
 * Google Maps
 */
import { Loader } from '@googlemaps/js-api-loader';

new Loader({
  apiKey: window.wp_obj.google_maps_api_key,
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
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
          {
            "saturation": "-100"
          }
        ]
      },
      {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
          {
            "saturation": -100
          },
          {
            "lightness": 65
          },
          {
            "visibility": "on"
          }
        ]
      },
      {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
          {
            "saturation": -100
          },
          {
            "lightness": "50"
          },
          {
            "visibility": "simplified"
          }
        ]
      },
      {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
          {
            "saturation": "-100"
          }
        ]
      },
      {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
          {
            "visibility": "simplified"
          }
        ]
      },
      {
        "featureType": "road.arterial",
        "elementType": "all",
        "stylers": [
          {
            "lightness": "30"
          }
        ]
      },
      {
        "featureType": "road.local",
        "elementType": "all",
        "stylers": [
          {
            "lightness": "40"
          }
        ]
      },
      {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
          {
            "saturation": -100
          },
          {
            "visibility": "simplified"
          }
        ]
      },
      {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
          {
            "hue": "#ffff00"
          },
          {
            "lightness": -25
          },
          {
            "saturation": -97
          }
        ]
      },
      {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
          {
            "lightness": -25
          },
          {
            "saturation": -100
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

/**
 * Contact Form
 */
import Vue from 'vue';
import Vuex from 'vuex';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import ContactForm from './components/ContactForm.vue';
import moment from 'moment';

Vue.use(Vuex);
Vue.use(VueSweetalert2);
Vue.config.silent = true;

const store_contact_form = new Vuex.Store({
  state: () => ({
    wp_nonce: window.wp_obj.wp_nonce,
    wp_ajax: window.wp_obj.wp_ajax,
    wp_action: window.wp_obj.wp_action,
    google_recaptcha_site_key: window.wp_obj.google_recaptcha_site_key,
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
});

new Vue({
  el: '#contact-form',
  store: store_contact_form,
  render: h => h(ContactForm),
});

/**
 * Scroll to Top
 */
const scroll_to_top_button = document.getElementById('scroll-to-top-button');

const toggleScrollToTopButton = () => {
  let y = window.scrollY;

  if (y > 0) {
    scroll_to_top_button.classList.add('opacity-100');
    scroll_to_top_button.classList.remove('opacity-0');
  } else {
    scroll_to_top_button.classList.add('opacity-0');
    scroll_to_top_button.classList.remove('opacity-100');
  }
};

window.addEventListener('scroll', toggleScrollToTopButton);

const scrollToTop = () => {
  const scrolled = document.documentElement.scrollTop || document.body.scrollTop;

  if (scrolled > 0) {
    window.scrollTo(0, 0);
  }
};

scroll_to_top_button.onclick = e => {
  e.preventDefault();
  scrollToTop();
};
