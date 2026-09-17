# Backlog

## Pending

- [ ] **Quenching Coke Car product page.** Waiting on specs from the owner (capacity, motor HP, dimensions, material, key features) and photos. The `header.php` dropdown link is still `href="#"`. Follow "Adding a product" in `CLAUDE.md`.
- [ ] **PHPMailer is not really in git.** `vendor/phpmailer/phpmailer` is stored as a git *gitlink* (a nested repo reference with no `.gitmodules`), so a fresh clone or deploy gets an empty folder and the contact form fails. The live server works only because its copy was uploaded earlier.
  - Fix: commit the library files properly.
  - First, confirm how Hostinger deploys (git pull over existing files can fail when newly tracked files already exist untracked on the server).

- [ ] **ISO 9001 certificate.** The certificate on `/about` (QMS/014551/0220) expired on 04-Feb-2023, but the badge still appears on the home page, About page and product pages. Upload the current certificate or remove the badges. (Left as is on request, 2026-09-17.)
- [ ] **Unverified numbers.** "150+ Happy Clients" and "500+ Projects Done" on the home page were kept. Confirm them with the owner, or back them up with case studies (plant, machine, year).
- [ ] **Off-site listings (manual).**
  - Check the Google Business Profile category, photos and reviews.
  - Claim or verify IndiaMART, TradeIndia and JustDial listings with the same name, address and phone.
  - Create LinkedIn and YouTube pages only if they will be used, then add them to the footer, header and `sameAs` in `index.php`.
- [ ] **Search Console and Bing Webmaster Tools.** Submit `sitemap.xml` and request indexing for the changed pages. (IndexNow was already sent on 2026-09-17; see Done.)
- [ ] **Ring Type coke cutter brochure.** The button is commented out in `coke-cutter-double-drive-ring-type.php`. Add the product to `brochure/generate_product_brochures.py` when the owner approves the content.
- [ ] **`gallery-products.php` is unused** and points to image files that no longer exist. Delete it or wire it in.
- [ ] **Unused JS.**
  - The Swiper `.portfolio-details-slider` block in `assets/js/main.js` is dead code (Swiper was removed).
  - `assets/vendor/php-email-form/validate.js` and `assets/vendor/waypoints/` are not loaded by any page.

## Done

- [x] **2026-09-17: Unused CSS removed.**
  - `style.css`: template rules no page uses (blog, pricing, testimonials, team, skills, portfolio details, CTA, old product showcase, specs and process blocks, video gallery), plus the unused `fadeInUp` keyframes. Down from 4818 to 2945 lines.
  - `product-detail.css`: star-rating and old tech-features card rules.
  - `assets/vendor/`: deleted animate.css, AOS, Swiper, and the Bootstrap, Boxicons, GLightbox and Bootstrap Icons files that no page loads. The files `common-head.php` loads are kept.
- [x] **2026-09-17: IndexNow submitted.** `python tools/indexnow_submit.py` sent all 16 sitemap URLs (HTTP 202 accepted). Run it again after future content deploys (see `CLAUDE.md`).
- [x] **2026-09-17: SEO audit fixes** (audit report: `manualtoolsco.com-audit/`, not committed).
  - **Downloads:** added the 6 missing brochure PDFs (`brochure/generate_product_brochures.py`).
  - **Images:**
    - WebP copies and gallery thumbnails of all images (`tools/optimize_images.py`). The carousel dropped from about 13 MB to 0.8 MB.
    - The first hero slide loads with `fetchpriority="high"`; the other slides load when they come up.
  - **Page head:**
    - Removed duplicate stylesheets and the extra Font Awesome versions (4.7 and 6.0).
    - Removed unused CSS/JS (animate, AOS, swiper, cookieconsent).
    - One Google tag now covers GA4 and Ads.
    - jQuery moved to the end of the page.
  - **Headings and canonicals:** one H1 and a canonical tag on every page.
  - **Metadata:** new titles and descriptions for the home, about, products, contact and gallery pages, and Open Graph tags where missing.
  - **Structured data:**
    - The home page has a single LocalBusiness + WebSite graph.
    - BreadcrumbList on every page.
    - CollectionPage/ItemList on `/products` and `/coal-crusher`, AboutPage, and ContactPage.
  - **`/coal-crusher`:** rebuilt as a Single vs Double Disc comparison page.
  - **Product pages:**
    - Overview section and buying-information box added.
    - The fake 5-star rows are gone.
    - The breadcrumb now includes "Products".
    - Thumbnails have descriptive alt text.
  - **Copy fixes:**
    - Haulage retargeted to "coke oven haulage machine", and its copy slips fixed.
    - The two coke cutters now have distinct names (Drum Type vs Ring Type).
    - The "24/7" and "zero downtime" claims were removed.
    - Lead times are now consistent between product pages and the contact FAQ.
  - **Links:** the footer logo links to `/`; the dead LinkedIn and YouTube links were removed.
  - **Mobile:** call/quote bar at the bottom, a quote button in the hero, and scrollable product filters.
  - **Crawling and headers:**
    - Added `robots.txt` and an IndexNow key.
    - `.htaccess` now redirects `/index` and trailing slashes, blocks include-only files, sets security and cache headers, and serves the custom 404 page.
    - Sitemap: `lastmod` refreshed, `priority`/`changefreq` removed.
- [x] **2026-09-16: Secrets out of code.** Passwords moved to git-ignored `config/secrets.php` (see `load-secrets.php`). Gmail app password, MySQL password and reCAPTCHA keys rotated, and verified on the live site by the owner.
- [x] **2026-09-16: Contact form.** Enquiries go to the company inbox with Reply-To set to the visitor. The visitor gets a fixed confirmation.
- [x] **2026-09-16: Broken links and markup.**
  - Fixed: pusher machine slug, literal `**` markdown, duplicate jQuery, extra `</div>` tags, missing vendor CSS.
  - Sitemap now uses canonical URLs.
- [x] **2026-09-16: Visitor counter after page load.** It runs via `track-visit.php`, so it no longer blocks rendering.
- [x] **2026-09-16: Single site address.** `manualtoolsco.com` redirects (301) to `www.manualtoolsco.com`, and hard-coded URLs use `www`.
- [x] **2026-09-16: Home page structured data.** `sameAs` now lists the real Facebook and Instagram profiles.
- [x] **2026-09-16: Ring-type coke cutter page.** Its `<style>` block moved inside `<head>`.
- [x] **2026-09-16: Duplicate libraries.** Removed the duplicate Composer and PHPMailer copies from `assets/vendor/`. Confirmed they return 404 on the live site.
- [x] **2026-09-16: New Vibrator Screen photo.** Added `Vibrator-Screen-3.png`.
