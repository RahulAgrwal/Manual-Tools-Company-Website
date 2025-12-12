<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Conveyor Materials and components: idlers, rollers, pulleys, available in various sizes for industrial conveying. Manual Tools Company, India.">
  <meta name="keywords" content="Conveyor Materials, Conveyor Components, Idlers, Rollers, Head Pulley, Tail Pulley, Impact Rollers, Industrial Conveyor Parts, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/conveyor-materials">
  
  <title>Conveyor Materials | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/conveyor-materials">
  <meta property="og:title" content="Conveyor Materials | Manual Tools Company">
  <meta property="og:description" content="Conveyor components including idlers, return and impact rollers, and pulleys in various sizes.">
  <meta property="og:image" content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Conveyor-Material.png">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Conveyor Materials",
    "image": ["https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Conveyor-Material.png"],
    "description": "Conveyor materials and parts for industrial conveying systems. Includes idlers, rollers, pulleys, and components designed to withstand heavy loads.",
    "brand": {"@type": "Brand", "name": "Manual Tools Company"},
    "manufacturer": {"@type": "Organization", "name": "Manual Tools Company"},
    "category": "Conveyor Components",
    "additionalProperty": [
      {"@type": "PropertyValue", "name": "Stock", "value": "Idler with Roller; Return Rollers; Impact Rollers; Head Pulley; Tail Pulley"},
      {"@type": "PropertyValue", "name": "Available Sizes", "value": "Belt widths: 600mm, 750mm, 900mm, 1000mm"}
    ]
  }
  </script>

  <?php include('common-head.php'); ?>
</head>

<body>

  <!-- ======= Header ======= -->
  <?php include('header.php'); ?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Modern Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Conveyor Materials</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Conveyor Materials</li>
          </ol>
        </div>
      </div>
    </section>

    <!-- ======= Modern Product Showcase ======= -->
    <section id="product-showcase" class="mtc-product-showcase">
      <div class="container">
        <div class="row align-items-center">
          
          <!-- LEFT COL: Image Area -->
          <div class="col-lg-6">
            <div class="prod-img-wrapper">
              <span class="prod-badge">Heavy Industry Series</span>
              
              <!-- Thumbnail -->
              <img 
                id="thumbImage" 
                src="assets/img/about-us-products-thumbnail/Conveyor-Material.png" 
                alt="Conveyor Materials Thumbnail"
                class="img-fluid"
              >

              <!-- Main Image (Hidden until loaded) -->
              <img 
                id="mainImage" 
                src="assets/img/about-us-products/Conveyor Material.jpeg" 
                alt="Conveyor Materials HD"
                class="img-fluid"
                style="display:none;"
              >
            </div>
          </div>

          <!-- RIGHT COL: Details & Specs -->
          <div class="col-lg-6">
            <div class="prod-details">
              <span class="prod-cat">Industrial Conveyor Systems</span>
              <h1 class="prod-title">Conveyor Materials</h1>
              
              <p class="prod-desc">
                Engineered for the rigorous demands of the coke oven industry, our conveyor materials ensure efficient handling of coal and by-products. Featuring heavy-duty frames, high-temperature resistance, and precision engineering for continuous operation.
              </p>

              <!-- Technical Specs Grid -->
              <div class="specs-container">
                <div class="specs-title">
                  <i class="fas fa-cog"></i> Available Configurations
                </div>
                <div class="specs-grid">
                  <div class="spec-item"><i class="fas fa-check"></i> Idler with Roller</div>
                  <div class="spec-item"><i class="fas fa-check"></i> Return Rollers</div>
                  <div class="spec-item"><i class="fas fa-check"></i> Impact Rollers</div>
                  <div class="spec-item"><i class="fas fa-check"></i> Head Pulley</div>
                  <div class="spec-item"><i class="fas fa-check"></i> Tail Pulley</div>
                  
                  <!-- Highlighted Spec -->
                  <div class="spec-item spec-highlight">
                    <i class="fas fa-ruler-combined"></i> 
                    Belt Widths: 600mm to 1400mm
                  </div>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="prod-actions">
                <a href="contact" class="btn-quote-modern">
                  Request Quote <i class="bi bi-arrow-right ms-2"></i>
                </a>
                <a href="tel:9430707348" class="btn-contact-outline">
                  <i class="bi bi-telephone"></i> Call Us
                </a>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ======= Combined Gallery & FAQ Section ======= -->
    <section id="portfolio" class="portfolio section-bg" style="padding: 60px 0;">
      <div class="container">
        
        <div class="row">
          
          <!-- LEFT COLUMN: Photo Gallery (65% Width) -->
          <div class="col-lg-8">
            <div class="section-title text-start" style="text-align: left; margin-bottom: 30px;">
              <h2>Product <strong>Gallery</strong></h2>
              <p>High-resolution images of our conveyor components in action.</p>
            </div>

            <div class="row portfolio-container g-3">
              <?php
              $directory = "assets/img/product-images/conveyor-materials/";
              $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

              if (!empty($images)) {
                foreach ($images as $image) { ?>
                  <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                      <img src="<?php echo $image; ?>" class="img-fluid" alt="Conveyor Component">
                      <div class="portfolio-info">
                        <h4>Conveyor Part</h4>
                        <div class="portfolio-links">
                          <a href="<?php echo $image; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="View Large"><i class="bx bx-plus"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }
              } else {
                echo '<div class="col-12"><div class="alert alert-light">No images currently available.</div></div>';
              }
              ?>
            </div>
          </div>

          <!-- RIGHT COLUMN: FAQ Section (35% Width) -->
          <div class="col-lg-4 mt-5 mt-lg-0">
            <div class="faq-wrapper">
              <div class="section-header-small">
                <h3>Common Questions</h3>
                <p>Details about materials & dimensions.</p>
              </div>

              <div class="accordion custom-accordion" id="conveyorFAQ">

                <?php
                // FAQ Data Specific to Conveyor Materials
                $conveyor_faqs = [
                    [
                        "q" => "What belt widths are supported?",
                        "a" => "Our idlers and pulleys are compatible with standard belt widths including 600mm, 750mm, 800mm, 900mm, 1000mm, 1200mm, and 1400mm."
                    ],
                    [
                        "q" => "Are the rollers impact resistant?",
                        "a" => "Yes, we supply specialized Impact Rollers with rubber rings designed to absorb shock at loading points, protecting the belt."
                    ],
                    [
                        "q" => "Do you provide head and tail pulleys?",
                        "a" => "Yes, we manufacture heavy-duty Head and Tail Pulleys."
                    ],
                    [
                        "q" => "What is the bearing life?",
                        "a" => "We use high-quality sealed bearings in our idlers, designed to withstand dust and moisture for a long operational life in coke plants."
                    ]
                ];

                foreach($conveyor_faqs as $index => $faq) {
                    $headingId = "headingConv" . $index;
                    $collapseId = "collapseConv" . $index;
                    $isFirst = ($index === 0);
                    $showClass = $isFirst ? "show" : "";
                    $btnCollapsed = $isFirst ? "" : "collapsed";
                    $ariaExpanded = $isFirst ? "true" : "false";
                ?>

                <!-- FAQ Card -->
                <div class="card">
                  <div class="card-header" id="<?php echo $headingId; ?>">
                    <h5 class="mb-0">
                      <button class="btn btn-link w-100 text-left <?php echo $btnCollapsed; ?>" 
                              type="button" 
                              data-bs-toggle="collapse" 
                              data-bs-target="#<?php echo $collapseId; ?>" 
                              aria-expanded="<?php echo $ariaExpanded; ?>" 
                              aria-controls="<?php echo $collapseId; ?>">
                        <?php echo $faq['q']; ?>
                        <i class="fas fa-plus float-right"></i>
                      </button>
                    </h5>
                  </div>

                  <div id="<?php echo $collapseId; ?>" 
                       class="accordion-collapse collapse <?php echo $showClass; ?>" 
                       aria-labelledby="<?php echo $headingId; ?>" 
                       data-bs-parent="#conveyorFAQ">
                    <div class="card-body">
                      <?php echo $faq['a']; ?>
                    </div>
                  </div>
                </div>
                <!-- End Card -->

                <?php } ?>

              </div>
            </div>
          </div>
          <!-- End FAQ Column -->

        </div>
      </div>
    </section>

  </main>

  <!-- ======= Footer ======= -->
  <?php include("footer.php"); ?>
  
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- Image Swap Script -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var thumb = document.getElementById('thumbImage');
      var main = document.getElementById('mainImage');
      
      var hdImg = new Image();
      hdImg.src = main.src;
      
      hdImg.onload = function() {
        thumb.style.display = 'none';
        main.style.display = 'block';
        main.classList.add('animate__animated', 'animate__fadeIn');
      };
    });
  </script>

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