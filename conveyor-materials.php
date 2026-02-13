<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Heavy Duty Conveyor Components: Idlers, Impact Rollers, Head & Tail Pulleys. Available for belt widths 600mm–1400mm. Manual Tools Company, India.">
  <meta name="keywords"
    content="Conveyor Idlers, Return Rollers, Impact Rollers, Head Pulley, Tail Pulley, Conveyor Belt Parts, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="https://www.manualtoolsco.com/conveyor-materials">

  <title>Conveyor Materials & Components | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/conveyor-materials">
  <meta property="og:title" content="Conveyor Materials & Components | Manual Tools Company">
  <meta property="og:description" content="Industrial conveyor rollers, idlers, and pulleys for coke and coal handling systems.">
  <meta property="og:image"
    content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Conveyor-Material.png">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Conveyor Components Series",
    "image": "https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Conveyor-Material.png",
    "description": "Comprehensive range of conveyor components including Idlers, Return Rollers, Impact Rollers, and Pulleys for belt widths up to 1400mm.",
    "brand": { "@type": "Organization", "name": "Manual Tools Company" },
    "additionalProperty": [
      { "@type": "PropertyValue", "name": "Belt Widths", "value": "600mm – 1400mm" },
      { "@type": "PropertyValue", "name": "Roller Type", "value": "MS Seamless / Impact Rubber" },
      { "@type": "PropertyValue", "name": "Pulley Type", "value": "Rubber Lagged / Plain" },
      { "@type": "PropertyValue", "name": "Bearing", "value": "Sealed 2RS / ZZ" }
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

  <!-- Custom CSS for Component Grid -->
  <style>
    .mtc-component-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 25px;
      margin-top: 20px;
    }

    .mtc-component-card {
      background: #fff;
      border: 1px solid #e9ecef;
      border-radius: 8px;
      padding: 25px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .mtc-component-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
      border-color: var(--primary-color);
    }

    .mtc-card-icon {
      font-size: 32px;
      color: var(--primary-color);
      margin-bottom: 15px;
    }

    .mtc-card-title {
      font-size: 18px;
      font-weight: 700;
      color: #333;
      margin-bottom: 10px;
      text-transform: uppercase;
    }

    .mtc-card-list {
      list-style: none;
      padding: 0;
      margin: 0;
      font-size: 14px;
      color: #666;
    }

    .mtc-card-list li {
      margin-bottom: 6px;
      padding-left: 15px;
      position: relative;
    }

    .mtc-card-list li::before {
      content: "•";
      color: var(--primary-color);
      position: absolute;
      left: 0;
      font-weight: bold;
    }
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
          <h2>Conveyor Materials</h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li>Conveyor Materials</li>
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
            $specificMainImage = "assets/img/about-us-products/Conveyor Material.jpeg";

            // Fetch gallery images from folder
            $directory = "assets/img/product-images/conveyor-materials/";
            $folderImages = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

            // Merge images
            $allImages = $folderImages ? array_merge([$specificMainImage], $folderImages) : [$specificMainImage];
            $currentMainSrc = $allImages[0];
            ?>

            <div class="mtc-product-main-frame text-center">
              <img id="mainImage" src="<?php echo htmlspecialchars($currentMainSrc); ?>" alt="Conveyor Materials"
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
            <div class="mtc-product-eyebrow">Industrial Handling Systems</div>
            <h1 class="mtc-product-title">Conveyor Materials <br><span class="mtc-highlight">& Components</span></h1>

            <div class="mtc-product-review-row">
              <div class="mtc-product-stars">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <span>Category: MTC-CM-SERIES</span>
              <span class="mtc-product-stock-badge">In Stock / Made to Order</span>
            </div>

            <p style="line-height: 1.6; color: #555;">
              Ensure continuous plant operation with our premium range of conveyor components. From heavy-duty **Head & Tail Pulleys** to frictionless **Idlers and Rollers**, our materials are engineered for the abrasive and dusty environments of Coke Ovens, Washeries, and Power Plants.
            </p>

            <div class="mtc-product-specs-grid">
              <div class="mtc-product-spec-item">
                <i class="fas fa-ruler-horizontal mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Belt Widths</span>
                  <strong>600 - 1400 mm</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-circle-notch mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Bearings</span>
                  <strong>Sealed</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-layer-group mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Material</span>
                  <strong>Seamless Pipe</strong>
                </div>
              </div>
              <div class="mtc-product-spec-item">
                <i class="fas fa-industry mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Application</span>
                  <strong>Heavy Duty</strong>
                </div>
              </div>
            </div>

            <div class="mtc-product-action-row">
              <a href="#quote-form" class="mtc-btn-orange">
                <i class="fas fa-file-signature"></i> Request Quote
              </a>
              <a href="tel:+919430707348" class="mtc-btn-call-us">
                <i class="fas fa-phone"></i> Call Us
              </a>
            </div>

            <div class="mtc-product-trust-badges">
              <span><i class="fas fa-check-circle"></i> ISO 9001:2015</span>
              <span><i class="fas fa-shield-alt"></i> Dust Proof Seals</span>
              <span><i class="fas fa-truck"></i> Bulk Supply</span>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="section-bg" style="padding: 60px 0;">
      <div class="container">
        <div class="row">

          <div class="col-lg-8">

            <!-- Reduced Tabs for Component Efficiency -->
            <ul class="nav nav-tabs mtc-content-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="components-tab" data-bs-toggle="tab" data-bs-target="#components" type="button"
                  role="tab">Component Breakdown</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="specs-tab" data-bs-toggle="tab" data-bs-target="#specs" type="button"
                  role="tab">General Specifications</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button"
                  role="tab">FAQ</button>
              </li>
            </ul>

            <div class="tab-content" id="myTabContent">
              
              <!-- Tab 1: Component Cards -->
              <div class="tab-pane fade show active" id="components" role="tabpanel">
                <div class="mtc-tech-wrapper">
                  <h3 class="mtc-tech-heading">Comprehensive Conveyor Solutions</h3>
                  <p class="mtc-tech-paragraph">We manufacture key components that ensure the smooth running of your belt conveyor systems. Select a component below to see details.</p>
                  
                  <div class="mtc-component-grid">
                    
                    <!-- Card 1: Idlers -->
                    <div class="mtc-component-card">
                      <div class="mtc-card-icon"><i class="fas fa-ellipsis-h"></i></div>
                      <h4 class="mtc-card-title">Carrying Idlers</h4>
                      <ul class="mtc-card-list">
                        <li>Troughing Sets - 30°</li>
                        <li>Heavy Gauge Seamless Steel Pipe</li>
                        <li>Sealed for Dust Protection</li>
                      </ul>
                    </div>

                    <!-- Card 2: Return Rollers -->
                    <div class="mtc-component-card">
                      <div class="mtc-card-icon"><i class="fas fa-minus"></i></div>
                      <h4 class="mtc-card-title">Return Rollers</h4>
                      <ul class="mtc-card-list">
                        <li>Single Flat Roller configuration</li>
                        <li>Brackets supplied</li>
                        <li>Smooth surface to prevent belt wear</li>
                      </ul>
                    </div>

                    <!-- Card 3: Impact Rollers -->
                    <div class="mtc-component-card">
                      <div class="mtc-card-icon"><i class="fas fa-compress-arrows-alt"></i></div>
                      <h4 class="mtc-card-title">Impact Rollers</h4>
                      <ul class="mtc-card-list">
                        <li>Shock-absorbing Rubber Rings</li>
                        <li>Installed at loading points</li>
                        <li>Prevents belt damage from falling material</li>
                      </ul>
                    </div>

                    <!-- Card 4: Pulleys -->
                    <div class="mtc-component-card">
                      <div class="mtc-card-icon"><i class="fas fa-bullseye"></i></div>
                      <h4 class="mtc-card-title">Head & Tail Pulleys</h4>
                      <ul class="mtc-card-list">
                        <li>Head Pulley (Drive) & Tail Pulley (Tension)</li>
                        <li>Diamond Groove Rubber Lagging available</li>
                        <li>Key-based locking assemblies</li>
                        <li>Coupling Pair for head Pulley available</li>
                      </ul>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Tab 2: Specs Table -->
              <div class="tab-pane fade" id="specs" role="tabpanel">
                <div class="mtc-tech-wrapper">
                  <h3 class="mtc-tech-heading">Material Specifications</h3>
                  <div class="mtc-tech-table-container">
                    <table class="mtc-modern-tech-table">
                      <thead>
                        <tr>
                          <th width="40%">Property</th>
                          <th>Standard Specification</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><strong>Belt Width Compatibility</strong></td>
                          <td>600, 750, 800, 1000, 1200, 1400 mm</td>
                        </tr>
                        <tr>
                          <td><strong>Shaft Material</strong></td>
                          <td>Bright Steel Bar (EN-8)</td>
                        </tr>
                        <tr>
                          <td><strong>Bearings</strong></td>
                          <td>Ball Bearings (6204, 6205, 6305)</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              <!-- Tab 3: FAQ -->
              <div class="tab-pane fade" id="faq" role="tabpanel">
                <div class="row">
                  <div class="col-lg-10 mx-auto">
                    <div class="mtc-faq-container">

                      <?php
                      $product_faqs = [
                        ["q" => "What belt sizes do you support?", "a" => "We manufacture components for all standard belt widths: 600mm, 750mm, 800mm, 900mm, 1000mm, 1200mm, and 1400mm."],
                        ["q" => "Are the impact rollers rubberized?", "a" => "Yes, our Impact Rollers feature robust rubber rings specifically designed to absorb the shock of falling material at hopper loading points."],
                        ["q" => "Do pulleys come with lagging?", "a" => "We offer both plain steel face pulleys and rubber-lagged pulleys (Diamond groove or plain) for better traction in wet conditions."],
                        ["q" => "Can you supply brackets?", "a" => "Yes, we can supply the Idler Frames (brackets) along with the rollers or separately as spares."],
                        ["q" => "What is the delivery time?", "a" => "Standard sizes (e.g., 800mm/1000mm rollers) are often in stock. Custom pulleys typically take 2-3 weeks."]
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
              $_GET['page_url'] = 'conveyor-materials';
              $_GET['page_title'] = 'Conveyor Materials';
              include('sidebar-quote-form.php'); 
            ?>
        </div>
      </div>
    </section>
    <?php
    // 1. Set the current product's link/slug to exclude it
    $current_page_slug = "conveyor-materials";

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