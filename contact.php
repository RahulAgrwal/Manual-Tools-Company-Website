<?php
$recaptchaSiteKey = '6Ldj7H0sAAAAAIIk3lL0kl9Y_Ohi8M_JcC5Qm13u';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Contact Manual Tools Company in Dhansar, Dhanbad. Call +91 94307 07348 or send an enquiry for coal crushers, coke cutters and coke oven machinery.">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/contact">
  <title>Contact Us – Request a Quotation | Manual Tools Company, Dhanbad</title>

  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.manualtoolsco.com/contact">
  <meta property="og:title" content="Contact Manual Tools Company">
  <meta property="og:description" content="Contact Manual Tools Company in Dhansar, Dhanbad. Call +91 94307 07348 or send an enquiry for coal crushers, coke cutters and coke oven machinery.">
  <meta property="og:image" content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Coal-Crusher-single-disc.jpg">
  <meta property="og:site_name" content="Manual Tools Company">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "Contact Manual Tools Company",
    "url": "https://www.manualtoolsco.com/contact",
    "isPartOf": { "@id": "https://www.manualtoolsco.com/#website" },
    "about": {
      "@type": "LocalBusiness",
      "@id": "https://www.manualtoolsco.com/#organization",
      "name": "Manual Tools Company",
      "url": "https://www.manualtoolsco.com/",
      "telephone": ["+91-9430707348", "+91-6204307367"],
      "email": "manualtoolsco.dhn@gmail.com",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Bastacolla, P.O. Dhansar",
        "addressLocality": "Dhanbad",
        "addressRegion": "Jharkhand",
        "postalCode": "828106",
        "addressCountry": "IN"
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          "opens": "08:00",
          "closes": "17:00"
        }
      ]
    }
  }
  </script>

  <?php $mtc_page_css = ['assets/css/contact.css']; ?>
  <?php include('common-head.php'); ?>
  <?php mtc_breadcrumb_schema(['Contact' => 'contact']); ?>
</head>

<body>

  <?php include('header.php'); ?>

  <main id="main">

    <section id="breadcrumbs" class="breadcrumbs">
      <div class="wrap">
        <div>
          <h1>Contact Manual Tools Company</h1>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Contact</li>
          </ol>
        </div>
      </div>
    </section>

    <section class="section contact-page">
      <div class="wrap contact__grid">

        <!-- ======= Enquiry form =======
             The form contract is unchanged: action, the ajax-form php-email-form
             classes, the reCAPTCHA data attributes, every field's name, id and
             required flag, the .loading / .error-msg / .sent-message elements
             and #mailsubmit are what main.js and forms/contact.php rely on.
             What changed: every field has a visible label (a placeholder is not
             a label; it vanishes as soon as someone types), and autocomplete
             tokens replace autocomplete="off" so phones can fill them in. -->
        <div class="contact-form">
          <h2>Send an enquiry</h2>
          <p class="contact-form__lede">Tell us what you need and we will get back to you with a quotation. Fields marked <span class="contact-form__req">*</span> are required.</p>

          <form action="forms/contact.php" method="post" class="ajax-form php-email-form" id="contact_form" role="form" data-recaptcha-site-key="<?php echo htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>" data-recaptcha-action="contact_form_submit">

            <div class="loading form-status" style="display:none;">Sending...</div>
            <div class="error-msg form-status form-status--error" style="display:none;" role="alert"></div>
            <div class="sent-message form-status form-status--ok" style="display:none;" role="status">Your message has been sent. Thank you!</div>

            <div class="contact-form__fields">
              <div class="field">
                <label for="first_name">First name <span class="contact-form__req">*</span></label>
                <input type="text" name="first_name" id="first_name" autocomplete="given-name" required>
              </div>
              <div class="field">
                <label for="last_name">Last name <span class="field__opt">optional</span></label>
                <input type="text" name="last_name" id="last_name" autocomplete="family-name">
              </div>
              <div class="field">
                <label for="company_name">Company name <span class="contact-form__req">*</span></label>
                <input type="text" name="company_name" id="company_name" autocomplete="organization" required>
              </div>
              <div class="field">
                <label for="company_gstin">Company GSTIN <span class="field__opt">optional</span></label>
                <input type="text" name="company_gstin" id="company_gstin" autocomplete="off">
              </div>
              <div class="field">
                <label for="contact">Mobile number <span class="contact-form__req">*</span></label>
                <input type="tel" name="contact" id="contact" autocomplete="tel" inputmode="tel" required>
              </div>
              <div class="field">
                <label for="address">Location / address <span class="contact-form__req">*</span></label>
                <input type="text" name="address" id="address" autocomplete="street-address" required>
              </div>
              <div class="field field--wide">
                <label for="email">Email <span class="contact-form__req">*</span></label>
                <input type="email" name="email" id="email" autocomplete="email" inputmode="email" required>
              </div>
              <div class="field field--wide">
                <label for="subject">Subject <span class="contact-form__req">*</span></label>
                <input type="text" name="subject" id="subject" placeholder="For example: coke cutter, 20 TPH" autocomplete="off" required>
              </div>
              <div class="field field--wide">
                <label for="message">Your requirements <span class="contact-form__req">*</span></label>
                <textarea id="message" name="message" rows="5" placeholder="Capacity, drawings, delivery site..." required></textarea>
              </div>
            </div>

            <button id="mailsubmit" class="btn btn--primary contact-form__submit" type="submit">Send message</button>
          </form>
        </div>

        <!-- ======= Direct contact ======= -->
        <aside class="contact-direct" aria-labelledby="contact-direct-title">
          <h2 id="contact-direct-title">Talk to us directly</h2>
          <ul class="contact-direct__list">
            <li>
              <i class="fas fa-phone-alt" aria-hidden="true"></i>
              <div>
                <span class="contact-direct__label">Call</span>
                <a href="tel:+919430707348">+91 94307 07348</a><br>
                <a href="tel:+916204307367">+91 62043 07367</a>
              </div>
            </li>
            <li>
              <i class="fas fa-envelope" aria-hidden="true"></i>
              <div>
                <span class="contact-direct__label">Email</span>
                <a href="mailto:ravindrakumaragarwal@rocketmail.com">ravindrakumaragarwal@rocketmail.com</a><br>
                <a href="mailto:manualtoolsco.dhn@gmail.com">manualtoolsco.dhn@gmail.com</a>
              </div>
            </li>
            <li>
              <i class="fas fa-user-tie" aria-hidden="true"></i>
              <div>
                <span class="contact-direct__label">Contact person</span>
                Mr. Ravindra Kr. Agarwal (Proprietor)
              </div>
            </li>
            <li>
              <i class="fas fa-clock" aria-hidden="true"></i>
              <div>
                <span class="contact-direct__label">Hours</span>
                Mon - Sat: 8:00 AM - 5:00 PM
              </div>
            </li>
            <li>
              <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
              <div>
                <span class="contact-direct__label">Workshop</span>
                Bastacolla, P.O. Dhansar,<br>Dhanbad, Jharkhand - 828106<br>
                <a href="https://maps.app.goo.gl/SR7U9r1J5fXyFfF7A" target="_blank" rel="noopener">Get directions <i class="fas fa-external-link-alt" aria-hidden="true"></i></a>
              </div>
            </li>
          </ul>
          <a href="tel:+919430707348" class="btn btn--quiet contact-direct__call"><i class="fas fa-phone-alt" aria-hidden="true"></i> Call now</a>
        </aside>

      </div>
    </section>

    <!-- ======= FAQ =======
         Native <details> elements, which need no JavaScript (this was a
         Bootstrap collapse accordion). The shared name makes them exclusive,
         like the old accordion, in browsers that support it. -->
    <section class="section section--sunk contact-faq">
      <div class="wrap wrap--narrow">
        <div class="section-head">
          <h2>Frequently asked questions</h2>
          <p>Quick answers about our machinery and services.</p>
        </div>
        <?php
        $faqs = [
            [
                "question" => "Can you customize machinery specs?",
                "answer" => "Yes, Manual Tools Company specializes in custom fabrication. We can modify motor power, dimensions, and capacity (TPH) based on your specific Coke Oven requirements and technical drawings."
            ],
            [
                "question" => "What is the typical delivery timeline?",
                "answer" => "Delivery timelines depend on the order volume and machine complexity. Standard spare parts and common conveyor rollers are often in stock. Custom conveyor pulleys usually take 2-3 weeks, and heavy machinery such as coal crushers and coke cutters typically takes 3-8 weeks depending on the model and our production queue. Each product page lists its usual lead time."
            ],
            [
                "question" => "Do you provide fitting and commissioning support?",
                "answer" => "Yes, based on the project scope, we offer on-site installation assistance and commissioning support to ensure your machinery operates optimally from day one."
            ],
            [
                "question" => "How do I request a formal quotation?",
                "answer" => "You can request a quote by filling out the form above, sending an email to <strong>ravindrakumaragarwal@rocketmail.com</strong>, or calling us directly at <strong>+91 94307 07348</strong>."
            ],
            [
                "question" => "Where is your workshop located?",
                "answer" => "Our manufacturing unit and workshop are located in Bastacolla, Dhansar, Dhanbad, Jharkhand. You are welcome to visit us for a physical inspection of our machinery."
            ],
            [
                "question" => "Do you deliver on weekends?",
                "answer" => "Yes, we offer weekend delivery options for urgent orders."
            ]
        ];
        ?>
        <div class="contact-faq__list">
          <?php foreach ($faqs as $i => $faq) : ?>
            <details name="contact-faq"<?php echo $i === 0 ? ' open' : ''; ?>>
              <summary><?php echo $faq['question']; ?><span class="contact-faq__icon" aria-hidden="true"></span></summary>
              <p><?php echo $faq['answer']; ?></p>
            </details>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></a>

  <!-- No Bootstrap bundle: the FAQ accordion was its only user on this page. -->
  <script src="<?php echo mtc_asset('assets/js/main.js'); ?>"></script>

</body>
</html>
