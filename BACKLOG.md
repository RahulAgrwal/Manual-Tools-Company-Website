# Backlog

## Pending

- [ ] **Quenching Coke Car product page.** Waiting on specs from the owner (capacity, motor HP, dimensions, material, key features) and photos. The `header.php` dropdown link is still `href="#"`. Follow "Adding a product" in `CLAUDE.md`.
- [ ] **PHPMailer is not really in git.** `vendor/phpmailer/phpmailer` is stored as a git *gitlink* (a nested repo reference with no `.gitmodules`), so a fresh clone or deploy gets an empty folder and the contact form fails. The live server works only because its copy was uploaded earlier.
  - Fix: commit the library files properly.
  - First, confirm how Hostinger deploys (git pull over existing files can fail when newly tracked files already exist untracked on the server).
- [ ] **Remove leftover `assets/vendor/phpmailer/` on the server.** It was removed from git, but server-side copies of gitlink folders are not deleted by a deploy. Delete it in the hPanel File Manager if it is still there.

## Done

- [x] **2026-09-16: Secrets out of code.** Passwords moved to git-ignored `config/secrets.php` (see `load-secrets.php`). Gmail app password, MySQL password and reCAPTCHA keys rotated, and verified on the live site by the owner.
- [x] **2026-09-16: Contact form.** Enquiries go to the company inbox with Reply-To set to the visitor. The visitor gets a fixed confirmation.
- [x] **2026-09-16: Broken links and markup.**
  - Fixed: pusher machine slug, literal `**` markdown, duplicate jQuery, extra `</div>` tags, missing vendor CSS.
  - Sitemap now uses canonical URLs.
- [x] **2026-09-16: Visitor counter after page load.** It runs via `track-visit.php`, so it no longer blocks rendering.
- [x] **2026-09-16: Single site address.** `manualtoolsco.com` redirects (301) to `www.manualtoolsco.com`, and hard-coded URLs use `www`.
- [x] **2026-09-16: Home page structured data.** `sameAs` now lists the real Facebook and Instagram profiles.
- [x] **2026-09-16: Ring-type coke cutter page.** Its `<style>` block moved inside `<head>`.
- [x] **2026-09-16: Duplicate libraries.** Removed the duplicate Composer and PHPMailer copies from `assets/vendor/`.
- [x] **2026-09-16: New Vibrator Screen photo.** Added `Vibrator-Screen-3.png`.
