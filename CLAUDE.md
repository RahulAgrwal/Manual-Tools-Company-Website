# CLAUDE.md

Marketing and lead-generation website for **Manual Tools Company** (coke oven machinery, Dhanbad). Live at https://www.manualtoolsco.com/. Plain PHP pages on a Bootstrap 5 template, with no framework, no build step and no tests.

## Run locally

    php -S localhost:8080 router.php

- `router.php` does locally what `.htaccess` does in production: `/about` loads `about.php`, real files are served directly, and anything else gets `404.php`.
- Local secrets live in `config/secrets.php` (the whole `config/` folder is git-ignored). Without it, pages still render.
- The footer calls `webcounter.php` (ip-api.com lookup with a 3s timeout, then MySQL). If either fails, `visitor()` returns `null` and the footer shows a fallback count.

## Secrets
- **Never hard-code credentials.** Read them with `mtc_secrets()` from `load-secrets.php`, which returns an array (empty if no file is found).
- Lookup order: `MTC_SECRETS_FILE` env var, then `../config/secrets.php` (production: Hostinger folder next to `public_html`), then `./config/secrets.php` (local), then `./secrets.local.php`.
- To add a new secret, add the key to `secrets.example.php` with an empty value, and update the table in `README.md`.
- Hosting is a Hostinger shared plan (no environment-variable UI for PHP). The GitHub repo is **public**, so anything committed is exposed.
- The reCAPTCHA *site* key is public and is hard-coded in `contact.php` and `sidebar-quote-form.php`.

## URLs and links
- Links have no extension (`href="haulage"`, not `haulage.php`). `.htaccess` sends `*.php` to the address without it (301).
- Asset paths are relative (`assets/...`), so pages must stay at the repo root.

## Page structure
Every page includes: `common-head.php` (CSS, jQuery, GA4) in `<head>`, `header.php` (navbar; active link from `PHP_SELF`), and `footer.php` (links, visitor counter, Google Ads tag). JS files are loaded at the end of `<body>`, ending with `assets/js/main.js`.

Shared parts:
- `global-products.php`: `$GLOBAL_PRODUCT_CARDS`, the master product list (image_path, title, subtitle, link slug, short_description).
- `our-products.php`: card grid built from that list (home and about pages).
- `related-products.php`: slider. Set `$current_page_slug` before including it so the current product is left out.
- `sidebar-quote-form.php`: set `$_GET['page_url']` and `$_GET['page_title']` before including it.
- `clients.php`, `gallery-products.php`: data arrays and a loop.

## Product detail pages
`coal-crusher-5-No-single-disc`, `coal-crusher-5-No-double-disc`, `coke-cutter-double-drive`, `coke-cutter-double-drive-ring-type`, `haulage`, `power-winch`, `vibrator-screen`, `conveyor-materials`, `coal-charging-car`, `pusher-with-stamping-arrangement`.

All share one layout:
- `<head>`: canonical URL, Open Graph tags, Product JSON-LD, plus `assets/css/product-detail.css`.
- Gallery: a main image plus `glob()` over `assets/img/product-images/<folder>/` (images and mp4/webm). The inline `swapMedia()` switches the main view.
- Spec grid, then Bootstrap tabs (Description, Process Flow, Applications, Maintenance, FAQ from a `$product_faqs` array).
- Sidebar quote form, then related products, then the footer.

**Adding a product:** copy an existing detail page (for example `coke-cutter-double-drive-ring-type.php`), then update all of:
1. `global-products.php`
2. the Products dropdown in `header.php`
3. `products.php` (card and filter class)
4. `$carousel_items` in `index.php` (plus slide images in `assets/img/slide/` and `assets/img/slide-thumbnail/`)
5. `sitemap.xml`
6. the image folder under `assets/img/product-images/`

## Forms
- A form joins the shared submit flow by having class `ajax-form php-email-form`, `action="forms/contact.php"`, `data-recaptcha-site-key` and `data-recaptcha-action`. It needs `.loading`, `.error-msg` and `.sent-message` elements inside.
- `main.js` checks `[required]` fields and email format, gets a reCAPTCHA v3 token, POSTs `FormData`, and fires the GA4 `generate_lead` event plus a Google Ads conversion on success.
- `forms/contact.php` returns JSON `{success, message}`. It checks reCAPTCHA (score ≥ 0.5) and sends mail with PHPMailer over Gmail SMTP, using `vendor/autoload.php`. SMTP and reCAPTCHA credentials come from `mtc_secrets()`, and the endpoint returns a JSON error if they are missing.

## Styling
- `assets/css/style.css`: global theme. Brand colour is `--primary-color` (#f03c02). Custom classes use the `mtc-` prefix.
- `assets/css/product-detail.css`: product detail pages.
- Some components (`related-products.php`, `sidebar-quote-form.php`) keep their CSS and JS inline. Follow that pattern for self-contained includes.
- Front-end libraries live in `assets/vendor/` and are loaded directly (no npm).

## Other
- `brochure/*.py`: fpdf2 scripts that build product PDF brochures. Run them from the repo root because image paths are relative.
- `vendor/`: Composer autoloader and PHPMailer, committed to the repo (there is no `composer.json`). Don't delete it; `forms/contact.php` depends on it.

## Known issues / cautions
- Old credentials remain in git history (the repo is public). They must stay rotated. Don't reuse them.
- Database access in `webcounter.php` uses mysqli prepared statements. Keep it that way for any new queries.
- The footer links to `pusher-machine-with-stamping-arrangement`, but the real slug is `pusher-with-stamping-arrangement`.
