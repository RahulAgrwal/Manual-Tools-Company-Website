# CLAUDE.md

Marketing and lead-generation website for **Manual Tools Company** (coke oven machinery, Dhanbad). Live at https://www.manualtoolsco.com/. Plain PHP pages on a Bootstrap 5 template, with no framework, no build step and no tests.

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

Font Awesome 5.15.4 is the only icon font version (plus Bootstrap Icons and Boxicons). Don't add other Font Awesome versions or re-include stylesheets that `common-head.php` already loads.

Shared parts:
- `global-products.php`: `$GLOBAL_PRODUCT_CARDS`, the master product list (image_path, title, subtitle, link slug, short_description).
- `our-products.php`: card grid built from that list (home and about pages).
- `related-products.php`: slider. Set `$current_page_slug` before including it so the current product is left out.
- `sidebar-quote-form.php`: set `$_GET['page_url']` and `$_GET['page_title']` before including it.
- `clients.php`: data arrays and a loop. (`gallery-products.php` is not included anywhere; `photo-gallery.php` builds its grid from the product image folders.)

## Product detail pages
`coal-crusher-5-No-single-disc`, `coal-crusher-5-No-double-disc`, `coke-cutter-double-drive`, `coke-cutter-double-drive-ring-type`, `haulage`, `power-winch`, `vibrator-screen`, `conveyor-materials`, `coal-charging-car`, `pusher-with-stamping-arrangement`.

All share one layout:
- `<head>`: canonical URL, Open Graph tags, Product JSON-LD (brand, manufacturer, url), BreadcrumbList, plus `assets/css/product-detail.css`.
- Gallery: a main image plus `glob()` over `assets/img/product-images/<folder>/` (images and mp4/webm). Thumbnails use `mtc_thumb()`, the main view uses `mtc_img()`, and the inline `swapImage()`/`swapMedia()` switches it.
- Spec grid and Brochure / Request Quote / Call buttons (no star ratings: there are no reviews).
- An overview section: a question-style `<h2>`, a 130–170 word answer written from the page's own specs, a link to the closest related product, and a "Buying information" box (lead time, warranty, installation, custom builds, brochure).
- Bootstrap tabs (Description, Process Flow, Applications, Maintenance, FAQ from a `$product_faqs` array). Don't add FAQPage markup: Google no longer shows FAQ rich results.
- Sidebar quote form, then related products, then the footer.

**Adding a product:** copy an existing detail page (for example `coke-cutter-double-drive-ring-type.php`), then update all of:
1. `global-products.php`
2. the Products dropdown in `header.php`
3. `products.php` (card and filter class)
4. `$carousel_items` in `index.php` (plus slide images in `assets/img/slide/` and `assets/img/slide-thumbnail/`)
5. `sitemap.xml`: use `https://www.manualtoolsco.com/<slug>` (www, no `.php`) to match the canonical tags
6. the image folder under `assets/img/product-images/`. Name files `<Product-Name>-N.png` (for example `Vibrator-Screen-3.png`). They show up in the product gallery and `photo-gallery.php` automatically (add the folder to `$gallery_products` there).
7. run `python tools/optimize_images.py` to create the `.webp` and `.thumb.webp` copies. Commit them with the originals.
8. a brochure: add the product to `PRODUCTS` in `brochure/generate_product_brochures.py`, run it, and link the PDF from the page.
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
- `assets/css/style.css`: global theme. Brand colour is `--primary-color` (#f03c02). Custom classes use the `mtc-` prefix.
- `assets/css/product-detail.css`: product detail pages.
- Some components (`related-products.php`, `sidebar-quote-form.php`) keep their CSS and JS inline. Follow that pattern for self-contained includes.
- Front-end libraries live in `assets/vendor/` and are loaded directly (no npm).

## Other
- `brochure/*.py`: fpdf2 scripts that build product PDF brochures. Run them from the repo root because image paths are relative. `generate_product_brochures.py` builds six of them from one data table and reuses the layout class in `generate_brochure_coke_cutter.py`; its copy is taken from the product pages, so update both when specs change.
- `tools/optimize_images.py` (Pillow): WebP copies (max 1600px) and 320px gallery thumbnails next to the originals. Originals stay because the brochure scripts use them.
- `tools/indexnow_submit.py`: pings IndexNow. The key file `<key>.txt` in the root must stay deployed.
- `sitemap.xml`: update `<lastmod>` when a page's content changes. No `priority`/`changefreq` (search engines ignore them).
- `vendor/`: Composer autoloader and PHPMailer (there is no `composer.json`). Don't delete it; `forms/contact.php` depends on it.
  - `vendor/phpmailer/phpmailer` is a gitlink, not real files (see `BACKLOG.md`).
  - `assets/vendor/` holds front-end libraries only.

## Known issues / cautions
- Old credentials remain in git history (the repo is public). They must stay rotated. Don't reuse them.
- Database access in `webcounter.php` uses mysqli prepared statements. Keep it that way for any new queries.
- Only claim what the owner can back up (certificates, client counts, support hours, lead times). Product-page lead times and the contact-page FAQ must agree.
- Open work and completed fixes are tracked in `BACKLOG.md`. Update it when you finish or discover something.
