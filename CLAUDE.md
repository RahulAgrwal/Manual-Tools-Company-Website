# CLAUDE.md

Marketing and lead-generation website for **Manual Tools Company** (coke oven machinery, Dhanbad). Live at https://www.manualtoolsco.com/. Plain PHP pages on a Bootstrap 5 template, with no framework, no build step and no tests.

## UI redesign in progress

A whole-site redesign is under way on branch `redesign/ui` (not yet merged; `main` auto-deploys). **`BUILD_PLAN.md` is the source of truth for it.** Updating `BUILD_PLAN.md` is a **mandatory** part of every redesign step: mark a step `[~]` before starting it and `[x]` with a one-line note when it lands, record problems in its Session log, and commit it in the same commit as the code it describes. **Every UI change must be visually verified in the browser (desktop and 390px phone width, every affected page variant and interactive state) before it is marked done** — passing checks prove content, not appearance. Read it before touching any page.

## Run locally

    php -S localhost:8080 router.php

- `router.php` does locally what `.htaccess` does in production: `/about` loads `about.php`, real files are served directly, include-only files (`header`, `footer`, `page-helpers`, …) and anything else get `404.php`. Keep the include-only list the same in both files.
- Local secrets live in `config/secrets.php` (the whole `config/` folder is git-ignored). Without it, pages still render.
- **Visitor counter:** after the page loads, `footer.php` POSTs the page key (`basename(PHP_SELF)`, e.g. `about.php`) to `/track-visit`.
  - `track-visit.php` only accepts real top-level pages that include the footer. It calls `visitor()` in `webcounter.php` (ip-api.com lookup with a 3s timeout, then MySQL) and returns `{count}`.
  - The count stays hidden if this fails. Never call `visitor()` during page rendering.

## Secrets
- **Never hard-code credentials.** Read them with `mtc_secrets()` from `load-secrets.php`, which returns an array (empty if no file is found).
- Lookup order: `MTC_SECRETS_FILE` env var, then `../config/secrets.php` (production: Hostinger folder next to `public_html`), then `./config/secrets.php` (local), then `./secrets.local.php`.
- To add a new secret, add the key to `secrets.example.php` with an empty value, and update the table in `README.md`.
- Hosting is a Hostinger shared plan (no environment-variable UI for PHP). The GitHub repo is **public**, so anything committed is exposed.
- The reCAPTCHA *site* key is public and is hard-coded in `contact.php` and `sidebar-quote-form.php`.

## URLs and links
- Links have no extension (`href="haulage"`, not `haulage.php`). `.htaccess` sends `*.php` to the address without it (301).
- The canonical host is `https://www.manualtoolsco.com`. `.htaccess` sends the bare domain to it (301). Always use `www` in absolute URLs.
- Pushing to `main` deploys to the live site automatically.
- Asset paths are relative (`assets/...`), so pages must stay at the repo root. `404.php` sets `<base href="/">` because it is also shown for nested URLs.
- `.htaccess` also redirects `/index` and `/index.php` to `/`, strips trailing slashes, sets security and cache headers, and uses `404.php` as the error page.
- `robots.txt` allows all crawlers and points to `sitemap.xml`.

## Page structure
Every page includes: `common-head.php` (loads `page-helpers.php`, CSS, and one Google tag configured for both GA4 and Google Ads) in `<head>`, `header.php` (navbar; active link from `PHP_SELF`), and `footer.php` (links, mobile call/quote bar, visitor counter, jQuery). JS files are loaded after the footer, ending with `assets/js/main.js`.

SEO basics every page needs: one `<h1>` (on non-product pages the breadcrumb title is the `<h1>`), a canonical `<link>` with the `www` URL, a meta description, and `mtc_breadcrumb_schema([...])` after `common-head.php`.

Helpers in `page-helpers.php`:
- `mtc_img($path)`: the `.webp` copy of an image if it exists, else the original. Use it for every `<img src>`.
- `mtc_thumb($path)`: the small `.thumb.webp` gallery thumbnail (product and about-us-products photos).
- `mtc_img_size($path)`: `width`/`height` attributes, so the browser reserves space.
- `mtc_breadcrumb_schema(['Products' => 'products', 'Name' => 'slug'])`: prints BreadcrumbList JSON-LD (Home is added automatically).

Font Awesome 5.15.4 is the only icon library (Boxicons and Bootstrap Icons were removed). Don't add other icon libraries or Font Awesome versions, or re-include stylesheets that `common-head.php` already loads. GLightbox CSS is loaded only by `photo-gallery.php`.

Meta tags: each page writes its own `<title>`, meta description, canonical and `og:*` tags. Keep titles at most about 65 characters and descriptions at 140–155, and keep `og:title`/`og:description` in sync with them. `common-head.php` adds `twitter:card` and `og:locale` for every page. Don't add `<meta name="keywords">`: search engines ignore it, so put target terms in the title, description, H1, opening paragraph and main image alt.

Shared parts:
- `global-products.php`: `$GLOBAL_PRODUCT_CARDS`, the master product list (image_path, title, subtitle, link slug, short_description).
- `our-products.php`: card grid built from that list (home and about pages).
- `related-products.php`: slider. Set `$current_page_slug` before including it so the current product is left out.
- `sidebar-quote-form.php`: set `$_GET['page_url']` and `$_GET['page_title']` before including it.
- `clients.php`: data arrays and a loop.
- `photo-gallery.php` builds its grid from the product image folders; `assets/js/gallery.js` does the filter and the GLightbox view (no Isotope).

## Product detail pages
`coal-crusher-5-No-single-disc`, `coal-crusher-5-No-double-disc`, `coke-cutter-double-drive`, `coke-cutter-double-drive-ring-type`, `haulage`, `power-winch`, `vibrator-screen`, `conveyor-materials`, `coal-charging-car`, `pusher-with-stamping-arrangement`.

All share one layout:
- `<head>`: canonical URL, Open Graph tags, Product JSON-LD (brand, manufacturer, url), BreadcrumbList, plus `assets/css/product.css`.
- Gallery: a main image plus `glob()` over `assets/img/product-images/<folder>/` (images and mp4/webm). An optional `gallery_labels` map in `product-data.php` (file name => label, e.g. a spare part) adds a caption under the main image and the alt text; the photo gallery uses it too. Thumbnails use `mtc_thumb()`, the main view uses `mtc_img()`, and the inline `swapImage()`/`swapMedia()` switches it.
- Spec grid and Brochure / Request Quote / Call buttons (no star ratings: there are no reviews).
- An overview section: a question-style `<h2>`, a 130–170 word answer written from the page's own specs, a link to the closest related product, and a "Buying information" box (lead time, warranty, installation, custom builds, brochure).
- Tabs (Description, Process Flow, Applications, Maintenance, FAQ), driven by `assets/js/product-tabs.js`; the FAQ is native `<details>`. Bootstrap's JS and `compat.css` are gone (redesign phase 8), so don't add `data-bs-*` markup. Don't add FAQPage markup: Google no longer shows FAQ rich results.
- Sidebar quote form, then related products, then the footer.

**Machine order:** every list of machines follows the range catalogue's machine selector, by duty: coal preparation (single disc, double disc crusher), coke sizing & screening (drum-type cutter, ring-type cutter, vibrator screen), oven operation (pusher, coal charging car, power winch), material handling (haulage, conveyor components). Insert a new machine in its duty group, in the same position everywhere.

**Adding a product:** copy an existing detail page (for example `coke-cutter-double-drive-ring-type.php`), then update all of:
1. `global-products.php`
2. the Products dropdown in `header.php`
3. `products.php` (card and filter class)
4. `$carousel_items` in `index.php`, which feeds the home-page machine picker (`image_path`, `title`, `subtitle`, `link`), plus a transparent cutout in `assets/img/slide/`; run `python tools/trim_cutouts.py` for its `.webp` and `.thumb.webp`. `assets/img/slide-thumbnail/` is no longer used.
5. `sitemap.xml`: use `https://www.manualtoolsco.com/<slug>` (www, no `.php`) to match the canonical tags
6. the image folder under `assets/img/product-images/`. Name files `<Product-Name>-N.png` (for example `Vibrator-Screen-3.png`). They show up in the product gallery and `photo-gallery.php` automatically (add the folder to `$gallery_products` there).
7. run `python tools/optimize_images.py` to create the `.webp` and `.thumb.webp` copies. Commit them with the originals.
8. a brochure: add the product to `PRODUCTS` in `brochure/generate_product_brochures.py` (including `cover_image`, `stats`, `specs` and `features`), run it, and link the PDF from the page.
9. the overview section and "Buying information" box (see above).
10. after deploying, `python tools/indexnow_submit.py /<slug>` (Bing and other IndexNow engines) and request indexing in Google Search Console.

Page copy is HTML. Use `<strong>`, not Markdown `**bold**`.

## Forms
- A form joins the shared submit flow by having class `ajax-form php-email-form`, `action="forms/contact.php"`, `data-recaptcha-site-key` and `data-recaptcha-action`. It needs `.loading`, `.error-msg` and `.sent-message` elements inside.
- `main.js` checks `[required]` fields and email format, gets a reCAPTCHA v3 token, POSTs `FormData`, and fires the GA4 `generate_lead` event plus a Google Ads conversion on success.
- `forms/contact.php` returns JSON `{success, message}`. It checks reCAPTCHA (score ≥ 0.5) and sends mail with PHPMailer over Gmail SMTP, using `vendor/autoload.php`. SMTP and reCAPTCHA credentials come from `mtc_secrets()`, and the endpoint returns a JSON error if they are missing.
- Email flow: the enquiry goes **to the company inbox** (`smtp_user`, CC the proprietor) with `Reply-To` set to the visitor. The visitor then gets a **fixed confirmation** email.
  - Never put user-supplied text in any email sent to the visitor's address, or the form becomes a spam relay.
  - Mailer errors are logged with `error_log()`. Visitors only see a generic message.

## Styling
- `assets/css/mtc.css` is the **only `:root`** in the project: design tokens, reboot, base type and the layout primitives (`.wrap`, `.section`, `.grid--2/3/4`, `.split`, `.aside`, `.flow`, `.cluster`). Shared components live here too, because more than one page uses them (`.btn`, `.product-card`, `.product-row`, `.spec-chips`, `.section-head`, `.spare-card`, `.cta-band`, form fields). `common-head.php` loads it, then `chrome.css` (header, nav, footer, mobile bars) and the Font Awesome subset, on every page.
- A page adds its own stylesheet with `$mtc_page_css` **before** including `common-head.php`: `home.css` (index), `product.css` (`product-page.php`), `hub.css` (coal-crusher), `about.css`, `contact.css`, `gallery.css` (+ GLightbox), `error.css` (404).
- **Brand colour**: `--c-action` (#D40000), with `--c-action-hover`, `--c-action-ink` and `--c-action-tint`. It is the logo's red a shade deeper, because white on the logo's own #FF0000 is 4.00:1 and fails WCAG AA at button text size; #D40000 is 5.53:1. **The logo artwork stays #FF0000.** Red is reserved for primary actions — never decoration. The focus ring is deliberately blue (`--c-focus`), so it reads as UI. Check contrast before changing any of these.
- Never hard-code a brand colour: every red on the site resolves from those four tokens, so the palette changes in one place. The legacy aliases (`--primary-color`, `--mtc-orange`, …) near the bottom of the token block point at them.
- Custom classes use the `mtc-` prefix. `legacy.css` and `legacy-product.css` are no longer loaded by any page (see `BACKLOG.md`).
- Some components (`related-products.php`, `sidebar-quote-form.php`) keep their CSS and JS inline. Follow that pattern for self-contained includes.
- Front-end libraries live in `assets/vendor/` and are loaded directly (no npm).

## Other
- `brochure/*.py`: fpdf2 scripts that build the product PDF brochures. Run them from the repo root because image paths are relative.
  - `generate_product_brochures.py` builds all ten from one `PRODUCTS` table (copy only); `brochure_layout.py` holds the page furniture. The copy is taken from the product pages, so update both when specs change.
  - Four pages: dark cover (product name, hero cutout, three headline figures), overview with a **Key specifications** box, the specification table and the Buying information box (no quotation panel: the last page carries it), process flow / applications / FAQ, then gallery and the rest of the range.
  - The Key specifications box is **not** copied into `PRODUCTS`: the script reads each page's four `specs` (icon, label, value) from `product-data.php` through the `php` CLI (`SITE_SLUG` maps brochure keys to page slugs), so it always matches the product page. Regenerate the brochures after changing a page's `specs`. Icons come from `brochure/fonts/fa-solid-900.ttf` (Font Awesome 5.15.4 Solid, converted from the site's woff2, with a blank `space` glyph added because fpdf2's subsetter needs one) and code points from `assets/fontawesome/css/icons.css`. The build stops if page 2 would run into the quotation panel.
  - Cover art comes from the home-page carousel images in `assets/img/slide/`, which are transparent cutouts. `cutout_image()` keys out a plain white backdrop too; a photo of a real scene falls back to a white panel. That one image is written with `FlateDecode` because JPEG ringing round the cut edge would show as a box on the dark cover.
  - `generate_range_catalogue.py` builds the full-range catalogue `Manual_Tools_Co_Catalogue.pdf` (30 A4 pages laid out as facing spreads: every product has its own two-page spread, then the two specification charts). It reuses `PRODUCTS`/`BUYING_INFO` and the `product-data.php` specs, writes HTML and prints it with headless Chrome or Edge (Archivo font in `brochure/fonts/`). The build fails if any page's text runs into its footer. Regenerate it whenever you regenerate the single-product brochures.
  - `generate_range_catalogue_2.py` is a separate script (no shared code with catalogue 1) for `Manual_Tools_Co_Catalogue_2.pdf`, laid out like the Honda brochure as printed: A4 cover and back cover, and fifteen A3 landscape sheets, each a double-page spread (one per product, plus intro, engineering, a full-width photo spread, the charts and spares). It adds a photo running across a full spread. Both catalogues use the same cover (the whole range on a dark stage), kept as a copy in each script, so change both together. The cover's red logo box draws the owner's full logo `assets/img/mtc-logo-full.svg` (badge, name and tagline as outlines), recoloured to white by `full_logo_svg()`. Same data sources and overflow check as catalogue 1.
  - The logo and the 30-years badge are transparent PNGs, and the JPEG image filter has no alpha, so both are composited onto their background first (`logo_image()`). Drawing them directly renders a black box.
- `tools/optimize_images.py` (Pillow): WebP copies (max 1600px) and 320px gallery thumbnails next to the originals. Originals stay because the brochure scripts use them. It skips `assets/img/slide/` (`TRIM_OWNED`), which `trim_cutouts.py` owns.
- `tools/trim_cutouts.py` (Pillow): the transparent product cutouts in `assets/img/slide/` carry a large empty margin — the machine filled as little as 25% of its canvas — so anything sizing them by their box drew the machine at half size. This trims to the alpha bounding box plus 2% and writes the `.webp` and `.thumb.webp`. It never writes the `.png`: the brochure scripts read those and `cutout_image()` depends on the existing canvas. Run it **before** `optimize_images.py`. `--report` measures without writing.
- `tools/subset_fontawesome.py`: rebuilds `assets/fontawesome/css/icons.css` from the `fa-*` classes actually used in the PHP and JS — 95 icons instead of a map of ~1600. **Run it after adding an icon to any page**, or the new icon renders as a blank box. It prints any name it cannot resolve.
- `tools/check_pages.py` (requests): the regression oracle. Checks every page for one `<h1>`, a correct canonical, title/description presence, length and uniqueness, BreadcrumbList, Product JSON-LD with its four properties, absence of FAQPage/ratings/keywords, image `alt` and dimensions, and a 404 for every include-only partial. `--json` writes a report, `--diff` compares against an earlier one. Take a baseline before a change and diff after.
- `tools/indexnow_submit.py`: tells Bing and other IndexNow search engines that pages changed. The key file `5980cefe6f533e8fca5d87e5d37f5339.txt` in the root must stay deployed; don't delete or rename it.
  - **After every deploy that changes page content**, run it for the changed pages once the push is live: `python tools/indexnow_submit.py /haulage /about` (paths), or with no arguments to send every URL in `sitemap.xml`.
  - HTTP 202 means the request was accepted; the search engines then verify the key and crawl over the next few days.
  - Google doesn't use IndexNow: for Google, request indexing in Search Console.
  - First run: 2026-09-17, all 16 sitemap URLs, HTTP 202.
- `sitemap.xml`: update `<lastmod>` when a page's content changes. No `priority`/`changefreq` (search engines ignore them).
- `vendor/`: Composer autoloader and PHPMailer (there is no `composer.json`). Don't delete it; `forms/contact.php` depends on it.
  - `vendor/phpmailer/phpmailer` is a gitlink, not real files (see `BACKLOG.md`).
  - `assets/vendor/` holds front-end libraries only.

## Known issues / cautions
- Old credentials remain in git history (the repo is public). They must stay rotated. Don't reuse them.
- Database access in `webcounter.php` uses mysqli prepared statements. Keep it that way for any new queries.
- Only claim what the owner can back up (certificates, client counts, support hours, lead times). Product-page lead times and the contact-page FAQ must agree.
- Open work and completed fixes are tracked in `BACKLOG.md`. Update it when you finish or discover something.
