<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Manual Tools Company is a leading Coke Oven Machinery Manufacturer in India">
  <meta name="keywords" content="Manual Toools Company, Manual Tools Co, Coke Cutter,Coke Oven">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Coke Cutter Machine - Manual Tools Company</title>
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
          <h2>Coke Cutter </h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Coke Cutter </li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Coke Cutter Double Drive ======= -->
    <section id="products-page" class="products-page">
      <div class="container">
        <div class="row no-gutters">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start">
            <img src="assets/img/about-us-products/Double Drive Coke Cutter Machine.jpg" alt="Coal Crusher">
          </div>
          <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
            <div class="content d-flex flex-column justify-content-center">
              <h3>Coke Cutter Machine (Double Drive)</h3>
              <h4>
                Type : Coke Cutter
              </h4>
              <p>

                The Coke Cutter Machine (Double Drive) is a specialized industrial equipment designed for efficiently cutting and slicing coke blocks used in various manufacturing processes. Featuring a double drive system, it ensures enhanced power and precision during operation. This machine streamlines the cutting process, increasing productivity while maintaining quality standards. Ideal for industries reliant on coke as a crucial raw material, it offers reliability and performance in handling bulk quantities.
              </p>

              <div class="icon-box">
                <i class="fa fa-gear"></i>
                <h4>
                  Specifications : </h4>
              </div>

              <ul>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Driven by:</strong> 20 H.P. Electrical Motor Both Side</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Coke Feed Size:</strong> Below 200 mm</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Finished Coke Size:</strong> Below 60 mm</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Coke Breaking Capacity:</strong> 12 to 15 Tons per Hour</li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Manganese Steel Replacebale Liner Teeth</strong></li>
                <li><span class="icon"><i class="fas fa-check"></i></span> <strong>Cast Steel Machine Cut Gear & Pinion Both Side</strong></li>
              </ul>
              <a href="contact.php" class="btn-get-started">Get Quote</a>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Coke Cutter Double Drive -->

    <!-- Product Images -->

    <!-- ======= Portfolio Section ======= -->
    <?php
    $directory = "assets/img/product-images/coke-cutter/"; // Directory path
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