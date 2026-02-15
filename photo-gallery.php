<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Photo Gallery | Manual Tools Company</title>
  
  <?php include('common-head.php'); ?>
  
  <link href="assets/css/product-detail.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <?php include('header.php'); ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Photo Gallery</h2>
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
          // SAFE ARRAY DEFINITION
          $gallery_items = array(
              array('filter-crusher', 'assets/img/about-us-products/Coal Crusher.jpg', 'Single Disc Crusher', '5 No. Size'),
              array('filter-crusher', 'assets/img/about-us-products/Coal Crusher Double Disc.jpg', 'Double Disc Crusher', 'High Capacity'),
              array('filter-crusher', 'assets/img/about-us-products/Double Drive Coke Cutter Machine.jpg', 'Coke Cutter', 'Double Drive'),
              
              array('filter-oven', 'assets/img/about-us-products/Pusher Machine With Stamping Arrangement.jpg', 'Pusher Machine', 'Roller Stamping'),
              array('filter-oven', 'assets/img/about-us-products/Coal-Charging-Car.jpg', 'Coal Charging Car', 'Top Charging'),
              
              array('filter-winch', 'assets/img/about-us-products/Haulage Machine.jpg', 'Haulage Machine', '10 Ton Pulling'),
              array('filter-winch', 'assets/img/about-us-products/Power Winchh.jpg', 'Power Winch', 'Door Lifter'),
              
              array('filter-screen', 'assets/img/about-us-products/Vibrator Screen Machine.jpg', 'Vibrator Screen', 'Multi-Deck'),
              array('filter-screen', 'assets/img/about-us-products/Conveyor Material.jpeg', 'Conveyor Parts', 'Idlers & Pulleys')
          );

          if (!empty($gallery_items)) {
              foreach ($gallery_items as $item) {
                  $filterClass = $item[0];
                  $imgSrc = $item[1];
                  $title = $item[2];
                  $desc = $item[3];
                  
                  // Check if image exists to prevent broken icons (Optional Check)
                  // if (!file_exists($imgSrc)) { continue; } 
          ?>
            <div class="col-lg-4 col-md-6 portfolio-item <?php echo $filterClass; ?>">
              <div class="portfolio-wrap">
                <img src="<?php echo $imgSrc; ?>" class="img-fluid" alt="<?php echo $title; ?>">
                
                <div class="portfolio-info">
                  <h4><?php echo $title; ?></h4>
                  <p><?php echo $desc; ?></p>
                  <div class="portfolio-links">
                    <a href="<?php echo $imgSrc; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $title; ?>">
                      <i class="fas fa-plus"></i>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

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