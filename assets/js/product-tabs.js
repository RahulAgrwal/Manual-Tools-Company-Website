/**
 * Product page tabs (Description, Process Flow, Applications, Maintenance,
 * FAQ). Replaces Bootstrap's tab plugin, which was the last reason the
 * product pages loaded the 79 KB Bootstrap bundle.
 *
 * WAI-ARIA tabs pattern: the selected tab is the only one in the tab order;
 * Left/Right move between tabs and select them, Home/End jump to the ends.
 * Inactive panels carry the `hidden` attribute.
 */
(function () {
  'use strict';

  var list = document.querySelector('.pd-tabs[role="tablist"]');
  if (!list) return;
  var tabs = Array.prototype.slice.call(list.querySelectorAll('[role="tab"]'));

  function select(tab, focus) {
    tabs.forEach(function (t) {
      var on = t === tab;
      t.classList.toggle('active', on);
      t.setAttribute('aria-selected', on ? 'true' : 'false');
      t.tabIndex = on ? 0 : -1;
      var panel = document.getElementById(t.getAttribute('aria-controls'));
      if (panel) panel.hidden = !on;
    });
    if (focus) tab.focus();
    // On a phone the tab row scrolls sideways; keep the chosen tab in view.
    tab.scrollIntoView({ block: 'nearest', inline: 'nearest' });
  }

  list.addEventListener('click', function (e) {
    var tab = e.target.closest('[role="tab"]');
    if (tab) select(tab, false);
  });

  list.addEventListener('keydown', function (e) {
    var i = tabs.indexOf(document.activeElement);
    if (i < 0) return;
    var next = null;
    if (e.key === 'ArrowRight') next = tabs[(i + 1) % tabs.length];
    else if (e.key === 'ArrowLeft') next = tabs[(i - 1 + tabs.length) % tabs.length];
    else if (e.key === 'Home') next = tabs[0];
    else if (e.key === 'End') next = tabs[tabs.length - 1];
    if (next) {
      e.preventDefault();
      select(next, true);
    }
  });
})();
