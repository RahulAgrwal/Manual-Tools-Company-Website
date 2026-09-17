<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Coke oven haulage machine (haulage winch) with 10 HP motor, worm reducer gearbox and 10-ton pull, for coke cake extraction, rail shunting and mines. Made in Dhanbad.">
  <meta name="keywords"
    content="Coke Oven Haulage Machine, Haulage Winch, Haulage Machine, Coke Oven Haulage, Industrial Winch, 10 Ton Haulage, Worm Reducer Gearbox, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/haulage">

  <title>Coke Oven Haulage Machine (10 Ton, 10 HP) | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/haulage">
  <meta property="og:title" content="Coke Oven Haulage Machine (10 Ton, 10 HP) | Manual Tools Company">
  <meta property="og:description" content="10 HP coke oven haulage machine with worm reducer gearbox and 10 ton pulling capacity.">
  <meta property="og:image"
    content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Haulage-Machine.png">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Coke Oven Haulage Machine (10 Ton)",
    "image": "https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Haulage-Machine.png",
    "description": "Electric Haulage Machine designed for coke oven extraction. Features 10 HP motor, worm reducer gearbox, and 10-ton pulling capacity.",
    "sku": "MTC-HM-10T",
    "brand": { "@type": "Brand", "name": "Manual Tools Company" },
    "manufacturer": { "@type": "Organization", "name": "Manual Tools Company", "url": "https://www.manualtoolsco.com/" },
    "url": "https://www.manualtoolsco.com/haulage",
    "additionalProperty": [
      { "@type": "PropertyValue", "name": "Motor Power", "value": "10 H.P. Electrical" },
      { "@type": "PropertyValue", "name": "Pulling Capacity", "value": "10 Tons" },
      { "@type": "PropertyValue", "name": "Gearbox", "value": "Worm Reducer Type" },
      { "@type": "PropertyValue", "name": "Application", "value": "Coke Oven / Mining" }
    ]
  }
  </script>

  <?php include('common-head.php'); ?>
  <?php mtc_breadcrumb_schema(['Products' => 'products', 'Coke Oven Haulage Machine' => 'haulage']); ?>
  <link href="assets/css/product-detail.css" rel="stylesheet">

  <style>
    /* Specific styles for video thumbnails */
    .mtc-video-thumb-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 24px;
        transition: background 0.3s;
    }
    .mtc-product-thumb-item:hover .mtc-video-thumb-overlay,
    .mtc-product-thumb-item.active .mtc-video-thumb-overlay {
        background: rgba(240, 60, 2, 0.4); /* Primary Color Overlay */
    }
    .mtc-product-thumb-item { position: relative; }
  </style>
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
          <h2>Coke Oven Haulage Machine</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li><a href="products">Products</a></li>
            <li>Coke Oven Haulage Machine</li>
          </ol>
        </div>
      </div>
    </section>

    <section class="mtc-product-hero">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 mb-4 mb-lg-0">
            <?php
            // 1. Define Main Static Image
            $mainImgObj = [
                'type' => 'image',
                'src' => mtc_img('assets/img/about-us-products/Haulage Machine.jpg'),
                'thumb' => mtc_thumb('assets/img/about-us-products/Haulage Machine.jpg')
            ];

            // 2. Fetch Gallery Images from Folder
            $directory = "assets/img/product-images/haulage/";

            // Get Images
            $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            $galleryImgs = [];
            if($images) {
                foreach($images as $img) {
                    $galleryImgs[] = ['type' => 'image', 'src' => mtc_img($img), 'thumb' => mtc_thumb($img)];
                }
            }

            // Get Videos
            $videos = glob($directory . "*.{mp4,webm}", GLOB_BRACE);
            $galleryVids = [];
            if($videos) {
                foreach($videos as $vid) {
                    // Use main image as placeholder thumb for video if no specific thumb exists
                    $galleryVids[] = ['type' => 'video', 'src' => $vid, 'thumb' => mtc_thumb('assets/img/about-us-products/Haulage Machine.jpg')];
                }
            }

            // 3. Merge All Media (Main -> Images -> Videos)
            $mediaList = array_merge([$mainImgObj], $galleryImgs, $galleryVids);
            ?>

            <!-- Main Display Area (Image or Video) -->
            <div class="mtc-product-main-frame text-center" id="mtc-main-display">
              <!-- Default loads the first image -->
              <img src="<?php echo htmlspecialchars($mediaList[0]['src']); ?>" <?php echo mtc_img_size($mediaList[0]['src']); ?> fetchpriority="high" alt="Coke oven haulage machine, 10 HP / 10 ton" class="img-fluid">
            </div>

            <!-- Thumbnails Grid -->
            <div class="mtc-product-thumb-grid">
              <?php foreach ($mediaList as $index => $media): ?>
                <div class="mtc-product-thumb-item <?php echo $index === 0 ? 'active' : ''; ?>"
                     onclick="swapMedia(this)"
                     data-type="<?php echo $media['type']; ?>"
                     data-src="<?php echo htmlspecialchars($media['src']); ?>">

                  <img src="<?php echo htmlspecialchars($media['thumb']); ?>" loading="lazy" alt="<?php echo htmlspecialchars('Coke Oven Haulage Machine ' . ($media['type'] === 'video' ? 'video ' : 'photo ') . ($index + 1)); ?>">

                  <?php if($media['type'] === 'video'): ?>
                    <div class="mtc-video-thumb-overlay">
                        <i class="fas fa-play-circle"></i>
                    </div>
                  <?php endif; ?>

                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="col-lg-6 ps-lg-5">
            <div class="mtc-product-eyebrow">Coke Oven Extraction Series</div>
            <h1 class="mtc-product-title">Coke Oven Haulage Machine <br><span class="mtc-highlight">10 HP / 10 Ton</span></h1>

            <div class="mtc-product-review-row">
              <span>Model: MTC-HM-10T</span>
              <span class="mtc-product-stock-badge">Made to Order</span>
            </div>

            <p style="line-height: 1.6; color: #555;">
              Engineered for the demanding environment of coke ovens and mines, this heavy-duty Haulage Machine utilizes a high-torque <strong>Worm Reducer Gearbox</strong> powered by a 10 HP motor. It ensures steady, reliable pulling power (up to 10 Tons) for extracting coke or moving heavy industrial loads.
            </p>

            <div class="mtc-product-specs-grid">
              <div class="mtc-product-spec-item">
                <i class="fas fa-weight-hanging mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Pulling Capacity</span>
                  <strong>10 Tons</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-bolt mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Motor Power</span>
                  <strong>10 HP (Elec.)</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-cogs mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Gearbox Type</span>
                  <strong>Worm Reducer</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-truck-loading mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Application</span>
                  <strong>Coke / Mining</strong>
                </div>
              </div>
            </div>

            <div class="mtc-product-action-row">
              <a href="brochure/Manual_Tools_Co_Haulage_Machine.pdf" class="mtc-btn-dark" download>
                <i class="fas fa-download"></i> Brochure
              </a>
              <a href="#quote-form" class="mtc-btn-orange">
                <i class="fas fa-file-signature"></i> Request Quote
              </a>
              <a href="tel:+919430707348" class="mtc-btn-call-us">
                <i class="fas fa-phone"></i> Call Us
              </a>
            </div>

            <div class="mtc-product-trust-badges">
              <span><i class="fas fa-check-circle"></i> ISO 9001:2015</span>
              <span><i class="fas fa-shield-alt"></i> Heavy Duty Chassis</span>
              <span><i class="fas fa-wrench"></i> Low Maintenance</span>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- ======= Overview & buying information ======= -->
    <section class="mtc-product-overview">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-8">
            <h2 class="mtc-overview-title">What is a coke oven haulage machine?</h2>
            <p>A coke oven haulage machine is an electric winch that pulls heavy loads horizontally or up an incline. In coke oven plants it is used to extract coke cakes and to move charging cars and heavy door mechanisms. This model has a 10 HP, 3-phase motor driving a heavy-duty worm reducer gearbox with machine-cut cast steel gears.</p>
            <p>The worm drive cuts the motor speed and multiplies torque for a steady pull of up to 10 tons, and because it cannot run backwards it helps stop the load slipping back. The wire rope winds onto a drum mounted on a fabricated C-channel steel base frame, and a manual or electro-hydraulic thruster brake is available. The same machine is used for rail shunting inside plants and for hauling tubs up inclines in mines. It is not a lifting hoist: for lifting oven doors, see the Door Lifting Power Winch.</p>
            <p class="mtc-overview-related">Need to lift oven doors vertically? <a href="power-winch">See the Door Lifting Power Winch <i class="fas fa-arrow-right"></i></a></p>
          </div>
          <div class="col-lg-4">
            <div class="mtc-buyer-box">
              <h3>Buying information</h3>
              <ul>
              <li><strong>Lead time:</strong> Made to order. Ask us for the current lead time.</li>
              <li><strong>Warranty:</strong> 1 year, as on all our machinery.</li>
              <li><strong>Installation:</strong> Installation supervision and commissioning available.</li>
              <li><strong>Custom builds:</strong> Capacity, motor power and dimensions can be matched to your plant and drawings.</li>
              <li><strong>Brochure:</strong> <a href="brochure/Manual_Tools_Co_Haulage_Machine.pdf" download>Download PDF</a></li>
              </ul>
              <a href="#quote-form" class="mtc-btn-orange"><i class="fas fa-file-signature"></i> Request a Quotation</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section-bg" style="padding: 60px 0;">
      <div class="container">
        <div class="row">

          <div class="col-lg-8">

            <ul class="nav nav-tabs mtc-content-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="desc-tab" data-bs-toggle="tab" data-bs-target="#desc" type="button"
                  role="tab">Technical Description</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="operationalflow-tab" data-bs-toggle="tab" data-bs-target="#operationalflow"
                  type="button" role="tab">Operational Mechanics</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="apps-tab" data-bs-toggle="tab" data-bs-target="#apps" type="button"
                  role="tab">Applications</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="maint-tab" data-bs-toggle="tab" data-bs-target="#maint" type="button"
                  role="tab">Maintenance</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button"
                  role="tab">FAQ</button>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="desc" role="tabpanel">

                <div class="mtc-tech-wrapper">

                  <h3 class="mtc-tech-heading">Reliable Traction for Heavy Loads</h3>
                  <p class="mtc-tech-paragraph">
                    The Manual Tools Company Haulage Machine is built on a rigid fabricated steel chassis designed to resist the twisting forces encountered during heavy pulling operations. At its core is a precision-engineered <strong>Worm Reducer Gearbox</strong>, which converts high-speed motor rotation into high-torque pulling power.
                  </p>
                  <p class="mtc-tech-paragraph">
                    Specifically optimized for Coke Oven Plants, this machine allows for the smooth, controlled extraction of coke cakes or the movement of charging cars. The use of cast steel gears ensures longevity even under shock-load conditions.
                  </p>

                  <h3 class="mtc-tech-heading" style="font-size: 20px; margin-top: 40px;">Technical Parameters</h3>

                  <div class="mtc-tech-table-container">
                    <table class="mtc-modern-tech-table">
                      <thead>
                        <tr>
                          <th width="40%">Parameter</th>
                          <th>Specification Value</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><strong>Motor Power</strong></td>
                          <td>10 H.P. (3-Phase, 440V)</td>
                        </tr>
                        <tr>
                          <td><strong>Pulling Capacity</strong></td>
                          <td>10 Tons (Horizontal Load)</td>
                        </tr>
                        <tr>
                          <td><strong>Gearbox Technology</strong></td>
                          <td>Heavy Duty Worm Reducer</td>
                        </tr>
                        <tr>
                          <td><strong>Gear Material</strong></td>
                          <td>Cast Steel (Machine Cut)</td>
                        </tr>
                        <tr>
                          <td><strong>Base Frame</strong></td>
                          <td>Fabricated C-Channel Steel</td>
                        </tr>
                        <tr>
                          <td><strong>Braking System</strong></td>
                          <td>Manual / Electro-Hydraulic Thruster (Optional)</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
              <div class="tab-pane fade" id="operationalflow" role="tabpanel">

                <div class="mtc-timeline-wrapper">
                  <div class="row">

                    <div class="col-lg-6">
                      <div class="ps-lg-4">
                        <h3 style="font-weight: 800; font-size: 26px; margin-bottom: 40px; color: #333;">
                          <span style="color: var(--primary-color);">Torque</span> Transmission Flow
                        </h3>

                        <div class="mtc-process-timeline">

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Stage 01</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-bolt"></i> Electrical Input</h4>
                              <p class="mtc-timeline-desc">
                                The 10 HP motor initiates high-speed rotation. A flexible coupling transmits this energy to the gearbox input shaft, absorbing initial start-up shock.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Stage 02</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-compress-arrows-alt"></i> Speed Reduction</h4>
                              <p class="mtc-timeline-desc">
                                The <strong>Worm Reducer</strong> dramatically lowers the RPM while multiplying torque. This non-reversible gear action acts as a natural braking aid, preventing load back-slip.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Stage 03</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-anchor"></i> Drum Traction</h4>
                              <p class="mtc-timeline-desc">
                                The output shaft rotates the main rope drum. The steel wire rope coils onto the drum, exerting a steady 10-ton pull on the connected load, such as a coke cake or charging car.
                              </p>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>

              </div>
              <div class="tab-pane fade" id="apps" role="tabpanel">

                <div class="row mtc-app-grid-container g-4">

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-industry"></i>
                      </div>
                      <h4 class="mtc-app-title">Coke Ovens</h4>
                      <p class="mtc-app-description">Used primarily for extracting heavy coke cakes and operating heavy door mechanisms efficiently.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-train"></i>
                      </div>
                      <h4 class="mtc-app-title">Rail Shunting</h4>
                      <p class="mtc-app-description">Ideal for moving wagons or material trolleys within plant premises where locomotives cannot reach.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-hard-hat"></i>
                      </div>
                      <h4 class="mtc-app-title">Underground Mines</h4>
                      <p class="mtc-app-description">Employed to pull tubs of coal or minerals up inclined planes (gradients) reliably.</p>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane fade" id="maint" role="tabpanel">

                <div class="mtc-maintenance-alert">
                  <i class="fas fa-exclamation-triangle"></i>
                  <div>
                    <strong>Safety First:</strong> Inspect the wire rope daily for fraying. A snapped rope under tension is extremely dangerous.
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Lubrication Schedule</h5>
                    <ul class="mtc-maintenance-list">
                      <li><strong>Gearbox Oil:</strong> Check level weekly. Change the gear oil (SAE 140 or Servo Mesh SP 320, depending on ambient temperature) every 1000 running hours.</li>
                      <li><strong>Bearings:</strong> Re-grease monthly.</li>
                      <li><strong>Wire Rope:</strong> Apply oil to prevent rust and internal friction.</li>
                    </ul>
                  </div>

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Mechanical Inspection</h5>
                    <ul class="mtc-maintenance-list">
                      <li>Check foundation bolts for vibration looseness weekly.</li>
                      <li>Inspect the coupling rubber bushes between motor and gearbox.</li>
                      <li>Check worm gear teeth for excessive pitting or wear annually.</li>
                    </ul>
                  </div>

                </div>

              </div>
              <div class="tab-pane fade" id="faq" role="tabpanel">

                <div class="row">
                  <div class="col-lg-10 mx-auto">

                    <div class="mtc-faq-container">

                      <?php
                      $product_faqs = [
                        ["q" => "What is the maximum pulling capacity?", "a" => "This model is rated for 10 Tons of horizontal pulling force."],
                        ["q" => "Can it be used for lifting?", "a" => "No. This is a Haulage machine designed for horizontal pulling or inclined dragging. It is not a vertical lifting hoist."],
                        ["q" => "What kind of oil does the gearbox need?", "a" => "The Worm Reducer typically requires heavy-duty gear oil like Servo Mesh SP 320 or SAE 140, depending on ambient temperature."],
                        ["q" => "Does it come with wire rope?", "a" => "The machine is supplied with the drum. Wire rope length and diameter are usually customized based on client requirements."],
                        ["q" => "Is the motor included?", "a" => "Yes, the standard unit comes with a 10 HP Electrical Motor pre-mounted and aligned."]
                      ];

                      foreach ($product_faqs as $index => $faq) {
                        $isOpen = ($index === 0);
                        $btnClass = $isOpen ? "" : "collapsed";
                        $ariaExpanded = $isOpen ? "true" : "false";
                        $showClass = $isOpen ? "show" : "";
                        $collapseId = "localFaq" . $index;
                        ?>

                        <div class="mtc-faq-item">
                          <button class="mtc-faq-button <?php echo $btnClass; ?>" type="button" data-bs-toggle="collapse"
                            data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $ariaExpanded; ?>">
                            <?php echo htmlspecialchars($faq['q']); ?>
                            <span class="mtc-faq-icon">
                              <i class="fas fa-chevron-down"></i>
                            </span>
                          </button>
                          <div id="<?php echo $collapseId; ?>" class="collapse <?php echo $showClass; ?>"
                            data-bs-parent="#faq">
                            <div class="mtc-faq-body">
                              <?php echo htmlspecialchars($faq['a']); ?>
                            </div>
                          </div>
                        </div>
                      <?php } ?>

                    </div>

                  </div>
                </div>

              </div>
            </div>

          </div>

          <div class="col-lg-4 mt-5 mt-lg-0" id="quote-form">
            <?php
              $_GET['page_url'] = 'haulage';
              $_GET['page_title'] = 'Coke Oven Haulage Machine (10 Ton)';
              include('sidebar-quote-form.php');
            ?>
        </div>
      </div>
    </section>
    <?php
    // 1. Set the current product's link/slug to exclude it
    $current_page_slug = "haulage";

    // 2. Include the reusable component
    include('related-products.php');
    ?>

  </main>

  <?php include("footer.php"); ?>

  <!-- Modified Logic for Image/Video Swap -->
  <script>
    function swapMedia(el) {
      // 1. Get Data Attributes
      var type = el.getAttribute('data-type');
      var src = el.getAttribute('data-src');
      var displayArea = document.getElementById('mtc-main-display');

      // 2. Update Active Class
      document.querySelectorAll('.mtc-product-thumb-item').forEach(item => item.classList.remove('active'));
      el.classList.add('active');

      // 3. Render Content based on Type
      if (type === 'video') {
          // Render Video Player
          displayArea.innerHTML = `
            <div class="ratio ratio-16x9">
                <video controls autoplay class="img-fluid" style="border-radius: 8px;">
                    <source src="${src}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>`;
      } else {
          // Render Image
          displayArea.innerHTML = `<img src="${src}" alt="Coke oven haulage machine, 10 HP / 10 ton" class="img-fluid" style="height: 450px; width: 100%; object-fit: contain;">`;
      }
    }
  </script>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>