import { gsap } from 'gsap';
import { GSDevTools } from 'gsap/GSDevTools';
import { TextPlugin } from 'gsap/TextPlugin';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(GSDevTools, TextPlugin, SplitText);

GSDevTools.create();

gsap.to('.typewriter-text', {
  text: 'Lorem ipsum dolor sit amet.',
  ease: 'power1.in',
  duration: 2,
  repeat: 10,
  yoyo: true,
  repeatDelay: 0.4
});

gsap.set('wrapper', {autoAlpha: 1});

let tbt = new SplitText('.letter-by-letter-text', {type: 'chars'});
let tbt_tl = gsap.timeline({repeat: 10, yoyo: true, repeatDelay: 0.3});
tbt_tl.from(tbt.chars, {opacity: 0, y: 50, ease: 'back(4)', stagger: 0.05});

let wbw = new SplitText('.word-by-word-text', {type: 'words'});
let wbw_tl = gsap.timeline({repeat: 10, yoyo: true, repeatDelay: 0.3});
wbw_tl.from(wbw.words, {opacity: 0, rotation: -40, scale: 0.4, stagger: 0.1, ease: 'back'});

let nbn = new SplitText('.line-by-line-text', {type: 'lines'});
let nbn_tl = gsap.timeline({repeat:10, repeatDelay:1});
nbn_tl.from(nbn.lines, {opacity:0, rotationX:-90, rotationY:-80, stagger:0.2, transformOrigin:'50% 50% -200'});

let mySplitText = new SplitText('.my-split-text', {type:'words'});
let splitTextTimeline = gsap.timeline({repeat: 10});
mySplitText.split({type:'chars, words, lines'})
splitTextTimeline.from(mySplitText.chars, {duration: 0.2, autoAlpha:0, scale:4, force3D:true, stagger: 0.01}, 0.5)
  .to(mySplitText.words, {duration: 0.1, color:'#8FE402', scale:0.9, stagger: 0.1}, 'words')
  .to(mySplitText.words, {duration: 0.2, color:'#eeeeee', scale:1, stagger: 0.1}, 'words+=0.1')
  .to(mySplitText.lines, {duration: 0.5, x:100, autoAlpha:0, stagger: 0.2});
