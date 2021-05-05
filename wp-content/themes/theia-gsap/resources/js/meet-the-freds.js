import { gsap } from 'gsap';
import { GSDevTools } from 'gsap/GSDevTools';

gsap.registerPlugin(GSDevTools);

GSDevTools.create();

gsap.timeline()
  .from('#demo', {opacity: 0, duration: 1})
  .from('#title', {opacity: 0, duration: 1, scale: 0, ease: 'back'})
  .from('#freds img', {y: 1000, duration: 2, stagger: 0.2, ease: 'back'})
  .from('#friends img', {y: 1000, duration: 2, stagger: {each: 0.2, from: 'end'}, ease: 'back'}, '+=0.5')
  .from('#time', {xPercent: -100, duration: 1}, '-=2');
