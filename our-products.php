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
          // Use global product cards
          include_once 'global-products.php';
          $product_cards = $GLOBAL_PRODUCT_CARDS;
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