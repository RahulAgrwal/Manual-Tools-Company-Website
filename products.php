<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Coke oven machinery and coal handling equipment made in Dhanbad: coal crushers, coke cutters, haulage machines, winches, vibrating screens and conveyors.">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="canonical" href="https://www.manualtoolsco.com/products">
  <title>Coke Oven &amp; Coal Handling Machinery | Manual Tools Company</title>

  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.manualtoolsco.com/products">
  <meta property="og:title" content="Coke Oven &amp; Coal Handling Machinery | Manual Tools Company">
  <meta property="og:description" content="Coke oven machinery and coal handling equipment made in Dhanbad: coal crushers, coke cutters, haulage machines, winches, vibrating screens and conveyors.">
  <meta property="og:image" content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Coal-Crusher-single-disc.jpg">
  <meta property="og:site_name" content="Manual Tools Company">

  <?php include('common-head.php'); ?>
  <?php
  include_once('global-products.php');
  $list_items = [];
  foreach ($GLOBAL_PRODUCT_CARDS as $i => $card) {
    $list_items[] = [
      '@type' => 'ListItem',
      'position' => $i + 1,
      'name' => trim($card['title'] . ' ' . $card['subtitle']),
      'url' => 'https://www.manualtoolsco.com/' . $card['link'],
    ];
  }
  $collection = [
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => 'Coke Oven Machinery Products',
    'url' => 'https://www.manualtoolsco.com/products',
    'isPartOf' => ['@id' => 'https://www.manualtoolsco.com/#website'],
    'mainEntity' => ['@type' => 'ItemList', 'itemListElement' => $list_items],
  ];
  ?>
  <script type="application/ld+json"><?php echo json_encode($collection, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
  <?php mtc_breadcrumb_schema(['Products' => 'products']); ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include('header.php'); ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="wrap">
        <div>
          <h1>Coke Oven Machinery Products</h1>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Products</li>
          </ol>
        </div>
      </div>
    </section>

    <section class="section" style="padding-bottom: 0;">
      <div class="wrap">
        <p class="lede measure">
          Machinery for coke oven plants, coal washeries and steel plants, built in Dhanbad to your plant's requirements.
          Open a product for full specifications, or <a href="contact">contact us for a quotation</a>.
        </p>
      </div>
    </section>

    <!-- ======= Product Filter ======= -->
    <!-- #product-filter-flters is the hook assets/js/main.js and the inline
         filter script bind to; keep the id. -->
    <section class="section" style="padding-bottom: 0;">
      <div class="wrap">
        <ul id="product-filter-flters" class="filter-bar">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".coal-crusher">Coal crusher</li>
          <li data-filter=".coke-cutter">Coke cutter</li>
          <li data-filter=".haulage">Haulage</li>
          <li data-filter=".power-winch">Power winch</li>
          <li data-filter=".vibrator">Vibrator screen</li>
          <li data-filter=".conveyor">Conveyor</li>
          <li data-filter=".heavy-machinery">Heavy machinery</li>
        </ul>
      </div>
    </section>

    <!-- ======= Product Listing Section ======= -->
    <!-- One loop over $GLOBAL_PRODUCT_CARDS. These rows used to be ten
         hand-written copies that duplicated the data and had already drifted
         from it once. -->
    <!-- The filter bar above already ends with its own bottom margin, so the
         listing only needs a small top pad (phase 9: without legacy.css the
         full section padding left ~135px between the pills and the first row). -->
    <section class="section" style="padding-top: 0;">
      <div class="wrap">
        <div class="product-rows">
          <?php foreach ($GLOBAL_PRODUCT_CARDS as $i => $card) : ?>
            <article class="product-row product-item <?php echo $card['category']; ?>">
              <div class="product-row__well">
                <img src="<?php echo mtc_thumb($card['image_path']); ?>"
                     <?php echo mtc_img_size(mtc_thumb($card['image_path'])); ?>
                     alt="<?php echo htmlspecialchars($card['title'] . ' - ' . $card['subtitle']); ?>"
                     <?php echo $i === 0 ? 'fetchpriority="high"' : 'loading="lazy"'; ?> decoding="async">
              </div>

              <div class="product-row__body">
                <p class="product-row__eyebrow"><?php echo htmlspecialchars($card['eyebrow']); ?></p>
                <h2 class="product-row__title">
                  <?php echo htmlspecialchars($card['title']); ?><span><?php echo htmlspecialchars($card['subtitle']); ?></span>
                </h2>
                <p class="product-row__desc"><?php echo htmlspecialchars($card['long_description']); ?></p>

                <ul class="spec-chips">
                  <?php foreach ($card['mini_specs'] as $spec) : ?>
                    <li><i class="fas <?php echo $spec[0]; ?>" aria-hidden="true"></i><?php echo htmlspecialchars($spec[1]); ?></li>
                  <?php endforeach; ?>
                </ul>

                <a href="<?php echo $card['link']; ?>" class="btn btn--quiet">Full specifications</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

  </main>

  <!-- ======= Footer ======= -->
  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/js/main.js"></script>

  <!-- Filter Script (Updated for Class Based Filtering) -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const filterBtns = document.querySelectorAll("#product-filter-flters li");
      const productItems = document.querySelectorAll(".product-item");

      filterBtns.forEach(btn => {
        btn.addEventListener("click", () => {
          // Remove active class from all buttons
          filterBtns.forEach(b => b.classList.remove("filter-active"));
          // Add active class to clicked button
          btn.classList.add("filter-active");

          const filterValue = btn.getAttribute("data-filter");

          productItems.forEach(item => {
            if (filterValue === "*" || item.classList.contains(filterValue.substring(1))) {
              item.style.display = "block";
              // Add simple fade in animation
              item.style.opacity = "0";
              setTimeout(() => item.style.opacity = "1", 50);
            } else {
              item.style.display = "none";
            }
          });
        });
      });
    });
  </script>

</body>
</html>