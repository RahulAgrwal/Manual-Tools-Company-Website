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
