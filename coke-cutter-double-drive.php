<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Coke Cutter Machine (Double Drive) for precision coke sizing. 20 HP x 2 motors, feed <200 mm, output 45–60 mm, 12–15 TPH capacity. Manual Tools Company, India.">
  <meta name="keywords"
    content="Coke Cutter Machine, Double Drive Coke Cutter, Coke Sizing Machine, Industrial Coke Cutter, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/coke-cutter-double-drive">

  <title>Coke Cutter Machine (Double Drive) | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/coke-cutter-double-drive">
  <meta property="og:title" content="Coke Cutter Machine (Double Drive) | Manual Tools Company">
  <meta property="og:description" content="Industrial Coke Cutter with 12–15 TPH capacity, adjustable output size (45-60 mm), and double drive motors.">
  <meta property="og:image"
    content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Double-Drive-Coke-Cutter-Machine.jpg">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Coke Cutter Machine (Double Drive)",
    "image": "https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Double-Drive-Coke-Cutter-Machine.jpg",
    "description": "Double drive coke cutter machine with 12-15 TPH capacity, 45-60mm adjustable output, and manganese steel teeth.",
    "sku": "MTC-CCM-DD",
    "brand": { "@type": "Organization", "name": "Manual Tools Company" },
    "additionalProperty": [
      { "@type": "PropertyValue", "name": "Motor Power", "value": "20 H.P. x 2 (Double Drive)" },
      { "@type": "PropertyValue", "name": "Feed Size", "value": "< 200 mm" },
      { "@type": "PropertyValue", "name": "Finished Size", "value": "45 - 60 mm (Adjustable)" },
      { "@type": "PropertyValue", "name": "Capacity", "value": "12 – 15 TPH" }
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
          <h2>Coke Cutter Machine</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Coke Cutter</li>
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
            $specificMainImage = "assets/img/about-us-products/Double Drive Coke Cutter Machine.jpg";

            // Fetch gallery images from folder
            $directory = "assets/img/product-images/coke-cutter/";
            $folderImages = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

            // Merge images
            $allImages = $folderImages ? array_merge([$specificMainImage], $folderImages) : [$specificMainImage];
            $currentMainSrc = $allImages[0];
            ?>

            <div class="mtc-product-main-frame text-center">
              <img id="mainImage" src="<?php echo htmlspecialchars($currentMainSrc); ?>" alt="Coke Cutter Double Drive"
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
            <div class="mtc-product-eyebrow">Industrial Coke Sizing Equipment</div>
            <h1 class="mtc-product-title">Coke Cutter Machine <br><span class="mtc-highlight">Double Drive</span></h1>

            <div class="mtc-product-review-row">
              <div class="mtc-product-stars">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <span>Model: MTC-CCM-DD</span>
              <span class="mtc-product-stock-badge">Made to Order</span>
            </div>

            <p style="line-height: 1.6; color: #555;">
              Built for high-torque applications, our Double Drive Coke Cutter utilizes <strong>two 20 HP motors</strong> to slice through hard coke lumps without jamming. Featuring adjustable drum spacing, it delivers precise output sizes (45mm–60mm) essential for blast furnaces and foundries.
            </p>

            <div class="mtc-product-specs-grid">
              <div class="mtc-product-spec-item">
                <i class="fas fa-tachometer-alt mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Capacity</span>
                  <strong>12 - 15 TPH</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-bolt mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Motor Power</span>
                  <strong>20 HP x 2 (Dual)</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-ruler-horizontal mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Output Size</span>
                  <strong>45 - 60 mm</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-arrow-down mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Max Feed Size</span>
                  <strong>Up to 200mm</strong>
                </div>
              </div>
            </div>

            <div class="mtc-product-action-row">
              <a href="brochure/Manual_Tools_Co_Coke_Cutter_Double_Drive.pdf" class="mtc-btn-dark" download>
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
              <span><i class="fas fa-cogs"></i> Cast Steel Gears</span>
              <span><i class="fas fa-tools"></i> Manganese Teeth</span>
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
                  type="button" role="tab">Operational Process Flow</button>
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

                  <h3 class="mtc-tech-heading">Precision Cutting with Double Drive Power</h3>
                  <p class="mtc-tech-paragraph">
                    The Manual Tools Company **Coke Cutter (Double Drive)** is engineered to solve the problem of uneven coke sizing. Unlike standard crushers that produce excess fines (dust), this machine uses a cutting action to slice coke lumps to a specific size.
                  </p>
                  <p class="mtc-tech-paragraph">
                    The "Double Drive" system refers to the independent 20 H.P. motors powering each side of the cutter assembly. This ensures balanced torque distribution, preventing the stalling often seen when processing hard metallurgical coke. The machine is fitted with **Cast Steel Gears** and **Manganese Steel Liner Teeth** for maximum longevity.
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
                          <td><strong>Drive System</strong></td>
                          <td>Double Drive (Dual Motor)</td>
                        </tr>
                        <tr>
                          <td><strong>Motor Power</strong></td>
                          <td>20 H.P. + 20 H.P. (Total 40 H.P.)</td>
                        </tr>
                        <tr>
                          <td><strong>Input Feed Size</strong></td>
                          <td>&lt; 200 mm</td>
                        </tr>
                        <tr>
                          <td><strong>Finished Output Size</strong></td>
                          <td>45 mm – 60 mm (Adjustable Drum)</td>
                        </tr>
                        <tr>
                          <td><strong>Processing Capacity</strong></td>
                          <td>12 – 15 Tons Per Hour</td>
                        </tr>
                        <tr>
                          <td><strong>Gear Material</strong></td>
                          <td>Heavy Duty Cast Steel</td>
                        </tr>
                        <tr>
                          <td><strong>Teeth Material</strong></td>
                          <td>Manganese Steel Liner Plates</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
              <div class="tab-pane fade" id="operationalflow" role="tabpanel">

                <div class="mtc-timeline-wrapper">
                  <div class="row">

                    <div class="col-lg-6 mb-5 mb-lg-0">
                      <div class="mtc-flow-image-box">
                        <img src="assets/img/product-images/coke-cutter/process-diagram.jpg"
                          alt="Coke Cutter Process Flow" class="img-fluid w-100">
                        <div class="mtc-flow-image-overlay">
                          <i class="fas fa-info-circle"></i> Cutter Mechanism View
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="ps-lg-4">
                        <h3 style="font-weight: 800; font-size: 26px; margin-bottom: 40px; color: #333;">
                          <span style="color: var(--primary-color);">3-Stage</span> Sizing Cycle
                        </h3>

                        <div class="mtc-process-timeline">

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 01</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-dolly-flatbed"></i> Material Intake</h4>
                              <p class="mtc-timeline-desc">
                                Raw coke lumps up to 200mm are fed via conveyor into the hopper. The wide mouth ensures no bridging or clogging occurs at the entry point.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 02</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-cog"></i> Double Drive Cutting</h4>
                              <p class="mtc-timeline-desc">
                                Twin drums, powered by separate motors, rotate against each other. The manganese teeth "cut" rather than crush the coke, preserving structural integrity.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 03</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-sliders-h"></i> Calibrated Output</h4>
                              <p class="mtc-timeline-desc">
                                The gap between drums is adjustable. Material falls through only when it matches the set size (45-60mm), ensuring a uniform product for furnaces.
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
                      <h4 class="mtc-app-title">Blast Furnaces</h4>
                      <p class="mtc-app-description">Ensures coke is the correct size for optimal air permeability and combustion inside the blast furnace.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-fire-alt"></i>
                      </div>
                      <h4 class="mtc-app-title">Foundries</h4>
                      <p class="mtc-app-description">Provides uniform sizing for Cupola furnaces, reducing waste and improving melt efficiency.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-flask"></i>
                      </div>
                      <h4 class="mtc-app-title">Chemical Plants</h4>
                      <p class="mtc-app-description">Used in processes requiring precise carbon sizing for filtration or reaction beds.</p>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane fade" id="maint" role="tabpanel">

                <div class="mtc-maintenance-alert">
                  <i class="fas fa-exclamation-triangle"></i>
                  <div>
                    <strong>Operational Tip:</strong> Ensure both motors are synchronized during startup to prevent uneven wear on the gear teeth.
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Daily / Weekly Checks</h5>
                    <ul class="mtc-maintenance-list">
                      <li>Inspect V-Belts for proper tension and alignment.</li>
                      <li>Inspect Manganese Teeth for chipping or excessive wear.</li>
                      <li>Verify the gap setting between drums (45-60mm).</li>
                      <li>Tighten foundation bolts due to vibration.</li>
                    </ul>
                  </div>

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Periodic Replacement</h5>
                    <ul class="mtc-maintenance-list">
                      <li><strong>Liner Teeth:</strong> Replace when cutting efficiency drops (edges become rounded).</li>
                      <li><strong>Pinion:</strong> Grease pinions Regularly.</li>
                      <li><strong>Bearings:</strong> Grease main shaft bearings weekly.</li>
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
                        ["q" => "Why use Double Drive instead of Single?", "a" => "Double Drive (two motors) provides balanced torque on both sides of the shaft. This prevents jamming when cutting very hard coke lumps and extends gear life."],
                        ["q" => "Is the output size adjustable?", "a" => "Yes, the machine features an adjustable drum mechanism. You can change the gap setting to produce coke between 45 mm and 60 mm."],
                        ["q" => "Does it produce dust (fines)?", "a" => "Compared to hammer mills, the Coke Cutter produces significantly less dust because it cuts/shears the material rather than smashing it."],
                        ["q" => "What is the gear material?", "a" => "We use high-grade Cast Steel for all gears to withstand high torque and shock loads."],
                        ["q" => "What happens if a piece of iron enters?", "a" => "The machine is robust, but iron can damage teeth. We highly recommend installing a magnetic separator on the feed conveyor."]
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
              $_GET['page_url'] = 'coke-cutter-double-drive';
              $_GET['page_title'] = 'Coke Cutter Machine (Double Drive)';
              include('sidebar-quote-form.php'); 
            ?>
        </div>
      </div>
    </section>
    <?php
    // 1. Set the current product's link/slug to exclude it
    $current_page_slug = "coke-cutter-double-drive";

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