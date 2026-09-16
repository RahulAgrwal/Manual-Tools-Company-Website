# Manual Tools Company Website

Marketing website for Manual Tools Company (coke oven machinery, Dhanbad). Plain PHP pages, no build step.

**Live:** [https://www.manualtoolsco.com/](https://www.manualtoolsco.com/)

## Prerequisites
- PHP 7.4+ with the `mysqli` extension
- A web browser

## Configure secrets

Passwords and keys are **not** stored in the code. They are read from a PHP file that is never committed (see `load-secrets.php`).

1. Copy `secrets.example.php` and fill in the values:
   - **Local development:** copy to `config/secrets.php` in the project root (the whole `config/` folder is git-ignored). `secrets.local.php` in the root also works.
   - **Production (Hostinger):** copy to `domains/manualtoolsco.com/config/secrets.php`, i.e. the `config` folder **next to** `public_html`, not inside it, so it can never be served over the web.
2. Values needed:

   | Key | Used by | Where to get it |
   |---|---|---|
   | `smtp_user`, `smtp_pass` | `forms/contact.php` | Gmail account + Google **App Password** |
   | `recaptcha_secret` | `forms/contact.php` | reCAPTCHA v3 admin console (secret key) |
   | `db_host`, `db_port`, `db_user`, `db_pass`, `db_name` | `webcounter.php` | hPanel → Databases → MySQL (`localhost` on Hostinger) |

To use a different path, set the `MTC_SECRETS_FILE` environment variable to the full file path.

Without a secrets file the site still loads: the contact form returns a configuration error and the footer visitor counter shows a fallback number.

> The public reCAPTCHA **site key** is not secret and lives in `contact.php` and `sidebar-quote-form.php`. Update both if the key pair changes.

## Run the project locally

```bash
php -S localhost:8080 router.php
```

Then open http://localhost:8080. `router.php` mimics the production `.htaccess` rules (URLs without `.php`).

## Project structure

```
.
├── index.php, about.php, products.php, contact.php, photo-gallery.php
├── <product-slug>.php        # Product detail pages
├── header.php, footer.php, common-head.php
├── global-products.php       # Master product list
├── related-products.php, our-products.php, sidebar-quote-form.php, clients.php
├── forms/contact.php         # AJAX form endpoint (PHPMailer + reCAPTCHA v3)
├── webcounter.php            # Visitor counter (MySQL)
├── track-visit.php           # Endpoint the footer calls after page load to record a visit
├── load-secrets.php          # Loads credentials from the secrets file
├── secrets.example.php       # Template for the secrets file
├── config/secrets.php        # Local secrets (git-ignored, not in repo)
├── router.php                # Router for PHP built-in server
├── .htaccess                 # Production URL rewriting
├── brochure/                 # Python scripts that generate PDF brochures
├── vendor/                   # PHPMailer (Composer autoload)
└── assets/                   # CSS, JS, images, front-end vendor libraries
```

## Notes
- Use `CTRL + C` to stop the server.
- See `CLAUDE.md` for architecture details and how to add a new product.
- See `BACKLOG.md` for pending work and completed fixes.
- Pushing to `main` deploys to the live site automatically.
