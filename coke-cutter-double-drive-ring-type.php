<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Double Drive Coke Cutter (Ring Type) for heavy-duty coke sizing. Features Manganese Steel Toothed Rings, 20 HP x 2 motors, 12–15 TPH capacity. Manual Tools Company.">
  <meta name="keywords"
    content="Ring Type Coke Cutter, Double Drive Coke Cutter, Toothed Ring Coke Crusher, Coke Sizing Machine, Manual Tools Company, Dhanbad, Jharkhand, India">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Update canonical link to the new page slug -->
  <link rel="canonical" href="https://www.manualtoolsco.com/coke-cutter-double-drive-ring-type">

  <title>Double Drive Coke Cutter (Ring Type) | Manual Tools Company</title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="https://www.manualtoolsco.com/coke-cutter-double-drive-ring-type">
  <meta property="og:title" content="Double Drive Coke Cutter (Ring Type) | Manual Tools Company">
  <meta property="og:description" content="Heavy-duty Ring Type Coke Cutter with double drive motors and segmented manganese rings for precise sizing.">
  <meta property="og:image"
    content="https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Double-Drive-Coke-Cutter-Machine-Ring-Type.jpg">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "Double Drive Coke Cutter (Ring Type)",
    "image": "https://www.manualtoolsco.com/assets/img/about-us-products-thumbnail/Double-Drive-Coke-Cutter-Machine-Ring-Type.jpg",
    "description": "Double drive coke cutter machine featuring segmented manganese steel rings, 12-15 TPH capacity, and adjustable output.",
    "sku": "MTC-CCM-DD-RT",
    "brand": { "@type": "Organization", "name": "Manual Tools Company" },
    "additionalProperty": [
      { "@type": "PropertyValue", "name": "Motor Power", "value": "20 H.P. x 2 (Double Drive)" },
      { "@type": "PropertyValue", "name": "Teeth Type", "value": "Manganese Steel Rings" },
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
            <li>Double Drive (Ring Type)</li>
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
                'src' => 'assets/img/about-us-products/Double Drive Coke Cutter Machine Ring Type.jpg',
                'thumb' => 'assets/img/about-us-products/Double Drive Coke Cutter Machine Ring Type.jpg'
            ];

            // 2. Fetch Gallery Images from Folder
            $directory = "assets/img/product-images/coke-cutter-ring-teeth/";
            
            // Get Images
            $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            $galleryImgs = [];
            if($images) {
                foreach($images as $img) {
                    $galleryImgs[] = ['type' => 'image', 'src' => $img, 'thumb' => $img];
                }
            }

            // Get Videos
            $videos = glob($directory . "*.{mp4,webm}", GLOB_BRACE);
            $galleryVids = [];
            if($videos) {
                foreach($videos as $vid) {
                    // Use main image as placeholder thumb for video if no specific thumb exists
                    $galleryVids[] = ['type' => 'video', 'src' => $vid, 'thumb' => 'assets/img/about-us-products/Double Drive Coke Cutter Machine Ring Type.jpg'];
                }
            }

            // 3. Merge All Media (Main -> Images -> Videos)
            $mediaList = array_merge([$mainImgObj], $galleryImgs, $galleryVids);
            ?>

            <!-- Main Display Area (Image or Video) -->
            <div class="mtc-product-main-frame text-center" id="mtc-main-display">
              <!-- Default loads the first image -->
              <img src="<?php echo htmlspecialchars($mediaList[0]['src']); ?>" alt="Double Drive Coke Cutter Machine Ring Type" class="img-fluid">
            </div>

            <!-- Thumbnails Grid -->
            <div class="mtc-product-thumb-grid">
              <?php foreach ($mediaList as $index => $media): ?>
                <div class="mtc-product-thumb-item <?php echo $index === 0 ? 'active' : ''; ?>" 
                     onclick="swapMedia(this)"
                     data-type="<?php echo $media['type']; ?>"
                     data-src="<?php echo htmlspecialchars($media['src']); ?>">
                  
                  <img src="<?php echo htmlspecialchars($media['thumb']); ?>" alt="Thumbnail">
                  
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
            <div class="mtc-product-eyebrow">Industrial Coke Sizing Equipment</div>
            <h1 class="mtc-product-title">Double Drive Coke Cutter <br><span class="mtc-highlight">Ring Type</span></h1>

            <div class="mtc-product-review-row">
              <div class="mtc-product-stars">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                  class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <span>Model: MTC-CCM-DD-RT</span>
              <span class="mtc-product-stock-badge">Heavy Duty</span>
            </div>

            <p style="line-height: 1.6; color: #555;">
              Designed for ease of maintenance and high durability, this model features <strong>Segmented Manganese Steel Rings</strong> instead of standard liner plates. Powered by <strong>Dual 20 HP Motors</strong>, it allows for easy replacement of individual rings, reducing downtime while delivering precise 45mm–60mm coke output.
            </p>

            <div class="mtc-product-specs-grid">
              <div class="mtc-product-spec-item">
                <i class="fas fa-cogs mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Mechanism</span>
                  <strong>Toothed Rings</strong>
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
                <i class="fas fa-weight-hanging mtc-product-spec-icon"></i>
                <div class="mtc-product-spec-text">
                  <span>Capacity</span>
                  <strong>12 - 15 TPH</strong>
                </div>
              </div>
            </div>

            <div class="mtc-product-action-row">
              <!-- <a href="brochure/Manual_Tools_Co_Coke_Cutter_Ring_Type.pdf" class="mtc-btn-dark" download>
                <i class="fas fa-download"></i> Brochure
              </a> -->
              <a href="#quote-form" class="mtc-btn-orange">
                <i class="fas fa-file-signature"></i> Request Quote
              </a>
              <a href="tel:+919430707348" class="mtc-btn-call-us">
                <i class="fas fa-phone"></i> Call Us
              </a>
            </div>

            <div class="mtc-product-trust-badges">
              <span><i class="fas fa-circle-notch"></i> Segmented Rings</span>
              <span><i class="fas fa-sync-alt"></i> Easy Replacement</span>
              <span><i class="fas fa-shield-alt"></i> Manganese Steel</span>
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

                  <h3 class="mtc-tech-heading">Superior Sizing with Ring Type Technology</h3>
                  <p class="mtc-tech-paragraph">
                    The Manual Tools Company **Ring Type Double Drive Coke Cutter** is a specialized variant of our standard sizing machines. Instead of a single drum shell, the shaft is fitted with multiple **independent Manganese Steel Rings**. This design offers superior flexibility in maintenance and ensures a more aggressive cutting action for hard metallurgical coke.
                  </p>
                  <p class="mtc-tech-paragraph">
                    Powered by **Two 20 H.P. Motors**, the counter-rotating shafts deliver high torque to prevent stalling. The ring design prevents the formation of "slabs" (flat pieces) and reduces the generation of fines, ensuring optimal blast furnace permeability.
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
                          <td><strong>Cutting Element</strong></td>
                          <td>Segmented Toothed Rings</td>
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
                          <td>45 mm – 60 mm (Adjustable)</td>
                        </tr>
                        <tr>
                          <td><strong>Processing Capacity</strong></td>
                          <td>12 – 15 Tons Per Hour</td>
                        </tr>
                        <tr>
                          <td><strong>Material of Construction</strong></td>
                          <td>High Manganese Steel (Rings)</td>
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
                        <!-- Ensure you have a relevant diagram or keep the generic one -->
                        <img src="assets/img/product-images/coke-cutter/process-diagram.jpg"
                          alt="Ring Type Coke Cutter Process Flow" class="img-fluid w-100">
                        <div class="mtc-flow-image-overlay">
                          <i class="fas fa-info-circle"></i> Ring Cutter Mechanism
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="ps-lg-4">
                        <h3 style="font-weight: 800; font-size: 26px; margin-bottom: 40px; color: #333;">
                          <span style="color: var(--primary-color);">Ring-Type</span> Sizing Process
                        </h3>

                        <div class="mtc-process-timeline">

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 01</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-dolly-flatbed"></i> Feed Intake</h4>
                              <p class="mtc-timeline-desc">
                                Large coke lumps fall into the cutting chamber. The robust housing is designed to withstand impact from heavy material.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 02</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-ring"></i> Ring Shearing</h4>
                              <p class="mtc-timeline-desc">
                                As the shafts rotate, the toothed rings engage the coke. The segmented design concentrates force on specific points, cleaner cuts with less dust.
                              </p>
                            </div>
                          </div>

                          <div class="mtc-timeline-item">
                            <div class="mtc-timeline-marker"></div>
                            <div class="mtc-timeline-content">
                              <span class="mtc-timeline-number">Step 03</span>
                              <h4 class="mtc-timeline-title"><i class="fas fa-sort-amount-down"></i> Sized Output</h4>
                              <p class="mtc-timeline-desc">
                                The sized coke (45-60mm) passes through the gap. Oversized pieces remain until cut, ensuring strict quality control for furnace use.
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
                      <h4 class="mtc-app-title">Steel Plants</h4>
                      <p class="mtc-app-description">Crucial for preparing metallurgical coke for Blast Furnaces where air flow permeability is key.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-fire-alt"></i>
                      </div>
                      <h4 class="mtc-app-title">Cupola Furnaces</h4>
                      <p class="mtc-app-description">Provides consistent coke sizes for foundries, ensuring stable temperatures and melting rates.</p>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="mtc-app-card">
                      <div class="mtc-app-icon-wrapper">
                        <i class="fas fa-cogs"></i>
                      </div>
                      <h4 class="mtc-app-title">Ferro Alloys</h4>
                      <p class="mtc-app-description">Used in Ferro Alloy units where specific carbon sizing is required for reduction processes.</p>
                    </div>
                  </div>

                </div>
              </div>

              <div class="tab-pane fade" id="maint" role="tabpanel">

                <div class="mtc-maintenance-alert">
                  <i class="fas fa-wrench"></i>
                  <div>
                    <strong>Maintenance Advantage:</strong> With the Ring Type design, if a specific section wears out, you can replace individual rings rather than the entire drum.
                  </div>
                </div>

                <div class="row">

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Regular Inspection</h5>
                    <ul class="mtc-maintenance-list">
                      <li>Check tightness of the ring locking nuts/keys on the shaft.</li>
                      <li>Monitor gear lubrication levels (Cast Steel Gears).</li>
                      <li>Inspect V-Belts for tension balance between the two motors.</li>
                      <li>Clear any buildup of fines in the discharge chute.</li>
                    </ul>
                  </div>

                  <div class="col-md-6">
                    <h5 class="mtc-maintenance-col-title">Parts Replacement</h5>
                    <ul class="mtc-maintenance-list">
                      <li><strong>Manganese Rings:</strong> Replace individual rings when teeth become rounded.</li>
                      <li><strong>Bearings:</strong> Heavy duty pedestals require weekly greasing.</li>
                      <li><strong>Motor Alignment:</strong> Check alignment periodically to prevent vibration.</li>
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
                        ["q" => "What is the benefit of the Ring Type design?", "a" => "The Ring Type design uses segmented toothed rings keyed to the shaft. This allows for easier maintenance—if one section is damaged, you only replace that ring instead of relining the whole drum. It also provides very aggressive cutting for hard materials."],
                        ["q" => "Why are there two motors (Double Drive)?", "a" => "Double Drive ensures equal torque distribution on both ends of the cutting shaft. This prevents the machine from jamming when a particularly large or hard lump of coke enters, and it extends the life of the gears."],
                        ["q" => "Can I adjust the output size?", "a" => "Yes, the gap between the ring shafts is adjustable. You can set the output size between 45 mm and 60 mm depending on your furnace requirements."],
                        ["q" => "How durable are the rings?", "a" => "The rings are cast from High Manganese Steel, which work-hardens during use. They are designed to withstand the abrasive nature of metallurgical coke for long periods."],
                        ["q" => "What capacity does this machine handle?", "a" => "This model is designed for a throughput of 12 to 15 Tons Per Hour (TPH)."]
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
              // Updated page context for the Sidebar Quote Form
              $_GET['page_url'] = 'coke-cutter-double-drive-ring-type';
              $_GET['page_title'] = 'Double Drive Coke Cutter (Ring Type)';
              include('sidebar-quote-form.php'); 
            ?>
        </div>
      </div>
    </section>
    <?php
    // 1. Set the current product's link/slug to exclude it from related products
    $current_page_slug = "coke-cutter-double-drive-ring-type";

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
          displayArea.innerHTML = `<img src="${src}" alt="Haulage Machine" class="img-fluid" style="height: 450px; width: 100%; object-fit: contain;">`;
      }
    }
  </script>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>