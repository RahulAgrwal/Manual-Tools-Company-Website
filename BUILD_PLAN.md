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
| 5 | Product detail pages — template + restyle | `[~]` |
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

## Phase 5 — Product detail pages `[~]`

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
- `[ ]` `check_pages.py --diff` over HTTP — needs the dev server, which is down
  (see Session log). The same SEO fields were verified per page above.
- `[ ]` Restyle: hero well, spec table as real data, tabs → accordion below 48rem,
  timeline, applications, maintenance, FAQ, sidebar quote card, related slider.
- `[ ]` Absorb the 360 lines of inline `<style>` from `related-products.php`,
  `sidebar-quote-form.php`, `conveyor-materials.php` and the two video pages.

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

---

## Session log

Newest first. One entry per session or per notable event: what was done, what
went wrong, what the next session should pick up. Required — see the rule at the top.

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
