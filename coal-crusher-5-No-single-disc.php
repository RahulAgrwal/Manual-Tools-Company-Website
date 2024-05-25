<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Manual Tools Company is a leading Coke Oven Machinery Manufacturer in India">
  <meta name="keywords" content="Manual Toools Company, Manual Tools Co, Coal Crusher">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Coal Crusher (5 No. Size) Single Disc - Manual Tools Company</title>

  <?php
  include('common-head.php');
  ?>
</head>

<body>


  <!-- ======= Header ======= -->
  <?php
  include('header.php');
  ?><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Coal Crusher </h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Coal Crusher </li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Coal Crusher Single Disc ======= -->
    <section id="products-page" class="products-page">
      <div class="container">
        <div class="row no-gutters">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start">
            <img src="assets/img/about-us-products/Coal Crusher.jpg" alt="Coal Crusher Single Disc">
          </div>
          <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
            <div class="content d-flex flex-column justify-content-center">
              <h3>Coal Crusher (5 No. Size) Single Disc</h3>
              <h4>
                Type : Coal Disintegrator
              </h4>
              <p>
                A Coal Crusher (5 No. Size) Single Disc is a type of coal disintegrator designed for pulverizing coal into smaller particles. This equipment typically features a single rotating disc that crushes the coal fed into it, breaking it down into finer granules suitable for various industrial applications. Its design and operation are focused on efficiently reducing coal sizes while ensuring uniformity and consistency in the output. This type of coal crusher is commonly used in industries such as mining, power generation, and metallurgy for processing coal for combustion or further processing.
              </p>

              <div class="icon-box">
                <i class="fa fa-gear"></i>
                <h4>
                  Specifications : </h4>
              </div>

              <ul>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Driven by:</strong> 80 - 120 H.P. Electrical Motor</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Coal Feed Size:</strong> below 125 mm</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Crushed Coal Size:</strong> below 2 mm</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Coal Crushing Capacity:</strong> 8 to 10 Tons per Hour</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Crusher’s Body:</strong> 12 mm thick</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Manganese Steel Top & Side Liner Jaw Plate</strong></li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Six Nos. Hammers provided in this Crusher</strong></li>
              </ul>
              <a href="contact.php" class="btn-get-started">Get Quote</a>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Coal Crusher Single Disc -->
    <!-- Product Images -->

    <!-- ======= Portfolio Section ======= -->
    <?php
    $directory = "assets/img/product-images/coal-crusher/"; // Directory path
    $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE); // Fetch all image files from the directory

    if (!empty($images)) {
      echo '<!-- ======= Portfolio Section ======= -->';
      echo '<section id="portfolio" class="portfolio">';
      echo '<div class="container">';
      echo '<div class="section-title" data-aos="fade-up"> <h2><strong>Product Gallery</strong></h2></div>';
      echo '<div class="row portfolio-container" data-aos="fade-up">';

      foreach ($images as $image) {
        echo '<div class="col-lg-4 col-md-6 portfolio-item filter-app">';
        echo '<img src="' . $image . '" class="img-fluid" alt="Coal Crusher Single Disc">';
        echo '<div class="portfolio-info">';
        echo '<p>Coal Crusher (5 No. Size)</p>';
        echo '<a href="' . $image . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" ><i class="bx bx-plus"></i></a>';
        echo '</div>';
        echo '</div>';
      }

      echo '</div>';
      echo '</div>';
      echo '</section><!-- End Portfolio Section -->';
    }
    ?><!-- End Portfolio Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>