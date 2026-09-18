/**
 * Photo gallery: filter buttons and the enlarged view.
 *
 * Replaces Isotope, which was set up twice (in main.js and inline on the
 * page), as was GLightbox. Filtering is now just the `hidden` attribute on
 * grid items; the CSS grid reflows by itself.
 */
(function () {
  'use strict';

  var buttons = document.querySelectorAll('.gallery .filter-bar button');
  var tiles = document.querySelectorAll('.gallery-tile');
  if (!tiles.length) return;

  var lightbox = null;

  // The lightbox steps through the photos currently shown, so after a filter
  // it is rebuilt from the visible tiles only.
  function buildLightbox() {
    if (typeof GLightbox === 'undefined') return;
    if (lightbox) lightbox.destroy();
    lightbox = GLightbox({ selector: '.gallery-tile:not([hidden]) .gallery-tile__zoom' });
  }

  function applyFilter(key) {
    tiles.forEach(function (tile) {
      tile.hidden = key !== '*' && tile.getAttribute('data-filter') !== key;
    });
    buttons.forEach(function (b) {
      b.setAttribute('aria-pressed', b.getAttribute('data-filter') === key ? 'true' : 'false');
    });
    buildLightbox();
  }

  buttons.forEach(function (b) {
    b.addEventListener('click', function () { applyFilter(b.getAttribute('data-filter')); });
  });

  buildLightbox();
})();
