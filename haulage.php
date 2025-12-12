<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Haulage Machine for coke handling. 10 HP motor, 10 ton pulling capacity, worm reducer gearbox. Durable build for coke oven operations.">
  <meta name="keywords" content="Haulage Machine, Coke Oven Haulage, Industrial Haulage, Pulling Machine, Worm Reducer Gearbox, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/haulage">
  
  <title>Haulage Machine - Coke Oven | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/haulage">
  <meta property="og:title" content="Haulage Machine - Coke Oven | Manual Tools Company">
  <meta property="og:description" content="Industrial haulage for coke handling with 10 HP motor and 10 ton pulling capacity.">
  <meta property="og:image" content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Haulage-Machine.png">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Haulage Machine",
    "image": ["https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Haulage-Machine.png"],
    "description": "Haulage Machine for pulling coke from ovens, built for reliability and strength.",
    "brand": {"@type": "Brand", "name": "Manual Tools Company"},
    "manufacturer": {"@type": "Organization", "name": "Manual Tools Company"},
    "category": "Industrial Haulage",
    "additionalProperty": [
      {"@type": "PropertyValue", "name": "Driven by", "value": "10 H.P. Electrical Motor"},
      {"@type": "PropertyValue", "name": "Pulling Capacity", "value": "10 Tons"},
      {"@type": "PropertyValue", "name": "Gearbox Type", "value": "Worm Reducer"}
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
          <h2>Haulage Machine</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Haulage</li>
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
              <span class="prod-badge">Heavy Duty Traction</span>
              
              <!-- Thumbnail -->
              <img 
                id="thumbImage" 
                src="assets/img/about-us-products-thumbnail/Haulage-Machine.png" 
                alt="Haulage Machine Thumbnail"
                class="img-fluid"
              >

              <!-- Main Image (Hidden until loaded) -->
              <img 
                id="mainImage" 
                src="assets/img/about-us-products/Haulage Machine.jpg" 
                alt="Haulage Machine HD"
                class="img-fluid"
                style="display:none;"
              >
            </div>
          </div>

          <!-- RIGHT COL: Details & Specs -->
          <div class="col-lg-6">
            <div class="prod-details">
              <span class="prod-cat">Coke Extraction Machinery</span>
              <h1 class="prod-title">Haulage Machine</h1>
              
              <p class="prod-desc">
                Vital for the coke oven industry, this Haulage Machine is engineered to efficiently extract coke from ovens. Equipped with a powerful 10 HP motor and a robust worm reducer gearbox, it provides the consistent pulling force needed to maintain a steady flow of production.
              </p>

              <!-- Technical Specs Grid -->
              <div class="specs-container">
                <div class="specs-title">
                  <i class="fas fa-cog"></i> Technical Specifications
                </div>
                <div class="specs-grid">
                  <div class="spec-item"><i class="fas fa-bolt"></i> Motor: 10 H.P. Electrical</div>
                  <div class="spec-item"><i class="fas fa-cogs"></i> Gearbox: Worm Reducer</div>
                  <div class="spec-item"><i class="fas fa-shield-alt"></i> Gears: Cast Steel Machine-Cut</div>
                  <div class="spec-item"><i class="fas fa-industry"></i> Application: Coke Extraction</div>
                  
                  <!-- Highlighted Spec -->
                  <div class="spec-item spec-highlight">
                    <i class="fas fa-truck-loading"></i> 
                    Pulling Capacity: 10 Tons
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
              <p>Visual details of the motor, gearbox, and chassis.</p>
            </div>

            <div class="row portfolio-container g-3">
              <?php
              $directory = 'assets/img/product-images/haulage/';
              $images = glob($directory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

              if (!empty($images)) {
                foreach ($images as $image) { ?>
                  <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                    <div class="portfolio-wrap">
                      <img src="<?php echo $image; ?>" class="img-fluid" alt="Haulage Machine View">
                      <div class="portfolio-info">
                        <h4>Haulage Machine</h4>
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
                <p>Specifics about the Haulage Machine.</p>
              </div>

              <div class="accordion custom-accordion" id="haulageFAQ">

                <?php
                // FAQ Data Specific to Haulage Machine
                $haulage_faqs = [
                    [
                        "q" => "What is the maximum pulling capacity?",
                        "a" => "This heavy-duty Haulage Machine is designed with a pulling capacity of up to 10 Tons, suitable for standard coke oven operations."
                    ],
                    [
                        "q" => "What type of gearbox is used?",
                        "a" => "We use a high-torque Worm Reducer Gearbox paired with cast steel machine-cut gears for smooth and reliable power transmission."
                    ],
                    [
                        "q" => "Does it require a specific motor?",
                        "a" => "Yes, it is optimized to run on a 10 H.P. Electrical Motor to ensure sufficient torque for extraction."
                    ]
                ];

                foreach($haulage_faqs as $index => $faq) {
                    $headingId = "headingHaul" . $index;
                    $collapseId = "collapseHaul" . $index;
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
                       data-bs-parent="#haulageFAQ">
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

    <!-- ======= Video Gallery Section ======= -->
    <section id="video-gallery" class="video-gallery" style="background: #fff; padding-bottom: 80px;">
      <div class="container">
        <div class="section-title">
          <h2><strong>Operation</strong> Videos</h2>
          <p>See the Haulage Machine in action during maintenance and operation.</p>
        </div>
        
        <div class="row">
          <!-- Main Video Player -->
          <div class="col-lg-8 mb-4">
            <div class="main-video-container">
              <video id="main-video" controls class="img-fluid" poster="assets/img/about-us-products/Haulage Machine.jpg">
                <!-- Video source inserted via JS -->
              </video>
              <h4 id="video-title" class="mt-3" style="font-weight: 700;">Haulage Machine in Action</h4>
            </div>
          </div>
          
          <!-- Video Thumbnail List -->
          <div class="col-lg-4">
            <div class="video-list-container">
              <div class="video-list">
                <?php
                // Define video array
                $videos = [
                  [
                    'id' => 1,
                    'title' => 'Haulage Machine Operation',
                    'url' => 'assets/img/product-images/haulage/Haulage Machine Operation.mp4',
                    'thumbnail' => 'assets/img/about-us-products/Haulage Machine.jpg'
                  ],
                  [
                    'id' => 2,
                    'title' => 'Full Working Process',
                    'url' => 'assets/img/product-images/haulage/Full Working Process.mp4',
                    'thumbnail' => 'assets/img/about-us-products/Haulage Machine.jpg'
                  ]
                ];

                // Output video list items
                foreach ($videos as $video) {
                  echo '<div class="video-item" data-id="' . $video['id'] . '" onclick="loadVideo(' . $video['id'] . ')">
                          <img src="' . $video['thumbnail'] . '" alt="' . $video['title'] . '" class="video-thumbnail">
                          <p class="video-list-title" style="font-weight:600;">' . $video['title'] . '</p>
                        </div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Video Logic Script -->
    <script>
      const videos = <?php echo json_encode($videos); ?>;
      const mainVideo = document.getElementById('main-video');
      const videoTitle = document.getElementById('video-title');
      
      function initVideoPlayer() {
        if (videos.length > 0) {
          loadVideo(videos[0].id);
        }
      }
      
      function loadVideo(videoId) {
        const video = videos.find(v => v.id == videoId);
        if (video) {
          mainVideo.innerHTML = `<source src="${video.url}" type="video/mp4">`;
          mainVideo.poster = video.thumbnail;
          videoTitle.textContent = video.title;
          mainVideo.load();
          
          document.querySelectorAll('.video-item').forEach(item => {
            item.classList.remove('active');
            if (parseInt(item.dataset.id) === video.id) {
              item.classList.add('active');
            }
          });
        }
      }
      document.addEventListener('DOMContentLoaded', initVideoPlayer);
    </script>

  </main>

  <!-- ======= Footer ======= -->
  <?php include('footer.php'); ?>
  
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