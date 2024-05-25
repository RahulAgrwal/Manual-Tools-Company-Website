<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Manual Tools Company is a leading Coke Oven Machinery Manufacturer in India">
  <meta name="keywords" content="Manual Toools Company, Manual Tools Co, Haulage, Power Winch, Vibrator">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Haulage- Manual Tools Company</title>
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
          <h2>Haulage </h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Haulage </li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Haulage ======= -->
    <section id="products-page" class="products-page">
      <div class="container">
        <div class="row no-gutters">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start">
            <img src="assets/img/about-us-products/Haulage Machine.jpg" alt="Coal Crusher">
          </div>
          <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
            <div class="content d-flex flex-column justify-content-center">
              <h3>Haulage Machine </h3>
              <h4>
                Type : Haulage
              </h4>
              <p>
                In the coke oven industry, the haulage machine serves a vital function by pulling coke from the coke ovens. This specialized equipment is designed to efficiently extract the coke, a valuable product of the coking process, from the ovens. Equipped with robust features and powerful pulling capabilities, haulage machines are essential for maintaining a steady flow of coke production. Their reliable performance ensures smooth operations and contributes to the overall efficiency of the coke oven industry.
              </p>

              <div class="icon-box">
                <i class="fa fa-gear"></i>
                <h4>
                  Specifications : </h4>
              </div>

              <ul>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Driven by:</strong> 10 H.P. Electrical Motor</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Pulling Capacity:</strong> 10 Tons</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Gearbox Type:</strong> Worm Reducer</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Cast steel machine-cut gear and pinion</strong></li>
              </ul>
              <a href="contact.php" class="btn-get-started">Get Quote</a>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Haulage -->

    <!-- Product Images -->

    <!-- ======= Portfolio Section ======= -->
    <?php
    $directory = "assets/img/product-images/haulage/"; // Directory path
    $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE); // Fetch all image files from the directory

    if (!empty($images)) {
      echo '<!-- ======= Portfolio Section ======= -->';
      echo '<section id="portfolio" class="portfolio">';
      echo '<div class="container">';
      echo '<div class="section-title" data-aos="fade-up"> <h2><strong>Product Gallery</strong></h2></div>';
      echo '<div class="row portfolio-container" data-aos="fade-up">';

      foreach ($images as $image) {
        echo '<div class="col-lg-4 col-md-6 portfolio-item filter-app">';
        echo '<img src="' . $image . '" class="img-fluid" alt="">';
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