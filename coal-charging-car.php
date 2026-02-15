<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Coal Charging Car for Coke Oven Batteries. Rail-mounted, 4-20 Ton capacity, 4-Hopper design with automated gravity charging. Manufactured by Manual Tools Company, India.">
  <meta name="keywords"
    content="Coal Charging Car, Coke Oven Charging, Top Charging Machine, Larry Car, Furnace Charging, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/coal-charging-car">

  <title>Coal Charging Car | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/coal-charging-car">
  <meta property="og:title" content="Coal Charging Car | Manual Tools Company">
  <meta property="og:description" content="Heavy-duty Coal Charging Car for coke ovens. 4-20 Ton capacity, rail-mounted travel system.">
  <meta property="og:image"
    content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Coal-Charging-Car.jpg">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Coal Charging Car",
    "image": "https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Coal-Charging-Car.jpg",
    "description": "Rail-mounted Coal Charging Car for top-charging coke ovens. Features 4 hoppers, gravity feed system, and heavy-duty travel mechanism.",
    "sku": "MTC-CCC-Series",
    "brand": { "@type": "Organization", "name": "Manual Tools Company" },
    "additionalProperty": [
      { "@type": "PropertyValue", "name": "Capacity", "value": "4T / 8T / 15T / 20T" },
      { "@type": "PropertyValue", "name": "Travel Motor", "value": "15 HP" },
      { "@type": "PropertyValue", "name": "Charging Mouths", "value": "4 Nos" },
      { "@type": "PropertyValue", "name": "Mechanism", "value": "Gravity Feed" }
    ]
  }
  </script>

  <?php include('common-head.php'); ?>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/product-detail.css" rel="stylesheet">
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
          <h2>Coal Charging Car</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Coal Charging Car</li>
          </ol>
        </div>
      </div>
    </section>

    <section class="mtc-product-hero">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 mb-4 mb-lg-0">
            <?php
            // Define specific main image
            $specificMainImage = "assets/img/about-us-products/Coal-Charging-Car.jpg";

            // Fetch gallery images from folder
            $directory = "assets/img/product-images/coal-charging-car/";
            $folderImages = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

            // Merge images
            $allImages = $folderImages ? array_merge([$specificMainImage], $folderImages) : [$specificMainImage];
            $currentMainSrc = $allImages[0];
            ?>

            <div class="mtc-product-main-frame text-center">
              <img id="mainImage" src="<?php echo htmlspecialchars($currentMainSrc); ?>" alt="Coal Charging Car"
                class="img-fluid">
            </div>

            <div class="mtc-product-thumb-grid">
              <?php foreach ($allImages as $index => $image): ?>
                <div class="mtc-product-thumb-item <?php echo $index === 0 ? 'active' : ''; ?>" onclick="swapImage(this)">
                  <img src="<?php echo htmlspecialchars($image); ?>"
                    alt="<?php echo htmlspecialchars(pathinfo($image, PATHINFO_FILENAME)); ?>">
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="col-lg-6 ps-lg-5">
            <div class="mtc-product-eyebrow">Coke Oven Machinery Series</div>
            <h1 class="mtc-product-title">Coal <br><span class="mtc-highlight">Charging Car</span> (Top Feed)</h1>

            <div class="mtc-product-review-row">
              <div class="mtc-product-stars">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <span>Model: MTC-CCC-Series</span>
              <span class="mtc-product-stock-badge">Made to Order</span>
            </div>

            <p style="line-height: 1.6; color: #555;">
              Optimized for efficient "Top Charging" of coke ovens, this machine runs on battery-top rails to deliver precise coal quantities into the oven chambers. Equipped with <strong>4 Conical Hoppers</strong> and a heavy-duty travel mechanism, it ensures uniform coal distribution.
            </p>

            <div class="mtc-product-specs-grid">
              <div class="mtc-product-spec-item">
                <i class="fas fa-weight-hanging mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Hopper Capacity</span>
                  <strong>4 - 20 Tons</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-truck-moving mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Travel Motor</span>
                  <strong>15 HP (Elec.)</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-arrow-down mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Charging Mouths</span>
                  <strong>4 Nos.</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-cogs mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Operation</span>
                  <strong>Gravity Feed</strong>
                </div>
              </div>
            </div>

            <div class="mtc-product-action-row">
              <a href="brochure/Manual_Tools_Co_Charging_Car.pdf" class="mtc-btn-dark" download>
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
              <span><i class="fas fa-shield-alt"></i> Heavy Structure</span>
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
                  type="button" role="tab">Operational Process</button>
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

                  <h3 class="mtc-tech-heading">Precision Coal Feed System</h3>
                  <p class="mtc-tech-paragraph">
                    The Manual Tools Company **Coal Charging Car** (Larry Car) is a rail-mounted vehicle designed to travel along the top of the coke oven battery. Its primary function is to receive pulverized coal from the overhead service bunker and discharge it into the hot ovens via charging holes.
                  </p>
                  <p class="mtc-tech-paragraph">
                    Constructed with 8mm thick tapered steel plates, the hoppers ensure smooth coal flow without bridging. The travel mechanism is powered by a 15 HP motor coupled with a Worm Reducer Gearbox, providing high torque for controlled movement and precise positioning over the oven mouths.
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
                          <td><strong>Hopper Capacity</strong></td>
                          <td>4 Tons / 8 Tons / 15 Tons / 20 Tons (Customizable)</td>
                        </tr>
                        <tr>
                          <td><strong>Long Travel Motor</strong></td>
                          <td>15 HP (Electric)</td>
                        </tr>
                        <tr>
                          <td><strong>Gate Operation Motor</strong></td>
                          <td>3 HP (For Hopper Discharge)</td>
                        </tr>
                        <tr>
                          <td><strong>Number of Hoppers</strong></td>
                          <td>4 Conical Hoppers</td>
                        </tr>
                        <tr>
                          <td><strong>Travel Speed</strong></td>
                          <td>60 - 80 meters/minute</td>
                        </tr>
                        <tr>
                          <td><strong>Gearbox Type</strong></td>
                          <td>Heavy Duty Worm Reducer</td>
                        </tr>
                        <tr>
                          <td><strong>Body Plate Thickness</strong></td>
                          <td>8mm (Tapered / Vertical)</td>
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
                          <span style="color: var(--primary-color);">3-Stage</span> Charging Cycle
                        </h3>

                        <div class="mtc-process-timeline">

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 01</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-arrow-down"></i> Bunker Filling</h4>
                              <p class="mtc-timeline-desc">
                                The car positions itself under the overhead coal tower. The 4 hoppers are filled with a precise weight of coal blend.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 02</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-crosshairs"></i> Alignment</h4>
                              <p class="mtc-timeline-desc">
                                Driven by the 15 HP motor, the car travels to the empty oven. The telescopic sleeves align perfectly with the oven's charging holes to prevent smoke leakage.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 03</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-box-open"></i> Gravity Discharge</h4>
                              <p class="mtc-timeline-desc">
                                The bottom slide gates open (via 3 HP motor or manual gear). Coal flows by gravity into the oven. Mechanical vibrators may engage to clear sticky coal.
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
                        <i class="fas fa-fire"></i>
                      </div>
                      <h4 class="mtc-app-title">Coke Ovens</h4>
                      <p class="mtc-app-description">Standard equipment for top-charged byproduct recovery coke oven batteries.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-industry"></i>
                      </div>
                      <h4 class="mtc-app-title">Steel Plants</h4>
                      <p class="mtc-app-description">Critical for the continuous production of metallurgical coke in integrated steelworks.</p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="maint" role="tabpanel">

                <div class="mtc-maintenance-alert">
                  <i class="fas fa-exclamation-triangle"></i>
                  <div>
                    <strong>Heat Warning:</strong> This machine operates on top of hot ovens. Regularly inspect electrical cables for heat damage.
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Lubrication Schedule</h5>
                    <ul class="mtc-maintenance-list">
                      <li><strong>Travel Wheels:</strong> Grease bearings weekly. High-temp grease recommended.</li>
                      <li><strong>Gearboxes:</strong> Check oil levels monthly. Replace SAE-140 oil every 6 months.</li>
                      <li><strong>Slide Gates:</strong> Lubricate rack and pinion mechanisms weekly to prevent jamming.</li>
                    </ul>
                  </div>

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Mechanical Inspection</h5>
                    <ul class="mtc-maintenance-list">
                      <li>Check wheel flanges for excessive wear due to rail misalignment.</li>
                      <li>Inspect hopper interiors for coal build-up (rat-holing).</li>
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
                        ["q" => "What travel system is used?", "a" => "The car runs on a robust rail-mounted system (Track wheels) powered by a 15 HP slip-ring or squirrel cage motor."],
                        ["q" => "How many charging mouths does it have?", "a" => "Standard configuration is 4 charging mouths to match the 4 charging holes on the oven top."],
                        ["q" => "Is the discharge automated?", "a" => "Yes, the slide gates are motorized (3 HP) for semi-automatic operation, with a manual override wheel in case of power failure."],
                        ["q" => "What safety features are included?", "a" => "Includes hydraulic buffers, heavy-duty electromagnetic brakes, audible travel alarms, and heat shields for the operator cabin."],
                        ["q" => "Can it handle wet coal?", "a" => "Yes, the hoppers have steep tapered angles (conical shape) to facilitate the flow of wet coal."]
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
              $_GET['page_url'] = 'coal-charging-car';
              $_GET['page_title'] = 'Coal Charging Car';
              include('sidebar-quote-form.php'); 
            ?>
        </div>
      </div>
    </section>
    <?php
    // 1. Set the current product's link/slug to exclude it
    $current_page_slug = "coal-charging-car";

    // 2. Include the reusable component
    include('related-products.php');
    ?>

  </main>

  <?php include("footer.php"); ?>

  <script>
    function swapImage(el) {
      // 1. Change Main Image
      var newSrc = el.querySelector('img').src;
      document.getElementById('mainImage').src = newSrc;

      // 2. Update Active Class
      document.querySelectorAll('.mtc-product-thumb-item').forEach(item => item.classList.remove('active'));
      el.classList.add('active');
    }
  </script>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>