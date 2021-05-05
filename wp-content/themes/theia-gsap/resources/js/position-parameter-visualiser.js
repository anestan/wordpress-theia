import { gsap } from 'gsap';
import { GSDevTools } from 'gsap/GSDevTools';
import { Draggable } from 'gsap/Draggable';

gsap.registerPlugin(GSDevTools);

// GSDevTools.create();

let pixelsPerSecond = 200;
let animation = gsap.timeline();
animation
  .to('#star', {duration: 2, x: 1150})
  .to('#circle', {duration: 2, x: 1150}, '+=1')
  .to('#square', {duration: 2, x: 1150});

animation.eventCallback('onUpdate', movePlayhead).paused(true);
gsap.to('svg', {autoAlpha: 1});
let time = document.getElementById('time');
let maxX = animation.duration() * pixelsPerSecond;

let children = animation.getChildren();
let numChildren = children.length;

for (let i = 0; i < numChildren; i++) {
  gsap.set('#tween' + i, {x: children[i].startTime() * pixelsPerSecond});
  gsap.set('#rect' + i, {width: children[i].duration() * pixelsPerSecond});
}

let dragger = Draggable.create('#playhead', {
  type: 'x',

  cursor: 'pointer',
  trigger: '#timeline',
  bounds: {minX: 0, maxX: maxX},
  onDrag: function () {
    animation.pause();
    time.textContent = animation.time().toFixed(1);
    animation.progress(this.x / maxX);
  }

});

function movePlayhead () {
  gsap.set('#playhead', {x: animation.progress() * maxX});
  time.textContent = animation.time().toFixed(1);
}

document.getElementById('play').onclick = function () {
  animation.play();
};

document.getElementById('pause').onclick = function () {
  animation.pause();
};

document.getElementById('reverse').onclick = function () {
  animation.reverse();
};
