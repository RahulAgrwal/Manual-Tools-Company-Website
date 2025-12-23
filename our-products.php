<!-- ============================================ -->
<!-- MTC MODERN PRODUCT CATALOG                   -->
<!-- ============================================ -->
<section id="our-products" class="mtc-products-section">
  <div class="container">

    <div class="section-title text-center mb-5">
      <h2 class="mtc-section-header">Industrial <span class="text-orange">Solutions</span></h2>
      <p class="text-muted">High-performance machinery engineered for the coal and coke industry.</p>
    </div>

    <div class="row g-4">
      
          <?php
          $product_cards = [
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Coal-Crusher-single-disc.jpg",
              "title" => "Coal Crusher 5 No. Size",
              "subtitle" => "Single Disc",
              "link" => "coal-crusher-5-No-single-disc"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Coal-Crusher-Double-Disc.jpg",
              "title" => "Coal Crusher 5 No. Size",
              "subtitle" => "Double Disc",
              "link" => "coal-crusher-5-No-double-disc"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Double-Drive-Coke-Cutter-Machine.jpg",
              "title" => "Coke Cutter Machine",
              "subtitle" => "Double Drive",
              "link" => "coke-cutter-double-drive"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Haulage-Machine.png",
              "title" => "Haulage Machine",
              "subtitle" => "Power Driven",
              "link" => "haulage"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Power-Winchh.png",
              "title" => "Power Winch",
              "subtitle" => "Power Driven",
              "link" => "power-winch"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Vibrator-Screen-Machine.png",
              "title" => "Vibrator Screen Machine",
              "subtitle" => "Triple Deck",
              "link" => "vibrator-screen"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Conveyor-Material.png",
              "title" => "Idler Roller, Head Pulley, Tail Pulley",
              "subtitle" => "Conveyor Material",
              "link" => "conveyor-materials"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Pusher-Machine-With-Stamping-Arrangement.jpg",
              "title" => "Pusher Machine With Stamping Arrangement",
              "subtitle" => "Roller System",
              "link" => "pusher-with-stamping-arrangement"
            ],
            [
              "image_path" => "assets/img/about-us-products-thumbnail/Coal-Charging-Car.jpg",
              "title" => "Coal Charging Car",
              "subtitle" => "Coke Oven Charging",
              "link" => "coal-charging-car"
            ]
          ];
          ?>

      <?php foreach ($product_cards as $card) : ?>
        <!-- CHANGED from col-lg-3 to col-lg-4 for a bigger, premium look -->
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="mtc-product-card">
            
            <!-- Image Area -->
            <div class="card-img-wrap">
              <img src="<?php echo $card['image_path']; ?>" 
                   alt="<?php echo $card['title']; ?>" 
                   loading="lazy">
              <!-- Overlay for hover effect -->
              <div class="img-overlay"></div>
            </div>

            <!-- Content Area -->
            <div class="card-body">
              <span class="spec-badge"><?php echo $card['subtitle']; ?></span>
              <h4 class="product-title">
                <a href="<?php echo $card['link']; ?>"><?php echo $card['title']; ?></a>
              </h4>
              
              <div class="card-footer-action">
                <a href="<?php echo $card['link']; ?>" class="view-link">
                  View Details <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- View All Button -->
    <div class="text-center mt-5">
      <a href="products" class="mtc-btn-outline">
        View All Products
      </a>
    </div>

  </div>
</section>