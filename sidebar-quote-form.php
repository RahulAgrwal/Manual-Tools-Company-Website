<?php
// Quote form beside every product page. Set $_GET['page_url'] and
// $_GET['page_title'] before including it (product-page.php does).
//
// FROZEN CONTRACT -- assets/js/main.js and forms/contact.php depend on all of:
//   class="ajax-form php-email-form", action, method, data-recaptcha-site-key,
//   data-recaptcha-action, the .loading / .error-msg / .sent-message elements,
//   and every name= attribute. forms/contact.php silently drops unknown names.
// The form id is the page slug; main.js reports it to GA4 as form_name.
$pageUrl = isset($_GET['page_url']) ? htmlspecialchars($_GET['page_url'], ENT_QUOTES) : 'General Inquiry';
$pageTitle = isset($_GET['page_title']) ? htmlspecialchars($_GET['page_title'], ENT_QUOTES) : '';
$recaptchaSiteKey = '6Ldj7H0sAAAAAIIk3lL0kl9Y_Ohi8M_JcC5Qm13u';
?>

<div class="quote-card">
  <h2 class="quote-card__title">Request a quote</h2>
  <p class="quote-card__lede">
    Tell us what you need<?php echo $pageTitle ? ' for the <strong>' . $pageTitle . '</strong>' : ''; ?>.
    We'll reply by email or phone.
  </p>

  <form id="<?php echo $pageUrl; ?>" action="forms/contact.php" method="post" class="ajax-form php-email-form" data-recaptcha-site-key="<?php echo htmlspecialchars($recaptchaSiteKey, ENT_QUOTES, 'UTF-8'); ?>" data-recaptcha-action="sidebar_quote_submit">
    <div class="loading form-status" style="display:none;">Sending your enquiry…</div>
    <div class="error-msg form-status form-status--error" style="display:none;" role="alert"></div>
    <div class="sent-message form-status form-status--ok" style="display:none;" role="status"></div>

    <!-- Labels are visible and sit above each field: a placeholder is not a
         label -- it disappears as soon as someone starts typing. -->
    <div class="field">
      <label for="qf-name">Your name</label>
      <input id="qf-name" type="text" name="first_name" autocomplete="name" required>
    </div>

    <div class="field">
      <label for="qf-email">Work email</label>
      <input id="qf-email" type="email" name="email" autocomplete="email" inputmode="email" required>
    </div>

    <div class="field">
      <label for="qf-phone">Phone <span class="field__opt">optional</span></label>
      <input id="qf-phone" type="tel" name="contact" autocomplete="tel" inputmode="tel">
    </div>

    <div class="field">
      <label for="qf-msg">What do you need? <span class="field__opt">optional</span></label>
      <textarea id="qf-msg" name="message" rows="4"
        placeholder="Capacity, quantity, delivery site, drawings…"></textarea>
    </div>

    <!-- Hidden fields: which page the enquiry came from -->
    <input type="hidden" name="source_page" value="<?php echo $pageUrl; ?>">
    <?php if (!empty($pageTitle)): ?>
      <input type="hidden" name="subject" value="<?php echo $pageTitle; ?>">
    <?php endif; ?>

    <button type="submit" class="btn btn--primary quote-card__submit">Send enquiry</button>
    <p class="quote-card__fine">Your information is secure and will not be shared.</p>
  </form>

  <p class="quote-card__alt">
    Prefer to talk? <a href="tel:+919430707348">+91 94307 07348</a>
  </p>
</div>
