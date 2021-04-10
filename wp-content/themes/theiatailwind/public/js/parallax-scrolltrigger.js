/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************************!*\
  !*** ./resources/js/parallax-scrolltrigger.js ***!
  \************************************************/
// import { gsap } from 'gsap';
// import { ScrollTrigger } from 'gsap/ScrollTrigger';
var tl = gsap.timeline({
  scrollTrigger: {
    trigger: '#hero',
    start: 'top top',
    end: 'bottom top',
    scrub: true
  }
});
gsap.utils.toArray('.layer').forEach(function (layer) {
  var depth = layer.dataset.depth;
  var movement = -(layer.offsetHeight * depth);
  tl.to(layer, {
    y: movement,
    ease: 'none'
  }, 0);
});
/******/ })()
;
//# sourceMappingURL=parallax-scrolltrigger.js.map