<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Industrial Vibrator Screen Machine for Coke & Coal. Multi-deck options (1-4 decks), 7.5–15 HP motor, High-efficiency grading. Manual Tools Company, India.">
  <meta name="keywords"
    content="Vibrator Screen Machine, Coke Screening, Vibrating Screen, Multi-Deck Screen, Coal Sorter, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/vibrator-screen">

  <title>Vibrator Screen Machine | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/vibrator-screen">
  <meta property="og:title" content="Vibrator Screen Machine | Manual Tools Company">
  <meta property="og:description" content="Heavy-duty Vibrator Screen Machine for grading coke and coal. Available in 1 to 4 deck configurations.">
  <meta property="og:image"
    content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Vibrator-Screen-Machine.png">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Vibrator Screen Machine",
    "image": "https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Vibrator-Screen-Machine.png",
    "description": "Multi-deck vibrating screen machine for precise size separation of coke, coal, and minerals.",
    "sku": "MTC-VS-MD",
    "brand": { "@type": "Organization", "name": "Manual Tools Company" },
    "additionalProperty": [
      { "@type": "PropertyValue", "name": "Motor Power", "value": "7.5 – 15 H.P." },
      { "@type": "PropertyValue", "name": "Decks", "value": "1 to 4 Decks" },
      { "@type": "PropertyValue", "name": "Screen Size", "value": "4'x12' to 5'x16'" },
      { "@type": "PropertyValue", "name": "Application", "value": "Grading & Sorting" }
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
          <h2>Vibrator Screen Machine</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Vibrator Screen</li>
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
            $specificMainImage = "assets/img/about-us-products/Vibrator Screen Machine.jpg";

            // Fetch gallery images from folder
            $directory = "assets/img/product-images/vibrator-screen/";
            $folderImages = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

            // Merge images
            $allImages = $folderImages ? array_merge([$specificMainImage], $folderImages) : [$specificMainImage];
            $currentMainSrc = $allImages[0];
            ?>

            <div class="mtc-product-main-frame text-center">
              <img id="mainImage" src="<?php echo htmlspecialchars($currentMainSrc); ?>" alt="Vibrator Screen Machine"
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
            <div class="mtc-product-eyebrow">Industrial Grading & Sorting</div>
            <h1 class="mtc-product-title">Vibrator Screen <br><span class="mtc-highlight">Multi-Deck Series</span></h1>

            <div class="mtc-product-review-row">
              <div class="mtc-product-stars">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
              </div>
              <span>Model: MTC-VS-MD</span>
              <span class="mtc-product-stock-badge">Custom Config</span>
            </div>

            <p style="line-height: 1.6; color: #555;">
              Achieve precise material separation with our heavy-duty Vibrator Screen. Designed for the Coke and Coal industries, this machine features an eccentric shaft mechanism for aggressive vibration and high screening efficiency. Available in <strong>1 to 4 deck configurations</strong> to suit your specific sizing requirements.
            </p>

            <div class="mtc-product-specs-grid">
              <div class="mtc-product-spec-item">
                <i class="fas fa-layer-group mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Configuration</span>
                  <strong>1 - 4 Decks</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-bolt mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Motor Power</span>
                  <strong>7.5 - 15 HP</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-ruler-combined mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Screen Size</span>
                  <strong>Up to 5' x 16'</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-filter mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Mesh Type</span>
                  <strong>High Carbon Steel</strong>
                </div>
              </div>
            </div>

            <div class="mtc-product-action-row">
              <a href="brochure/Manual_Tools_Co_Vibrator_Screen.pdf" class="mtc-btn-dark" download>
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
              <span><i class="fas fa-random"></i> High Efficiency</span>
              <span><i class="fas fa-cogs"></i> Low Maintenance</span>
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
                  type="button" role="tab">Sorting Process</button>
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

                  <h3 class="mtc-tech-heading">High-Capacity Industrial Screening</h3>
                  <p class="mtc-tech-paragraph">
                    The Manual Tools Company **Vibrator Screen Machine** is engineered to separate bulk materials into specific grades. By utilizing an eccentric shaft or unbalanced motor system, the machine generates a uniform circular motion that effectively stratifies the material bed.
                  </p>
                  <p class="mtc-tech-paragraph">
                    Built on a heavy-duty fabricated steel chassis with spring suspension, it minimizes vibration transfer to the foundation while maximizing screening energy. The mesh decks are interchangeable, allowing operators to easily switch between sorting sizes (e.g., separating Coke Breeze from Lumps).
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
                          <td><strong>Screen Dimensions</strong></td>
                          <td>4'x12' | 4'x16' | 5'x16' (Standard Sizes)</td>
                        </tr>
                        <tr>
                          <td><strong>Number of Decks</strong></td>
                          <td>1, 2, 3, or 4 Decks (Customizable)</td>
                        </tr>
                        <tr>
                          <td><strong>Motor Power</strong></td>
                          <td>7.5 HP – 15 HP (Based on Load)</td>
                        </tr>
                        <tr>
                          <td><strong>Vibration Mechanism</strong></td>
                          <td>Eccentric Shaft</td>
                        </tr>
                        <tr>
                          <td><strong>Mounting</strong></td>
                          <td>Heavy Coil Spring Suspension</td>
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
                          <span style="color: var(--primary-color);">3-Stage</span> Grading Cycle
                        </h3>

                        <div class="mtc-process-timeline">

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 01</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-dolly-flatbed"></i> Material Feed</h4>
                              <p class="mtc-timeline-desc">
                                Mixed material is fed onto the top deck. The vibration immediately spreads the material across the full width of the screen cloth.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 02</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-wave-square"></i> Stratification</h4>
                              <p class="mtc-timeline-desc">
                                Fine particles vibrate down through the mesh openings to the lower decks, while larger lumps (Oversize) ride over the top to the discharge chute.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 03</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-columns"></i> Multi-Output</h4>
                              <p class="mtc-timeline-desc">
                                Each deck discharges its specific size grade (e.g., +40mm, 20-40mm, -20mm) into separate hoppers or conveyors for final storage.
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
                      <h4 class="mtc-app-title">Coke Oven Plants</h4>
                      <p class="mtc-app-description">Essential for separating "Coke Breeze" (dust) from usable Blast Furnace Coke lumps.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-gem"></i>
                      </div>
                      <h4 class="mtc-app-title">Coal Washeries</h4>
                      <p class="mtc-app-description">Used for sizing raw coal before washing and dewatering clean coal after processing.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-cubes"></i>
                      </div>
                      <h4 class="mtc-app-title">Stone Crushing</h4>
                      <p class="mtc-app-description">Highly effective for grading aggregates, gravel, and sand in construction material plants.</p>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane fade" id="maint" role="tabpanel">

                <div class="mtc-maintenance-alert">
                  <i class="fas fa-exclamation-triangle"></i>
                  <div>
                    <strong>Efficiency Tip:</strong> Regularly check the tension of the screen mesh. Loose mesh reduces efficiency and wears out faster.
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Daily / Weekly Checks</h5>
                    <ul class="mtc-maintenance-list">
                      <li>Inspect suspension springs for cracks or fatigue.</li>
                      <li>Check V-Belt tension on the drive motor.</li>
                      <li>Ensure screen cloth clamping bolts are tight.</li>
                      <li>Monitor bearing temperature (should be warm, not hot).</li>
                    </ul>
                  </div>

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Periodic Replacement</h5>
                    <ul class="mtc-maintenance-list">
                      <li><strong>Screen Mesh:</strong> High wear item. Replace immediately if holes appear.</li>
                      <li><strong>Bearings:</strong> Heavy duty spherical roller bearings need greasing every 100 hours.</li>
                      <li><strong>Rubber Buffers:</strong> Replace if they become brittle or cracked.</li>
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
                        ["q" => "What materials can this machine handle?", "a" => "It is primarily designed for Coke, Coal, and Iron Ore, but is also suitable for stone aggregates and other minerals."],
                        ["q" => "Can I change the output size?", "a" => "Yes. The wire mesh screens are interchangeable. You can replace them with different mesh sizes (apertures) to change the output grading."],
                        ["q" => "How many sizes can I get at once?", "a" => "That depends on the number of decks. A 3-deck machine will give you 4 different output sizes (Oversize + 3 grades)."],
                        ["q" => "What motor does it use?", "a" => "Typically, a 1440 RPM, 3-phase induction motor ranging from 7.5 HP to 15 HP, depending on the machine size."],
                        ["q" => "Is the vibration adjustable?", "a" => "Yes, the amplitude can be adjusted by changing the counterweights on the flywheels/eccentric shaft."]
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
              $_GET['page_url'] = 'vibrator-screen';
              $_GET['page_title'] = 'Vibrator Screen Machine';
              include('sidebar-quote-form.php'); 
            ?>
        </div>
      </div>
    </section>
    <?php
    // 1. Set the current product's link/slug to exclude it
    $current_page_slug = "vibrator-screen";

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