# BUILD_PLAN.md — whole-site UI redesign

Working branch: **`redesign/ui`**. Do not merge to `main` without sign-off —
`main` deploys to the live site automatically.

Direction: **"Engineered Light"** — cool paper canvas, near-black ink, brand
orange reserved strictly for primary actions, specs presented as real data.
Tokens live in `assets/css/mtc.css`, which is the only `:root` in the project.

Status keys: `[ ]` not started · `[~]` in progress · `[x]` done.

---

## ⚠ Mandatory: keep this document current

**Updating this file is a required step of every piece of redesign work, not an
optional tidy-up.** A step is not finished until this document says so.

1. **Before starting a step**, set its key to `[~]`. A session that crashes or is
   interrupted then leaves an honest marker of where it stopped.
2. **When a step lands**, set it to `[x]` and add one line under it: what changed
   and which files. Record measured numbers (bytes, lines, counts), not adjectives.
3. **When something goes wrong** — a bug found, an approach abandoned, work lost
   and redone — record it in the step's notes and in the **Session log** at the
   bottom. Future sessions need to know what was tried.
4. **Update the Progress table** so it always matches the phase sections below it.
5. **Commit this file together with the code it describes**, in the same commit.
   A commit that changes the redesign without updating this file is incomplete.
6. **Visually verify every UI change before marking it `[x]`.** Passing checks
   (`check_pages.py`, content diffs, `php -l`) prove content and markup, not
   appearance — a change can pass all of them and still look broken (see phase
   5: 98 lines of styling were dropped with every check green). A UI step is
   done only after it has been **looked at in the browser**:
   - at **desktop (~1440px) and phone (390px)** width — for phone width, load the
     page in a 390px-wide iframe, because resizing the browser window does not
     change the viewport the page sees;
   - on **every page variant the change touches** (for product pages at least:
     a plain page, a video page, conveyor-materials, and a page with a process
     diagram);
   - including **interactive states** it affects — tabs, accordions, gallery
     swap, mobile menu, form validation/success;
   - and the note under the step must say **what was looked at** (pages, widths,
     states) and anything found and fixed. "Looks fine" without that is not
     verification.

`CLAUDE.md` points here, so every session picks this rule up.

---

## Progress

| # | Phase | Status |
|---|---|---|
| 0 | Safety net — regression oracle, baseline | `[x]` |
| 1 | Design system — tokens, type, icons, drop Bootstrap CSS | `[x]` |
| 2 | Imagery — clean cutouts, trim, product card | `[x]` |
| 3 | Global chrome — header, nav, footer | `[x]` |
| 4 | Catalogue — `products.php` driven from data | `[x]` |
| 5 | Product detail pages — template + restyle | `[x]` |
| 6 | Home page sections | `[x]` |
| 7 | About, contact, gallery, 404, coal-crusher hub | `[x]` |
| 8 | Drop Bootstrap JS; delete `compat.css` | `[x]` |
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
- **`track-visit.php` greps the page file itself** to decide whether a page is
  real. It accepts `include('footer.php')` or `require … 'product-page.php'`.
  Any new page shape that renders the footer some other way must be added to
  that regex, or the visitor counter dies silently on those pages.
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

## Phase 4 — Catalogue `[x]`

- `[x]` `global-products.php` gains `category`, `eyebrow`, `mini_specs` and
  `long_description`, extracted from the markup they were trapped in.
- `[x]` `products.php`: ten hand-written cards → one loop. **416 → 175 lines.**
  They had already drifted from the data once. Also fixes two unescaped `<`
  characters that were invalid HTML.
- `[x]` `.product-row`, `.spec-chips`, `.filter-bar`, `.breadcrumbs`, `.lede`
  components. Rows use the 480px thumbnail, not the ~130 KB full cutout.
- `[x]` Fixed a stylesheet order bug: `compat.css` and `mtc.css` both define
  `.btn` and compat loaded second, so Bootstrap's button won. compat now loads first.
- Committed in `98bd83d`.
- `coal-crusher.php` comparison hub moved to **Phase 7** (it is a content page,
  not a catalogue listing).

## Phase 5 — Product detail pages `[x]`

The ten pages are near-literal clones — a normalised skeleton diff of
`power-winch` vs `vibrator-screen` is 12 hunks, of which 6 are icon-class swaps.
**4,971 lines total.**

Measured structure of the ten (confirmed by the extractor, matches the survey):

| Page | Tabs | Timeline steps | App cards | Table rows | Video |
|---|---|---|---|---|---|
| coal-crusher single / double | 5 | 3 | 3 | 6 | no |
| coke-cutter double drive | 5 | 3 | 3 | 7 | no |
| coke-cutter ring type | 5 | 3 | 3 | 7 | **yes** |
| haulage | 5 | 3 | 3 | 6 | **yes** |
| power-winch | 5 | 3 | 3 | 6 | no |
| vibrator-screen | 5 | 3 | 3 | 5 | no |
| **conveyor-materials** | **3** (custom) | 0 | 0 | — | no |
| pusher | 5 | **2** | 3 | 6 | no |
| coal-charging-car | 5 | 3 | **2** | 7 | no |

- `[x]` `tools/extract_product_data.py` — one-shot migration tool. Parses the ten
  pages into `product-data.php`. Repetitive structures (spec grid, parameter
  table, timeline, application cards, maintenance lists, FAQ, trust badges)
  become real fields; bespoke prose stays an HTML string so it reproduces
  exactly. conveyor's two bespoke tabs are kept as raw HTML in `custom_tabs`.
- `[x]` `product-page.php` — the one template. Every per-page variation is data:
  tab list, step/card counts, process diagram, video gallery. The Product JSON-LD
  `additionalProperty` is generated from the same data, so the schema can no
  longer drift from the page.
- `[x]` `assets/js/product-gallery.js` — replaces **8 byte-identical copies of
  `swapImage()` and 2 of `swapMedia()`** with one delegated listener. Thumbnails
  are `<button>`s now, so they are keyboard-reachable (the old `<div>`s were not).
  Videos get `preload="none"`.
- `[x]` Include-only 404 list gains `product-data` and `product-page` in
  **both** `.htaccess` and `router.php` (kept identical).
- `[x]` `track-visit.php` accepts a page that `require`s `product-page.php`, not
  only one that `include`s `footer.php`, and explicitly rejects
  `product-page.php` itself. **Tested against the real code** (the validation
  block is lifted out of the file and run): 15/15 cases correct — all ten stubs
  and the plain pages counted; template, data file, partials and a path
  traversal attempt rejected.
- `[x]` **Refactor verified equivalent: 10/10 pages.** Checked per page: title,
  description, canonical, `og:title`, `og:image`, h1, Product JSON-LD (name, sku,
  url, description, image and all four `additionalProperty` values), gallery
  thumbnail count, and every sentence of body copy inside `<main>`.
  Verification caught **six real bugs** before anything was committed:
  1. **Double escaping.** Values were stored with their HTML entities and escaped
     again by the template → `&amp;amp;` in the `<title>`/`<h1>` of conveyor and
     vibrator-screen. Fix: escaped fields are stored decoded (`text()` helper).
  2. **Lost lead image on the two video pages.** They build a `$mediaList`
     instead of naming `$specificMainImage`. Fix: extractor reads both forms.
  3. **Process diagram silently dropped on three pages.** It lives in the
     *process-flow* tab beside the timeline, with an overlay caption — not in the
     description tab where the extractor looked. Fix: extracted from the flow
     tab with its caption and original alt text; rendered in the same two-column
     layout. (This is also why the other seven pages' timelines sit in a
     half-width column with nothing beside it.)
  4. **Step label.** haulage numbers its timeline "Stage 01", not "Step 01". Now data.
  5. **Model label.** conveyor says "Category: MTC-CM-SERIES", not "Model:". Now data.
  6. **Visitor counter would have died on all ten pages.** The first
     `track-visit.php` regex expected a quote straight after `require`, but the
     stubs write `require __DIR__ . '/product-page.php'`. Caught only because the
     real code was tested. Fixed as above.
- `[x]` Swapped in the stubs. **Product page files: 4,971 → 70 lines.**
  `product-page.php` ~430 lines, `product-data.php` ~102 KB of pure data.
- `[x]` All 17 pages render via the PHP CLI with **zero PHP errors and exactly
  one `<h1>`**; every `.php` file lints clean. Include-only 404 list verified
  identical in `.htaccess` and `router.php`, and blocks the two new names.
- `[x]` The extractor refuses to run once the pages are stubs (tested). From now
  on **`product-data.php` is the source of truth and is edited by hand.**
- `[x]` `check_pages.py --diff` over HTTP (dev server restarted at the user's
  request): **0 failures, no changes to any title, canonical, h1, description or
  JSON-LD type across all 16 pages** vs the phase-0 baseline. It caught two
  small regressions first, both fixed:
  - Gallery thumbnails had been given `alt=""` with the name on the button. That
    dropped descriptive alt text the old pages had ("Door Lifting Power Winch
    photo 2"), which Google Images indexes. Restored; the button now takes its
    accessible name from the alt, and thumbnails gained `width`/`height`.
    Missing-dimension warnings on product pages fell 11 → 8; the remaining 8 are
    the related-products slider, which lacked them before this work.
  - The `<h1>` lost the space before its `<br>`, so text extraction read
    "Pusher MachineWith Stamping". Restored exactly as the original had it.
- `[x]` **Regression found after commit:** the originals carried page-specific
  inline `<style>` in `<head>` — 60 lines for conveyor's component grid, 19 for
  the video play overlay on haulage and ring-type. The extractor read only the
  body, so `cd70f92` **dropped 98 lines of styling**; conveyor's first tab and
  the two video overlays render unstyled. The equivalence check compared text
  and structure, so it could not see it. Fixed in the restyle below (the rules
  move into `product.css`). Lesson: an equivalence check must say what it does
  *not* cover — this one covered content, not presentation.
- `[x]` **Design research before the restyle** (user asked that UI skills be used):
  - `ui-ux-pro-max` — targeted `--domain ux` queries (a full design system was
    not regenerated; the approved one stands). Two queries missed and were
    retried narrower per the skill's contract. Verified findings that apply:
    *Input Labels (High)* — every field needs a visible label, placeholder is not
    a label; *Input Types / autofill* — `autocomplete` so phones autofill;
    *Target Size (WCAG 2.2, High)* — 24 CSS px minimum; *Compact label overflow
    (High)* — chips stay on one line; *focus-not-obscured* — the sticky header
    must not cover an anchored/focused target; *srcset (High)* — mobile should not
    download the 1600px hero; *number-tabular* — already done.
  - **Audit of the real quote form against those:** no `<label>` at all
    (placeholder-only), no `autocomplete`, reassurance text at 10px. It is the
    lead-gen path. All fixable without touching the frozen form contract.
  - **Mobbin** — forms (Vercel, Wise, Tempo, YLLW): labels above fields; Tempo
    tags the *optional* fields rather than starring required ones, and states
    what happens next beside the form. FAQ (Shopify, Patreon, Hims): hairline
    rules between questions, plus/minus at the right, no boxed cards.
  - 21st.dev skipped at the user's request.
- `[x]` **Restyle landed** — `assets/css/product.css` replaces `legacy-product.css`
  on the ten pages. Hero well with the clean cutout, specs as a hairline data list,
  one orange action, labelled quote form (visible labels, `autocomplete`,
  "optional" tags), hairline FAQ with +/−, scrolling tab bar on phones,
  timeline, applications, maintenance note, related row on the shared
  `.product-card`. Inline `<style>`/`<script>` removed from
  `sidebar-quote-form.php` and `related-products.php`; related arrows move by one
  measured card. Footer "Designed by" credit removed (user request); the visitor
  counter span it shared a `<div>` with is kept intact.
- `[x]` **Visually verified** (rule 6) in an isolated headless Chrome, real
  viewports:
  - **Desktop 1440:** power-winch (hero, actions, overview, all five tabs, form
    error state, related row + arrows, footer); haulage (video thumbnails, a video
    playing in the well, swap back to a photo); conveyor (both custom tabs);
    coal-crusher single disc (diagram beside the timeline).
  - **Phone 390 (`isMobile`, touch):** power-winch (hero, specs/actions, tab
    bar, form, related row, mobile menu + Products submenu); ring-type (flow tab,
    diagram stacked); conveyor (component cards stacked).
  - **All ten product pages at 390**, programmatically: layout width exactly
    390, full-width well, one h1, no PHP errors. **The other seven pages** at
    390 and 1440: no overflow, 41px utility bar, light breadcrumb rail, white
    header-button text, one h1 each.
  - States exercised: every tab, FAQ one-open-at-a-time + `aria-expanded`,
    gallery image↔video swap + `aria-pressed`, empty-form submit (nothing sent),
    related arrows to the end (disabled states), mobile menu open/close + body
    scroll lock, back-to-top per width.
- **Visual verification found 17 defects that every automated check passed.**
  All fixed. Five were in phases already marked `[x]` — recorded here because
  that is exactly what rule 6 exists to catch:
  1. *(phase 3)* Utility bar rendered **~160px tall**: legacy
     `section { padding: 60px 0 }` hit `#topbar`, which is a `<section>`.
  2. *(phase 3)* Header "Request a quote" was **orange text on orange** — the
     `#navbar … a` colour rule's id selector outranked `.btn--primary`.
  3. *(phase 4)* Breadcrumb bar **still the dark band** — legacy `.breadcrumbs`
     rules load after mine. Block deleted.
  4. Hero still led with the **watermarked plate**; now the clean cutout (plate
     stays as `og:image`, so social previews and JSON-LD are unchanged).
  5. Machine **cropped** in the well: `max-height: 100%` does not resolve
     against an `aspect-ratio` box. Fixed with absolute positioning.
  6. Back-to-top **solid orange** from a legacy rule. Deleted.
  7. Legacy **mobile call/quote bar** block overrode chrome.css (dark-brown call
     button, wrong spacing). Deleted.
  8. Legacy `section { overflow: hidden }` **silently disables `position:
     sticky`**. Neutralised on rebuilt sections (class selectors outrank it).
     The quote form is sticky and unclipped; it only travels when the tab
     column is taller than the form (806px) — correct, not a bug.
  9. Applications: three cards wrapped **2 + 1**. Minimum width lowered.
  10. *(phase 2)* **Product-card image areas unequal heights** on home, about
      and related — `aspect-ratio` is only a preferred ratio, a tall image grew
      its box. Phase 2 had misattributed this to flex-shrink. Same fix as 5;
      now all 203px.
  11. *(phase 3)* Footer contact rows had **lost their layout** when the legacy
      footer CSS was removed; the long email overflowed the column.
  12. **Phone layout was 627px wide**, not 390: grid items default to
      `min-width: auto`, so the 610px tab row stretched the column and mobile
      Chrome zoomed the page out to fit. Fixed with `minmax(0, 1fr)`. (The first
      overflow check measured against the inflated width and reported nothing.)
  13. Phone tab bar **hid three of five tabs** with no cue. Tighter gap and a
      narrower fade so the next tab visibly peeks out.
  14. Back-to-top **covered the message field** on phones; hidden below 48rem.
      Its `d-flex` utility class (`!important` in compat.css) had first defeated
      the rule; removed from the markup on 7 pages.
  15. Mobile call/quote bar **sat on top of the open menu**; hidden while open.
  16. **Breadcrumb `<h1>` near-invisible white** on about, products, contact,
      photo-gallery and coal-crusher — a *second* legacy `.breadcrumbs h1 {
      color: #fff }` rule later in legacy.css. Deleted.
  17. Contact page: long email **overflowed its card** after the container width
      change. `a[href^="mailto:"] { overflow-wrap: anywhere }` site-wide.
- `[x]` **Fixes 16 and 17 visually re-checked** after the user restarted the
  server and browser: contact page at 1440 — breadcrumb h1 dark `#10161C` at
  36px, both email addresses wrap inside their cards (22px and 31px clear);
  about, products, contact, photo-gallery and coal-crusher at 390 — h1 dark, no
  horizontal overflow. `#CC3202` confirmed on the header button.
- (Superseded note, kept for the record:) **Fixes 16 and 17 were applied but not yet looked at.** The dev server and
  the headless Chrome were both stopped by Claude Code (machine low on memory)
  right after the screenshot that revealed them; neither is restarted without
  the user's go-ahead. Verified so far only by CLI render (every page renders,
  zero PHP errors, exactly one h1) and by grep (no legacy breadcrumb rule left).
- **Decisions made during verification:** tabs scroll on phones (not an
  accordion); back-to-top hidden on phones; the watermarked plate is dropped from
  the gallery (the cutout leads); main.js's own required-field message never
  shows because native HTML validation fires first — the original form behaved
  the same, and the form layer is frozen, so left as-is.
- `[ ]` Absorb the 360 lines of inline `<style>` from `related-products.php`,
  `sidebar-quote-form.php`, `conveyor-materials.php` and the two video pages.

## Design driver: `ui-ux-pro-max --design-system` (run 2026-09-18)

Run at the user's request, as a design driver rather than only a guideline
search. Query: *B2B industrial heavy machinery manufacturer lead generation*,
variance 6, density 4. What was taken, and what was not:

- **Palette — confirms the approved direction.** It proposed navy-slate
  `#0F172A`/`#334155` on `#F8FAFC` with the accent reserved for the CTA: within
  a shade of our ink `#10161C` on `#FAFBFC` and our orange rule. Its CTA hue is
  blue; **brand orange stays** (hard constraint, owner sign-off needed to change).
- **Type — not adopted.** It proposed Roboto, reasoning "Material Design 3,
  Android apps": a generic default for the wrong subject. Archivo stays.
- **Page pattern — adopted for the home page:** *Trust & Authority +
  Conversion* — credibility hero → proof (clients, stats) → solutions → clear
  quote path. Caution: it lists "certs" as proof; the ISO certificate expired in
  2023 and is left as-is on the owner's request, so it is **not** promoted.
- **Its pre-delivery checklist found two real WCAG AA failures** in the tokens:
  - `--c-ink-3 #8A949E` measured **2.75–3.08:1** on our backgrounds (AA needs
    4.5 for 13–15px text: captions, breadcrumb trail, table headers, "optional"
    tags). `[x]` Changed to **`#63707C`: 4.52–5.07:1**. Seen in the browser in
    phase 6 (captions, breadcrumb trail, card eyebrows at 390 and 1440px).
  - White on brand orange `#F03C02` is **3.92:1** — AA only for large text; the
    buttons are 15px bold. `[x]` **Owner decision (2026-09-18): use `#CC3202`**
    (5.22:1) — `--c-action` changed; hover deepens to `#A82901`. The logo keeps
    `#F03C02`. Seen in the browser in phase 6 (nav button, hero and CTA
    buttons, mobile quote bar).
  - Also noted: focus ring 2px (it suggests 3–4px) — **still open, moved to
    phase 9**. Filter pills: measured **45px** tall at 390px in phase 6, so the
    44px touch target is met; nothing to do.

## Phase 6 — Home `[x]`

Structure from the design driver's *Trust & Authority + Conversion* pattern:
hero → proof → about → machinery → services → reasons → clients → quote band.
`index.php` body 638 → 335 lines; new `assets/css/home.css`, `assets/js/home.js`.

- `[x]` **Hero: the ten-slide auto-rotating carousel is replaced by a machine
  picker.** The h1 sits at the top (text unchanged). One stage well shows a
  machine; ten thumbnails below swap it in place (`home.js`: swaps src, alt,
  links and caption; preloads on hover/focus; 120 ms fade, none under reduced
  motion; `aria-current`). Each thumbnail is a real link, so it works without
  JS and for crawlers. Nothing moves on its own. LCP: the stage image keeps
  `fetchpriority="high"`, no entry animation. `$carousel_items` still feeds it;
  the unused `lqip_path` keys were removed.
- `[x]` **Bootstrap JS no longer loaded on home** (the carousel was its last
  user there): −79 KB on the busiest page. Home loads `home.js` + `main.js`.
- `[x]` Stats → a `<dl>` proof band of the four existing figures (no new claims,
  no counting animation); the dead `.counter` / `data-target` hook is gone.
- `[x]` About, services (5 items), "Why choose MTC" (6 items, no 01–06
  numerals: not a sequence), quote band on the ink surface. ISO lines kept at
  their existing weight (owner's call, see BACKLOG).
- `[x]` `clients.php`: one logo wall (domestic + international with a tag +
  "And many more" cell). Data arrays untouched. Styles in `mtc.css` because the
  about page includes it too.
- **Visually verified** (headless Chrome, 1440×900 and 390×844 mobile/touch):
  home — every section at both widths, picker by mouse and by touch tap (stays
  on `/`, image/name/link/active state all change, stage height constant
  471px at 390); about — product grid and client wall at both widths; products
  — catalogue rows and filter tap at 390. No broken images, no horizontal
  scroll. `check_pages.py --diff`: 0 failures, 14 warnings (was 26), no SEO drift.
- **Defects found by looking, and fixed:**
  1. Picking a machine with a one-line description shrank the stage and the
     vertically centred hero moved the headline ~12px → `align-items: start` +
     caption reserves two lines.
  2. Client wall: 1px-gap hairline trick painted the empty end of the last row
     solid grey → per-cell borders.
  3. Quote band merged into the (same-colour) footer → a hairline between.
  4. Phone: ten full product cards were ~4,700px of scrolling → compact rows
     (6.5rem image beside the text, description clamped to 2 lines): 1,428px.
  5. …whose first version clipped the first letters of every card
     (`aspect-ratio: 1` + row height made the well wider than its column) →
     the column sets the width, no aspect-ratio. Measured: well 104px, overlap 0.
  6. Phone "Why" section 1,386px (icon on its own line) → icon beside the
     heading: 1,085px.
  7. Phone client wall ~1,070px at 3:2 cells → 2:1 cells: 804px, no logo
     overflowing its cell.
  8. **Products page (phase 4, marked done)**: at 390px every catalogue row's
     single implicit grid track was 407px in a 358px card, so text ran under
     the right edge → explicit `minmax(0, 1fr)` column. 10/10 rows now inside.

## Phase 7 — Remaining pages `[x]`

Every page is now on the design system. New page stylesheets: `about.css`,
`contact.css`, `gallery.css`, `hub.css`, `error.css`; new `assets/js/gallery.js`.
None of these five pages loads the Bootstrap bundle any more.

- `[x]` **about** — text first, the ISO certificate beside it at the 5-of-12
  width it had (not enlarged; on phones it now follows the text instead of
  opening the page). "What we stand by" as ruled items. The four Bootstrap
  vertical pill tabs (history, vision, mission, ethics) are four cards shown at
  once: three quarters of the copy was hidden behind clicks. Shared quote band.
  Copy unchanged (the "premier ... industry standard" line is flagged below).
- `[x]` **contact** — form contract unchanged (action, classes, reCAPTCHA
  attributes, every name/id/required, status elements, `#mailsubmit`). Added
  visible labels, required/optional marks and autocomplete tokens (`given-name`,
  `organization`, `tel`, `email`...); mobile number is `type="tel"`. Direct
  contact card beside the form (sticky on desktop). FAQ is native `<details
  name>` instead of Bootstrap collapse. One FAQ answer said "the form on the
  left"; it now says "above".
- `[x]` **photo-gallery** — Isotope (43 KB) and the duplicate set-up removed:
  it and GLightbox were each initialised twice (inline and in `main.js`
  section 6, now deleted). CSS grid (2/3/4 columns) + `gallery.js` toggling
  `hidden`; the lightbox is rebuilt from the visible photos after a filter.
  Filters are real `<button>`s with `aria-pressed` and counts. All 59 photos
  have width/height (was a check_pages warning).
- `[x]` **coal-crusher hub** — comparison as a real table (row headers,
  caption), the two models as the catalogue's `.product-row` with the clean
  cutouts instead of the watermarked photos, shared quote band.
- `[x]` **404** — tokens only (was inline styles and a hard-coded red), and a
  list of the ten machines. Still HTTP 404 and `noindex`; checked at a nested
  URL (`/does/not/exist`) so `<base href="/">` still resolves the assets.
- Shared moves: the quote band is `.cta-band` in `mtc.css` (was `.home-cta` in
  `home.css`); `.field` / `.form-status` moved from `product.css` to `mtc.css`;
  `.filter-bar` also styles `<button>`s and has a 44px minimum height.
- Owner request, same session: the **phone menu opens with Products expanded**
  (`main.js` section 3); tapping Products still folds it, and closing the menu
  resets it.
- **Visually verified** (1440 and 390 mobile/touch): about, contact (empty
  submit -> browser validation as before; FAQ exclusivity), gallery (filter,
  lightbox with 12 slides after filtering, touch tap), hub (table fits 390 with
  no scroll), 404 (nested URL), plus regressions from the shared moves: the
  haulage quote form and the home quote band. check_pages: 0 failures,
  12 warnings (was 14), no SEO drift.
- **Defects found by looking, and fixed:** the contact section was named
  `.contact`, which pulled in old template rules (`.contact .php-email-form`:
  white card, shadow, padding) from legacy.css -> renamed `.contact-page`;
  gallery tiles used `object-fit: cover` and cut tall shots to a sliver ->
  `contain` in a well; the hub table caption rendered under the table (Bootstrap
  reboot's `caption-side: bottom`) -> `top`; about headline broke as
  "designed and / built" -> wider measure; phone history cards 1,575px -> icon
  beside heading, 1,428px; gallery pills 42px -> 44px.
- Not changed, for the owner: the about intro says "premier manufacturer" and
  "set the industry standard"; the vision says "top-of-the-chart company".
  These are the site's existing words; CLAUDE.md asks to claim only what the
  owner can back up.

## Phase 8 — Drop Bootstrap JS `[x]`

No page loads Bootstrap any more (JS or CSS), and **`compat.css` is deleted**
(11.7 KB) — the acceptance test the migration set itself in phase 1.
jQuery stays for now: `main.js` uses it for the lead-gen form path, which
belongs in its own change.

- `[x]` Product pages: Bootstrap's tab plugin -> `assets/js/product-tabs.js`
  (47 lines, WAI-ARIA tabs: roving tabindex, Left/Right/Home/End, inactive
  panels `hidden`). FAQ collapse -> native `<details name="product-faq">`.
  Bundle removed from `product-page.php` and `products.php` (which never used it).
- `[x]` `compat.css` inventory (scripted: every class it defines, grepped across
  the PHP and JS). Still used were only the breadcrumb bar's `container d-flex
  ...` (5 pages -> `.wrap`, already styled by mtc.css), the footer's
  `row`/`col-*`/utilities (-> `.footer-grid__cols` grid in chrome.css), one
  `text-center mt-5` (-> `.our-products__more`), and the tab/collapse classes
  above. The Reboot rules moved to the top of mtc.css (minus `caption-side:
  bottom`, so the hub table no longer needs its override).
- **Visually verified**: all 17 pages (16 + a nested 404) swept at 1440 and 390
  — no horizontal overflow, no broken images, one h1, footer 4 / 1-2 columns,
  `bootstrap` undefined, no compat.css, exactly one visible tab panel on every
  product page. Screenshots: haulage tabs (click, arrow keys, End) and FAQ at
  1440; conveyor-materials' bespoke tabs and component grid; vibrator-screen
  tabs and FAQ by touch at 390; footer at both widths; contact breadcrumb bar
  at 390. check_pages: 0 failures, 12 warnings, no SEO drift.
- **Defects found by looking, and fixed:** the tab focus ring lost its top and
  bottom (clipped by the scrolling row) -> drawn inside the button; on phones
  the selected last tab (FAQ) stayed half under the edge fade -> trailing
  padding + scroll padding on the row; FAQ questions stayed orange after a tap
  (sticky :hover on touch) -> hover colour only under `(hover: hover)`, on the
  product and contact FAQs; phone footer 1,296px -> the two link lists side by
  side, 1,032px. Bonus: the footer bottom bar's flex rule never matched before
  (the `.container` was the bar itself); copyright and visitor count now sit
  at opposite ends on desktop.

## Phase 9 — QA `[ ]`

- `[ ]` 18 pages at 390 / 768 / 1440, no PHP notices.
- `[ ]` Lead-gen end to end: both forms, reCAPTCHA, emails, GA4 `generate_lead`,
  Ads conversion `AW-17669553737/4NI3CPisnNgbEMn8v-lB`.
- `[ ]` Visitor counter still appears on a product page (the `track-visit` trap).
- `[ ]` `check_pages.py --diff` against the phase-0 baseline.
- `[ ]` Lighthouse mobile: LCP < 2.5 s on `/`, CLS < 0.05.
- `[ ]` Focus ring 2px → 3px (design-driver finding).
- `[ ]` Catalogue on phones is ~9,300px (746px per row); consider the compact
  row treatment used on home.

## Phase 10 — Deploy `[ ]`

- `[ ]` Owner sign-off, then merge to `main` (auto-deploys).
- `[ ]` `sitemap.xml` `lastmod`; `python tools/indexnow_submit.py`; Search Console.
- `[ ]` Update `CLAUDE.md` §Styling and move finished items into `BACKLOG.md`.

---

## Session log

Newest first. One entry per session or per notable event: what was done, what
went wrong, what the next session should pick up. Required — see the rule at the top.

### 2026-09-18 — session 2, part 7 (phase 8)
- Session resumed after a usage-limit pause; dev server and headless Chrome
  had stopped with the old session and were restarted on the user's "continue".
- Phase 8 done (details above). Next: phase 9 (QA sweep, Lighthouse, lead-gen
  end to end).

### 2026-09-18 — session 2, part 6 (phase 7)
- Owner requests handled first: catalogue cards checked against every product
  page (5 fixes), pusher is for stamp-charged ovens everywhere, Key
  specifications box in the brochures (read from product-data.php), no
  quotation panel on brochure page 2, footer map in full colour. All committed
  and pushed to `origin/redesign/ui` (not merged).
- Phase 7 done (details above). Also: phone menu opens with Products expanded.
- Next: phase 8 (Bootstrap JS off the product pages and products.php, then
  delete compat.css).

### 2026-09-18 — session 2, part 5 (home page, phase 6)
- User chose `#CC3202` for the action colour; applied and seen in the browser.
- Home rebuilt (details and the eight defects found by looking: phase 6).
  Carousel → machine picker; Bootstrap JS dropped from home.
- The owed phone-width retro check of phases 1–4 was done for home, about and
  products; it caught a real overflow on the products page (phase 6, item 8).
- Next: phase 7 (about, contact, gallery, 404, coal-crusher hub).
- Owner asked for the footer map in full colour: removed phase 3's greyscale +
  60% opacity (`chrome.css`) and an inline `opacity: 0.8` left in `footer.php`
  from the old template. Seen at 390px (home) and 1440px (about): filter none,
  opacity 1.

### 2026-09-18 — session 2, part 4 (restyle + visual verification)
- Product pages restyled; design research first (`ui-ux-pro-max` UX queries,
  Mobbin forms + FAQ; 21st.dev skipped per the user).
- The user added **rule 6: visually verify every UI change before marking it
  done**. Applying it immediately found **17 defects that all automated checks
  had passed**, five of them in phases already marked `[x]`. Listed in phase 5.
- The Chrome extension was not connected in this session, so verification used
  an **isolated headless Chrome** (separate throwaway profile in the scratchpad,
  user's own browser untouched) driven by the chrome-devtools tools — which
  also gives real 390px mobile viewports, better than the iframe workaround.
- Dev server and headless Chrome were **both stopped for low memory** at the end.
  Two fixes (breadcrumb h1 colour, contact email wrap) await a visual re-check.
- User asked for the remaining UI to be **new and modern, driven by the
  `ui-ux-pro-max` skill**. Next: run its `--design-system` generator as a design
  driver (not only its UX guideline search), reconcile with the approved
  Engineered Light direction, then apply to home and the remaining pages.
- Also still owed: retroactive **visual** check of phases 1–4 pages at 390px
  (numeric checks passed; screenshots not yet taken at phone width for home,
  about, products).

### 2026-09-18 — session 2, part 3
- Dev server restarted at the user's request; `check_pages.py --diff` run over
  HTTP: zero SEO drift. Fixed the thumbnail alt and h1 spacing regressions it found.
- User: **skip 21st.dev**; use the other UI skills. Next: `ui-ux-pro-max`,
  `frontend-design` and targeted Mobbin research, then the product-page restyle.

### 2026-09-18 — session 2, part 2 (refactor verified and committed)
- Refactor reached **10/10 equivalent**. Six real bugs found by verification and
  fixed before commit — listed in Phase 5. The worst was the visitor-counter
  regex, which would have stopped counting all ten product pages silently.
- **The comparison tool was itself wrong at first.** It read multi-line
  `content=` attributes as empty, did not decode entities, and counted a class
  name that also appeared inside the old inline scripts, reporting 0/10 when
  most pages were fine. It was rewritten on a real HTML parser, reading text
  from `<main>` only. Lesson: verify the verifier before trusting a failure.
- An earlier test of `track-visit.php` retyped its regex instead of running the
  file's own code, so it shared the bug it was meant to catch. The test now
  lifts the validation block out of the real file.
- Content quirk found, **not changed**: the ring-type coke cutter shows the
  drum-type cutter's process diagram (`coke-cutter/process-diagram.jpg`) although
  its own folder has one. Logged in `BACKLOG.md` for the owner to decide.
- The user asked whether UI skills had been used. Honest answer recorded:
  Mobbin (3 searches, planning only) and `frontend-design` — yes; `ui-ux-pro-max`
  and 21st.dev — not yet. **Next:** run `ui-ux-pro-max` and targeted Mobbin
  research *before* writing the product-page restyle CSS.

### 2026-09-18 — session 2 (product detail pages)
- Built `tools/extract_product_data.py`, `product-page.php`, `product-data.php`
  and `assets/js/product-gallery.js`; updated both 404 lists and `track-visit.php`.
- Content diff of the first render caught **double-escaped entities** and a
  **missing lead image on the two video pages**. Both fixed in the extractor.
- **Mistake, recovered:** the extractor was re-run *after* the ten pages had been
  replaced by stubs, so it read the stubs and wrote an empty `product-data.php`.
  The originals were restored from git (`git checkout HEAD -- <10 files>`).
  Guard to add: the extractor must refuse to write when it finds stubs, so this
  cannot silently happen again.
- The local dev server was stopped by Claude Code because the machine ran low on
  memory. Verification now renders pages with the PHP CLI
  (`php <slug>.php > out.html`) instead, which needs no server.
- The user made keeping this document current a **mandatory** step; the rule is
  at the top of this file and referenced from `CLAUDE.md`.
- **Next:** add the extractor guard, re-extract, reach 10/10 equivalent, swap in
  the stubs, `check_pages.py --diff`, commit; then restyle.

### 2026-09-18 — session 1 (phases 0–4)
- Five commits on `redesign/ui`: `40c13be` oracle, `b45abe0` design system,
  `b98784f` imagery, `8bb12fe` chrome, `98bd83d` catalogue.
- Render-blocking CSS 358 KB / 3 origins → 136 KB / 1 origin. Zero SEO drift.
- A read-only Explore subagent from the start of the session kept re-sending a
  stale pre-implementation report and claimed the user had granted it
  auto-permissions. That was not acted on; work stayed on the branch.
