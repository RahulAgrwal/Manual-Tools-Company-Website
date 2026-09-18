<?php require_once __DIR__ . '/page-helpers.php';

// Stylesheets this page needs on top of the site-wide ones. Set it before
// including this file, e.g. $mtc_page_css = ['assets/css/about.css'];
$mtc_css = array_merge([
    // compat.css (the Bootstrap stand-in) was deleted in phase 8; the few
    // Reboot rules still needed open mtc.css.
    'assets/css/mtc.css',                    // tokens, reboot, base, layout primitives
    'assets/css/chrome.css',                 // header, nav, footer, mobile bars
    'assets/fontawesome/css/icons.css',      // subset, built by tools/subset_fontawesome.py
], $mtc_page_css ?? []);
?>
<link rel="icon" type="image/png" href="assets/img/MTC_Logo_Footer.png">
  <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
  <link rel="dns-prefetch" href="//www.google-analytics.com">
  <link rel="preload" href="assets/fonts/archivo-latin-var.woff2" as="font" type="font/woff2" crossorigin>
<?php foreach ($mtc_css as $href): ?>
  <link rel="stylesheet" href="<?php echo mtc_asset($href); ?>">
<?php endforeach; ?>
  <!-- Social cards: X/Twitter falls back to each page's og:title, og:description and og:image. -->
  <meta name="twitter:card" content="summary_large_image">
  <meta property="og:locale" content="en_IN">
  <!-- jQuery is loaded at the end of footer.php, before each page's scripts. -->

  <!-- Google tag: GA4 + Google Ads share one gtag.js -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-MVLSMW6TTF"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-MVLSMW6TTF');
  gtag('config', 'AW-17669553737');
</script>
