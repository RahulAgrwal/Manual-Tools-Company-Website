<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Photos of coke oven machinery built by Manual Tools Company in Dhanbad: coal crushers, coke cutters, haulage machines, winches, screens and charging cars.">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://www.manualtoolsco.com/photo-gallery">
  <title>Photo Gallery – Coke Oven Machinery | Manual Tools Company</title>

  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.manualtoolsco.com/photo-gallery">
  <meta property="og:title" content="Photo Gallery – Coke Oven Machinery | Manual Tools Company">
  <meta property="og:description" content="Photos of coke oven machinery built by Manual Tools Company in Dhanbad: coal crushers, coke cutters, haulage machines, winches, screens and charging cars.">
  <meta property="og:image" content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Coal-Crusher-single-disc.jpg">
  <meta property="og:site_name" content="Manual Tools Company">

  <?php $mtc_page_css = ['assets/css/gallery.css', 'assets/vendor/glightbox/css/glightbox.min.css']; ?>
  <?php include('common-head.php'); ?>
  <?php mtc_breadcrumb_schema(['Photo Gallery' => 'photo-gallery']); ?>
</head>

<body>

  <?php include('header.php'); ?>

  <main id="main">

    <section id="breadcrumbs" class="breadcrumbs">
      <div class="wrap">
        <div>
          <h1>Photo Gallery</h1>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Gallery</li>
          </ol>
        </div>
      </div>
    </section>

    <?php
    // [filter, main photo, product folder, title, caption, product page]
    $gallery_products = array(
        array('filter-crusher', 'assets/img/about-us-products/Coal Crusher.jpg', 'coal-crusher-single-disc', 'Single Disc Coal Crusher', '5 No. Size', 'coal-crusher-5-No-single-disc'),
        array('filter-crusher', 'assets/img/about-us-products/Coal Crusher Double Disc.jpg', 'coal-crusher-double-disc', 'Double Disc Coal Crusher', 'High Capacity', 'coal-crusher-5-No-double-disc'),
        array('filter-crusher', 'assets/img/about-us-products/Double Drive Coke Cutter Machine.jpg', 'coke-cutter', 'Coke Cutter', 'Double Drive, Drum Type', 'coke-cutter-double-drive'),
        array('filter-crusher', 'assets/img/about-us-products/Double Drive Coke Cutter Machine Ring Type.jpg', 'coke-cutter-ring-teeth', 'Ring Type Coke Cutter', 'Double Drive, Toothed Rings', 'coke-cutter-double-drive-ring-type'),

        array('filter-oven', 'assets/img/about-us-products/Pusher Machine With Stamping Arrangement.jpg', 'pusher-machine-with-stamping-arrangement', 'Pusher Machine', 'Roller Stamping', 'pusher-with-stamping-arrangement'),
        array('filter-oven', 'assets/img/about-us-products/Coal-Charging-Car.jpg', 'coal-charging-car', 'Coal Charging Car', 'Top Charging', 'coal-charging-car'),

        array('filter-winch', 'assets/img/about-us-products/Haulage Machine.jpg', 'haulage', 'Coke Oven Haulage Machine', '10 Ton Pulling', 'haulage'),
        array('filter-winch', 'assets/img/about-us-products/Power Winchh.jpg', 'power-winch', 'Door Lifting Power Winch', 'Door Lifter', 'power-winch'),

        array('filter-screen', 'assets/img/about-us-products/Vibrator Screen Machine.jpg', 'vibrator-screen', 'Vibrator Screen', 'Multi-Deck', 'vibrator-screen'),
        array('filter-screen', 'assets/img/about-us-products/Conveyor Material.jpeg', 'conveyor-materials', 'Conveyor Components', 'Idlers & Pulleys', 'conveyor-materials')
    );

    // Labels for individual files (e.g. a spare part), from the product data.
    require_once __DIR__ . '/product-data.php';

    // Each product's main photo, then every photo in its folder.
    $gallery_items = array();
    foreach ($gallery_products as $p) {
        $photos = glob('assets/img/product-images/' . $p[2] . '/*.{jpg,jpeg,png}', GLOB_BRACE) ?: array();
        $photos = array_values(array_filter($photos, function ($f) {
            return strpos($f, 'process-diagram') === false;
        }));
        array_unshift($photos, $p[1]);
        foreach ($photos as $n => $photo) {
            $label = $MTC_PRODUCTS[$p[5]]['gallery_labels'][basename($photo)] ?? '';
            $gallery_items[] = array($p[0], $photo, $p[3], $n === 0 ? $p[4] : ($label !== '' ? $label : 'Photo ' . ($n + 1)), $p[5]);
        }
    }

    $filters = array(
        '*' => 'All photos',
        'filter-crusher' => 'Crushers & cutters',
        'filter-oven' => 'Oven machines',
        'filter-winch' => 'Haulage & winches',
        'filter-screen' => 'Screens & conveyors',
    );
    $counts = array_count_values(array_column($gallery_items, 0));
    ?>

    <section class="section gallery" aria-labelledby="gallery-title">
      <div class="wrap">
        <!-- Screen-reader heading: without it the page went from its h1 to the
             footer's h3 (Lighthouse heading-order, phase 9). -->
        <h2 id="gallery-title" class="sr-only">Machinery photos</h2>
        <p class="lede measure gallery__lede">
          Photos of machines built in our Dhanbad workshop and installed at client plants. Filter by machine type, tap a photo to enlarge it, and open any product page for full specifications.
        </p>

        <!-- Real buttons, so the filter works from the keyboard too. -->
        <div class="filter-bar" role="group" aria-label="Filter photos by machine type">
          <?php foreach ($filters as $key => $label) : ?>
            <button type="button" data-filter="<?php echo $key; ?>" aria-pressed="<?php echo $key === '*' ? 'true' : 'false'; ?>">
              <?php echo htmlspecialchars($label); ?>
              <span class="gallery__count"><?php echo $key === '*' ? count($gallery_items) : ($counts[$key] ?? 0); ?></span>
            </button>
          <?php endforeach; ?>
        </div>

        <ul class="gallery__grid">
          <?php foreach ($gallery_items as [$filterClass, $imgSrc, $title, $desc, $link]) :
              $thumb = mtc_thumb($imgSrc); ?>
            <li class="gallery-tile" data-filter="<?php echo $filterClass; ?>">
              <a href="<?php echo htmlspecialchars(mtc_img($imgSrc)); ?>" class="gallery-tile__zoom"
                 data-gallery="gallery" data-title="<?php echo htmlspecialchars($title . ' – ' . $desc); ?>"
                 aria-label="Enlarge photo: <?php echo htmlspecialchars($title . ', ' . $desc); ?>">
                <img src="<?php echo htmlspecialchars($thumb); ?>" <?php echo mtc_img_size($thumb); ?>
                     alt="<?php echo htmlspecialchars($title . ' – ' . $desc); ?>" loading="lazy" decoding="async">
                <span class="gallery-tile__icon" aria-hidden="true"><i class="fas fa-search-plus"></i></span>
              </a>
              <div class="gallery-tile__caption">
                <span class="gallery-tile__title"><?php echo htmlspecialchars($title); ?></span>
                <a href="<?php echo $link; ?>" class="gallery-tile__link">View product <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>

  </main>

  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></a>

  <!-- No Bootstrap bundle and no Isotope (43 KB): a CSS grid and gallery.js
       do the filtering. GLightbox stays for the enlarged view. -->
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo mtc_asset('assets/js/main.js'); ?>"></script>
  <script src="<?php echo mtc_asset('assets/js/gallery.js'); ?>"></script>

</body>
</html>
