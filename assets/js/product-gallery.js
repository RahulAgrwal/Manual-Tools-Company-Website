/**
 * Product detail page behaviour: the gallery and the related-products row.
 *
 * Gallery: replaces eight byte-identical copies of swapImage() and two of
 * swapMedia() that were pasted into the product pages, plus their inline
 * onclick= attributes. One delegated listener, and the thumbnails are
 * <button>s now, so they are reachable by keyboard -- the old <div>s were not.
 *
 * Related row: replaces an inline script in related-products.php that scrolled
 * by a hardcoded 320px while each card was 280px plus a gap. This measures the
 * card, so it cannot drift from the layout.
 */
(function () {
  'use strict';

  /* ---------------------------------------------------------------- gallery */
  var display = document.getElementById('mtc-main-display');
  var caption = document.getElementById('mtc-main-caption');
  var grid = document.querySelector('.mtc-product-thumb-grid');

  function show(thumb) {
    var src = thumb.getAttribute('data-full');
    if (!src || !display) return;

    if (thumb.getAttribute('data-type') === 'video') {
      var video = document.createElement('video');
      video.src = src;
      video.controls = true;
      video.playsInline = true;
      video.poster = thumb.getAttribute('data-poster') || '';
      display.replaceChildren(video);
      // The click was the intent to watch it. Autoplay can be refused; the
      // controls are there either way.
      var playing = video.play();
      if (playing && playing.catch) playing.catch(function () {});
    } else {
      var img = display.querySelector('img#mainImage');
      var alt = (thumb.querySelector('img') || {}).alt || '';
      if (!img) {
        img = document.createElement('img');
        img.id = 'mainImage';
        display.replaceChildren(img);
      }
      img.src = src;
      img.alt = alt;
    }

    if (caption) {
      var label = thumb.getAttribute('data-label') || '';
      caption.textContent = label;
      caption.hidden = label === '';
    }

    grid.querySelectorAll('.mtc-product-thumb-item').forEach(function (el) {
      var on = el === thumb;
      el.classList.toggle('active', on);
      el.setAttribute('aria-pressed', on ? 'true' : 'false');
    });
  }

  if (display && grid) {
    grid.addEventListener('click', function (event) {
      var thumb = event.target.closest('.mtc-product-thumb-item');
      if (thumb) show(thumb);
    });
  }

  /* ------------------------------------------------------------ related row */
  var track = document.getElementById('related-track');
  var prev = document.querySelector('[data-related="prev"]');
  var next = document.querySelector('[data-related="next"]');

  if (track && prev && next) {
    var step = function () {
      var card = track.querySelector('.product-card');
      if (!card) return track.clientWidth;
      var gap = parseFloat(getComputedStyle(track).columnGap) || 0;
      return card.getBoundingClientRect().width + gap;
    };
    var update = function () {
      var max = track.scrollWidth - track.clientWidth - 1;
      prev.disabled = track.scrollLeft <= 0;
      next.disabled = track.scrollLeft >= max;
    };
    prev.addEventListener('click', function () { track.scrollBy({ left: -step(), behavior: 'smooth' }); });
    next.addEventListener('click', function () { track.scrollBy({ left: step(), behavior: 'smooth' }); });
    track.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
  }
})();
