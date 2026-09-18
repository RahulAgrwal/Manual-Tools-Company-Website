/**
 * Product gallery: swap the main view when a thumbnail is chosen.
 *
 * Replaces eight byte-identical copies of swapImage() and two of swapMedia()
 * that were pasted into the product pages, plus their inline onclick=
 * attributes. One delegated listener, and the thumbnails are <button>s now,
 * so they are reachable by keyboard -- the old <div>s were not.
 */
(function () {
  'use strict';

  var display = document.getElementById('mtc-main-display');
  var grid = document.querySelector('.mtc-product-thumb-grid');
  if (!display || !grid) return;

  function show(thumb) {
    var src = thumb.getAttribute('data-full');
    if (!src) return;

    if (thumb.getAttribute('data-type') === 'video') {
      var video = document.createElement('video');
      video.src = src;
      video.controls = true;
      video.playsInline = true;
      video.className = 'img-fluid';
      video.poster = thumb.getAttribute('data-poster') || '';
      display.replaceChildren(video);
      // The click was the intent to watch it, so start playing. Autoplay can
      // be refused; that is fine, the controls are there.
      var playing = video.play();
      if (playing && playing.catch) playing.catch(function () {});
    } else {
      var existing = display.querySelector('img#mainImage');
      if (existing) {
        existing.src = src;
      } else {
        var img = document.createElement('img');
        img.id = 'mainImage';
        img.src = src;
        img.className = 'img-fluid';
        img.alt = thumb.getAttribute('aria-label') || '';
        display.replaceChildren(img);
      }
    }

    grid.querySelectorAll('.mtc-product-thumb-item').forEach(function (el) {
      el.classList.toggle('active', el === thumb);
    });
  }

  grid.addEventListener('click', function (event) {
    var thumb = event.target.closest('.mtc-product-thumb-item');
    if (thumb) show(thumb);
  });
})();
