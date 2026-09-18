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

  <?php $mtc_page_css = ['assets/css/legacy-product.css', 'assets/vendor/glightbox/css/glightbox.min.css']; ?>
  <?php include('common-head.php'); ?>
  <?php mtc_breadcrumb_schema(['Photo Gallery' => 'photo-gallery']); ?>


</head>

<body>

  <!-- ======= Header ======= -->
  <?php include('header.php'); ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h1>Photo Gallery</h1>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Gallery</li>
          </ol>
        </div>
      </div>
    </section>

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <p class="text-muted text-center mx-auto mb-4" style="max-width: 800px;">
          Photos of machines built in our Dhanbad workshop and installed at client plants. Filter by machine type, and
          open any product page for full specifications.
        </p>

        <!-- Filters -->
        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All Photos</li>
              <li data-filter=".filter-crusher">Crushers</li>
              <li data-filter=".filter-oven">Oven Machines</li>
              <li data-filter=".filter-winch">Winches</li>
              <li data-filter=".filter-screen">Screens</li>
            </ul>
          </div>
        </div>

        <!-- Gallery Grid -->
        <div class="row portfolio-container">

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

          $gallery_items = array();
          foreach ($gallery_products as $p) {
              $photos = glob('assets/img/product-images/' . $p[2] . '/*.{jpg,jpeg,png}', GLOB_BRACE) ?: array();
              $photos = array_values(array_filter($photos, function ($f) {
                  return strpos($f, 'process-diagram') === false;
              }));
              array_unshift($photos, $p[1]);
              foreach ($photos as $n => $photo) {
                  $gallery_items[] = array($p[0], $photo, $p[3], $n === 0 ? $p[4] : 'Photo ' . ($n + 1), $p[5]);
              }
          }

          if (!empty($gallery_items)) {
              foreach ($gallery_items as $item) {
                  $filterClass = $item[0];
                  $imgSrc = $item[1];
                  $title = $item[2];
                  $desc = $item[3];
                  $link = $item[4];

                  // Check if image exists to prevent broken icons (Optional Check)
                  // if (!file_exists($imgSrc)) { continue; }
          ?>
            <div class="col-lg-4 col-md-6 portfolio-item <?php echo $filterClass; ?>">
              <div class="portfolio-wrap">
                <img src="<?php echo htmlspecialchars(mtc_thumb($imgSrc)); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($title . ' – ' . $desc); ?>" loading="lazy" decoding="async">

                <div class="portfolio-info">
                  <h4><?php echo htmlspecialchars($title); ?></h4>
                  <p><?php echo htmlspecialchars($desc); ?></p>
                  <div class="portfolio-links">
                    <a href="<?php echo htmlspecialchars(mtc_img($imgSrc)); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo htmlspecialchars($title); ?>" aria-label="Enlarge photo">
                      <i class="fas fa-plus"></i>
                    </a>
                    <a href="<?php echo $link; ?>" title="View product" aria-label="View <?php echo htmlspecialchars($title); ?>">
                      <i class="fas fa-link"></i>
                    </a>
                  </div>
                </div>

              </div>
            </div>
          <?php
              }
          } else {
              echo '<div class="col-12 text-center"><p>No images found in gallery configuration.</p></div>';
          }
          ?>

        </div>

      </div>
    </section>

  </main>

  <!-- ======= Footer ======= -->
  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top"><i class="fas fa-arrow-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Gallery Initialization Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Initialize GLightbox
      const lightbox = GLightbox({
        selector: '.portfolio-lightbox'
      });

      // Initialize Isotope for filtering
      let portfolioContainer = document.querySelector('.portfolio-container');
      if (portfolioContainer) {
        let portfolioIsotope = new Isotope(portfolioContainer, {
          itemSelector: '.portfolio-item',
          layoutMode: 'fitRows'
        });

        portfolioContainer.querySelectorAll('img').forEach(function(img) {
          img.addEventListener('load', function() { portfolioIsotope.layout(); });
        });

        let portfolioFilters = document.querySelectorAll('#portfolio-flters li');
        portfolioFilters.forEach(function(filterBtn) {
          filterBtn.addEventListener('click', function(e) {
            e.preventDefault();
            portfolioFilters.forEach(function(el) { el.classList.remove('filter-active'); });
            this.classList.add('filter-active');

            portfolioIsotope.arrange({
              filter: this.getAttribute('data-filter')
            });
          });
        });
      }
    });
  </script>

</body>
</html>