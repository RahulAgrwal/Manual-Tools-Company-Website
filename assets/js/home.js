/**
 * Home page: the machine picker in the hero.
 *
 * Replaces the Bootstrap carousel and the 64-line inline script that drove its
 * thumbnail strip. Nothing rotates on its own; the visitor picks a machine and
 * the stage shows it. Each picker item is a real link, so without JavaScript
 * (or for a crawler) it simply goes to that product's page.
 */
(function () {
  'use strict';

  var picker = document.querySelector('.home-picker');
  var img = document.getElementById('home-well-img');
  var well = document.getElementById('home-well');
  var link = document.getElementById('home-well-link');
  var name = document.getElementById('home-well-name');
  var sub = document.getElementById('home-well-sub');
  if (!picker || !img) return;

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Warm the full-size image as soon as the visitor shows interest, so the
  // swap is instant rather than a blank well while it downloads.
  function warm(item) {
    if (item.dataset.warmed) return;
    item.dataset.warmed = '1';
    var pre = new Image();
    pre.src = item.dataset.full;
  }

  function select(item) {
    var apply = function () {
      img.src = item.dataset.full;
      img.alt = item.dataset.title;
      well.href = link.href = item.getAttribute('href');
      name.textContent = item.dataset.title;
      sub.textContent = item.dataset.sub;
      img.classList.remove('is-swapping');
    };
    picker.querySelectorAll('.home-picker__item').forEach(function (el) {
      var on = el === item;
      el.classList.toggle('is-active', on);
      el.setAttribute('aria-current', on ? 'true' : 'false');
    });
    if (reduceMotion) { apply(); return; }
    img.classList.add('is-swapping');
    setTimeout(apply, 120);
  }

  picker.addEventListener('click', function (event) {
    var item = event.target.closest('.home-picker__item');
    if (!item) return;
    event.preventDefault();
    if (!item.classList.contains('is-active')) select(item);
  });
  picker.addEventListener('pointerover', function (event) {
    var item = event.target.closest('.home-picker__item');
    if (item) warm(item);
  });
  picker.addEventListener('focusin', function (event) {
    var item = event.target.closest('.home-picker__item');
    if (item) warm(item);
  });
})();

/**
 * Proof band: the four figures count up from 0 when the band scrolls into
 * view (owner request, 2026-09-18).
 *
 * The real figure stays in the HTML, so search engines, screen readers and
 * visitors without JavaScript get "150+", never "0". The moving number is an
 * aria-hidden copy beside a visually hidden final one. With reduced motion
 * requested, nothing animates.
 */
(function () {
  'use strict';

  var figures = document.querySelectorAll('.home-proof dd');
  if (!figures.length || !('IntersectionObserver' in window)) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var DURATION = 1400;
  var items = [];

  figures.forEach(function (dd) {
    var m = dd.textContent.trim().match(/^(\d+)(.*)$/);
    if (!m) return;
    var target = parseInt(m[1], 10), suffix = m[2];
    var shown = document.createElement('span');
    shown.setAttribute('aria-hidden', 'true');
    shown.textContent = '0' + suffix;
    var real = document.createElement('span');
    real.className = 'sr-only';
    real.textContent = dd.textContent.trim();
    dd.textContent = '';
    dd.appendChild(shown);
    dd.appendChild(real);
    items.push({ el: shown, target: target, suffix: suffix });
  });
  if (!items.length) return;

  function run() {
    var start = null;
    function frame(now) {
      if (start === null) start = now;
      var t = Math.min((now - start) / DURATION, 1);
      var eased = 1 - Math.pow(1 - t, 3);   // ease-out: fast start, gentle landing
      items.forEach(function (it) {
        it.el.textContent = Math.round(it.target * eased) + it.suffix;
      });
      if (t < 1) requestAnimationFrame(frame);
    }
    requestAnimationFrame(frame);
  }

  // All four together, once, when most of the band is on screen.
  var io = new IntersectionObserver(function (entries) {
    if (entries.some(function (e) { return e.isIntersecting; })) {
      io.disconnect();
      run();
    }
  }, { threshold: 0.6 });
  io.observe(document.querySelector('.home-proof'));
})();
