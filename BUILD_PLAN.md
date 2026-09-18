# BUILD_PLAN.md — whole-site UI redesign

Working branch: **`redesign/ui`**. Do not merge to `main` without sign-off —
`main` deploys to the live site automatically.

Direction: **"Engineered Light"** — cool paper canvas, near-black ink, brand
orange reserved strictly for primary actions, specs presented as real data.
Tokens live in `assets/css/mtc.css`, which is the only `:root` in the project.

Status keys: `[ ]` not started · `[~]` in progress · `[x]` done.
Update the key **as you start**, so a crashed session leaves `[~]` behind.

---

## Progress

| # | Phase | Status |
|---|---|---|
| 0 | Safety net — regression oracle, baseline | `[x]` |
| 1 | Design system — tokens, type, icons, drop Bootstrap CSS | `[x]` |
| 2 | Imagery — clean cutouts, trim, product card | `[x]` |
| 3 | Global chrome — header, nav, footer | `[x]` |
| 4 | Catalogue — `products.php` driven from data | `[~]` |
| 5 | Product detail pages — template + restyle | `[ ]` |
| 6 | Home page sections | `[ ]` |
| 7 | About, contact, gallery, 404, coal-crusher hub | `[ ]` |
| 8 | Drop Bootstrap JS; delete `compat.css` | `[ ]` |
| 9 | QA sweep, Lighthouse, accessibility | `[ ]` |
| 10 | Deploy + post-deploy SEO | `[ ]` |

---

## Hard constraints

- Pages stay at the **repo root** — asset paths are relative.
- **No URL changes.** All 16 sitemap URLs keep working, extensionless, `www`.
- Every page keeps one `<h1>`, a canonical, a meta description, `og:*` and
  `mtc_breadcrumb_schema([...])`. Product pages keep their `Product` JSON-LD.
  No FAQPage, no star ratings, no `<meta keywords>`.
- Font Awesome 5.15.4 only. No second icon set, no animation library.
- The include-only 404 list must stay **identical** in `.htaccess` and `router.php`.
- No build step, no npm, no framework.
- **The form contract is frozen** — `class="ajax-form php-email-form"`,
  `action="forms/contact.php"`, `data-recaptcha-site-key`,
  `data-recaptcha-action`, and `.loading` / `.error-msg` / `.sent-message`
  inside the form. Field `name` attributes are frozen too: `forms/contact.php`
  silently drops anything it does not recognise. This is the lead-gen path.
- **`track-visit.php` greps the page file itself for `include('footer.php')`.**
  Any product-page refactor must keep that include in the page file, or the
  visitor counter dies silently on all ten pages.
- The expired ISO 9001 badge (QMS/014551/0220, expired 2023-02-04) stays exactly
  as it renders — `BACKLOG.md` records it was left on the owner's request. Do not
  remove it, do not make it more prominent.
- "Quenching Coke Car" has no page yet. It is styled as unavailable, not deleted.

---

## Phase 0 — Safety net `[x]`

- `[x]` Branch `redesign/ui` off a clean `main`.
- `[x]` `tools/check_pages.py` — the regression oracle. Asserts one `<h1>`, a
  correct canonical, title/description presence + length + uniqueness,
  BreadcrumbList, Product JSON-LD with four properties, no FAQPage/ratings/
  keywords, image `alt` and dimensions, and a 404 for every include-only partial.
- `[x]` Baseline captured: **0 failures, 26 warnings** (all pre-existing — 8
  over-long titles, missing `width`/`height` on gallery thumbs, 2 og mismatches).
  Every step since has been diffed against it; **no SEO drift so far.**

## Phase 1 — Design system `[x]`

- `[x]` `assets/css/mtc.css` — tokens, base, layout primitives. One `:root`.
- `[x]` Consolidated **four contradictory `:root` blocks**. `--mtc-dark` was
  declared both `#1a1a1a` and `#111`; `--mtc-gray-bg` resolved to `#f8f9fa` or
  `#f9f9f9` depending on whether the page happened to load the product
  stylesheet. Three more variables were used but never defined.
- `[x]` **Archivo** variable, self-hosted, 35 KB, weights 400–700, with a
  metric-matched fallback. Replaces Open Sans + Muli at twelve declared weights
  from `fonts.gstatic.com`. Tabular figures, so spec tables align without a
  second family.
- `[x]` Font Awesome self-hosted and subset by `tools/subset_fontawesome.py`:
  95 icons, **5.4 KB instead of 56.5 KB**. Solid + brands only.
- `[x]` `assets/css/compat.css` — temporary hand-written Bootstrap stand-in, so
  `bootstrap.min.css` (227 KB + a 576 KB never-served source map) could go
  immediately. **Deleting this file is the acceptance test for phase 8.**
- `[x]` `mtc_asset()` appends `?v=<filemtime>` — `.htaccess` caches CSS/JS for a
  week with unhashed filenames, so without this a returning visitor would get
  new markup with the old stylesheet.
- `[x]` Deleted the global `.container { max-width: 90% !important }`.

**Result: render-blocking CSS 358 KB across 3 origins → 136 KB from 1.**

## Phase 2 — Imagery `[x]`

- `[x]` The grids were showing scanned catalogue plates with a "MANUAL TOOLS CO."
  header, halftone background and caption strip baked into the pixels.
  `assets/img/slide/` already held a clean transparent cutout of all ten
  machines, used only by the home carousel. `global-products.php` now points there.
- `[x]` `tools/trim_cutouts.py` — the cutouts carried a large empty margin (the
  machine filled as little as **25%** of its canvas). Trims to the alpha bounding
  box + 2% and regenerates `.webp` + a 480px `.thumb.webp`. Never writes the
  `.png`; the brochure scripts read those. `optimize_images.py` skips the folder.
- `[x]` `.product-card` — machine in a recessed well at a fixed 4:3 with
  `object-fit: contain`, so a row stays level across 4:3 / 16:9 / 2.7:1 sources.
  Shows `short_description`, which was in the data but never rendered.

## Phase 3 — Global chrome `[x]`

- `[x]` `assets/css/chrome.css`; 630 lines removed from `legacy.css` (91→70 KB).
- `[x]` Utility bar demoted to a hairline rail; header white with a hairline base;
  active page marked by a rule rather than a colour change.
- `[x]` **The site had no primary action in its chrome.** "Request a quote" is now
  the single orange button in the header.
- `[x]` Footer on the dark ink surface; dropped 10 decorative chevron icons.
- `[x]` Fixed two real `main.js` bugs: the sticky header and back-to-top both
  registered a `load` listener *inside* a `load` handler, so neither fired until
  the first scroll. Header now publishes `--header-h` for an exact offset.

## Phase 4 — Catalogue `[~]`

- `[x]` `global-products.php` gains `category`, `eyebrow`, `mini_specs` and
  `long_description`, extracted from the markup they were trapped in.
- `[x]` `products.php`: ten hand-written cards → one loop. **416 → 175 lines.**
  They had already drifted from the data once. Also fixes two unescaped `<`
  characters that were invalid HTML.
- `[x]` `.product-row`, `.spec-chips`, `.filter-bar`, `.breadcrumbs` components.
- `[ ]` `coal-crusher.php` comparison hub (shares the card markup).

## Phase 5 — Product detail pages `[ ]`

The ten pages are near-literal clones — a normalised skeleton diff of
`power-winch` vs `vibrator-screen` is 12 hunks, of which 6 are icon-class swaps.
~4,900 lines total.

- `[ ]` Extract `product-data.php` + `product-page.php`; thin stub per slug.
  **Refactor to identical output first, restyle second** — with no tests, that is
  what separates a data-mapping bug from a CSS bug.
- `[ ]` Add both new names to the include-only list in `.htaccess` **and**
  `router.php`, and extend the `track-visit.php` regex in the same commit.
- `[ ]` Restyle: hero well, spec table as real data, tabs → accordion below 48rem,
  timeline, applications, maintenance, FAQ, sidebar quote card, related slider.
- `[ ]` Absorb the 360 lines of inline `<style>` from `related-products.php`,
  `sidebar-quote-form.php`, `conveyor-materials.php` and the two video pages.
- `[ ]` Collapse 8 copies of `swapImage()` and 2 of `swapMedia()` into one
  delegated listener; give the thumbs keyboard access.

## Phase 6 — Home `[ ]`

- `[ ]` Hero carousel. **LCP-critical**: keep `fetchpriority="high"` on slide 1
  and the next-slide pre-warmer; do **not** add an entry animation (an
  `opacity: 0` fade cost ~3.0 s once).
- `[ ]` Stats block — remove the dead `.counter` / `data-target` hook, or wire it.
- `[ ]` Services, strengths, clients.

## Phase 7 — Remaining pages `[ ]`

`about.php` (incl. vertical value tabs), `contact.php` (form untouched),
`photo-gallery.php` (Isotope is currently constructed **twice**), `404.php`.

## Phase 8 — Drop Bootstrap JS `[ ]`

Only tabs, collapse/accordion, carousel and fade are used. Replace with ~90 lines
(`<details name>` for the accordions), delete the 79 KB bundle, then delete
`compat.css`. Keep jQuery for now — `main.js:170-352` is the lead-gen path and
belongs in its own change.

## Phase 9 — QA `[ ]`

- `[ ]` 18 pages at 390 / 768 / 1440, no PHP notices.
- `[ ]` Lead-gen end to end: both forms, reCAPTCHA, emails, GA4 `generate_lead`,
  Ads conversion `AW-17669553737/4NI3CPisnNgbEMn8v-lB`.
- `[ ]` Visitor counter still appears on a product page (the `track-visit` trap).
- `[ ]` `check_pages.py --diff` against the phase-0 baseline.
- `[ ]` Lighthouse mobile: LCP < 2.5 s on `/`, CLS < 0.05.

## Phase 10 — Deploy `[ ]`

- `[ ]` Owner sign-off, then merge to `main` (auto-deploys).
- `[ ]` `sitemap.xml` `lastmod`; `python tools/indexnow_submit.py`; Search Console.
- `[ ]` Update `CLAUDE.md` §Styling and move finished items into `BACKLOG.md`.
