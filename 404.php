<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Not Found - Manual Tools Company</title>
  <meta name="robots" content="noindex, follow">
  <!-- This page is also shown for missing nested URLs, so resolve assets from the site root. -->
  <base href="/">
  <?php $mtc_page_css = ['assets/css/error.css']; ?>
  <?php include('common-head.php'); ?>
</head>
<body>
  <?php include('header.php'); ?>

  <main id="main">
    <section class="section error-page">
      <div class="wrap wrap--narrow">
        <p class="error-page__code">Error 404</p>
        <h1>This page could not be found</h1>
        <p class="lede">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <div class="cluster error-page__actions">
          <a href="/" class="btn btn--primary">Back to home</a>
          <a href="products" class="btn btn--quiet">See all machinery</a>
          <a href="contact" class="btn btn--quiet">Contact us</a>
        </div>

        <!-- The ten machines, since a lost visitor most often wanted one. -->
        <?php include_once('global-products.php'); ?>
        <h2 class="error-page__h2">Our machinery</h2>
        <ul class="error-page__list">
          <?php foreach ($GLOBAL_PRODUCT_CARDS as $card) : ?>
            <li><a href="<?php echo $card['link']; ?>"><?php echo htmlspecialchars($card['title']); ?> <span><?php echo htmlspecialchars($card['subtitle']); ?></span></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
  </main>

  <?php include('footer.php'); ?>
  <script src="<?php echo mtc_asset('assets/js/main.js'); ?>"></script>
</body>
</html>
