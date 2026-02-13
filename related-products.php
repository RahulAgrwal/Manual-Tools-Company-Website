<!-- ============================================ -->
<!-- RELATED PRODUCTS SECTION                     -->
<!-- ============================================ -->

<section class="related-section">
  <div class="container">
    
    <!-- Section Header -->
    <div class="related-header">
      <div class="related-title-group">
        <h2>Related <span class="highlight-text">Products</span></h2>
        <p>Explore our comprehensive range of heavy machinery.</p>
      </div>

      <div class="related-nav-btns">
        <button class="nav-btn" id="relPrevBtn" aria-label="Previous products">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="nav-btn" id="relNextBtn" aria-label="Next products">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </div>

    <!-- Products Slider -->
    <div class="related-slider" id="relatedSlider">
      <?php
        // Load global product cards
        if (!isset($GLOBAL_PRODUCT_CARDS)) {
          include_once 'global-products.php';
        }

        // Get current page slug for filtering
        $exclude_slug = isset($current_page_slug) ? $current_page_slug : "";

        // Filter products (exclude current page)
        $filtered_products = array_filter($GLOBAL_PRODUCT_CARDS, function($card) use ($exclude_slug) {
          return $card['link'] !== $exclude_slug;
        });

        // Limit to 8 items
        $display_products = array_slice($filtered_products, 0, 8);

        // Render product cards
        foreach ($display_products as $product) {
      ?>

      <div class="related-product-wrapper">
        <div class="related-card">
          <div class="related-img">
            <img 
              src="<?php echo htmlspecialchars($product['image_path']); ?>" 
              alt="<?php echo htmlspecialchars($product['title']); ?>"
              loading="lazy"
            >
          </div>
          <div class="related-info">
            <h3 class="related-product-title">
              <?php echo htmlspecialchars($product['title']); ?>
            </h3>
            <?php if (isset($product['short_description'])): ?>
              <p class="related-description">
                <?php echo htmlspecialchars($product['short_description']); ?>
              </p>
            <?php endif; ?>
            <a href="<?php echo htmlspecialchars($product['link']); ?>" class="related-link">
              Details <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>

      <?php } ?>
    </div>

  </div>
</section>

<!-- Scripts -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const slider = document.getElementById('relatedSlider');
    const prevBtn = document.getElementById('relPrevBtn');
    const nextBtn = document.getElementById('relNextBtn');

    if (slider && prevBtn && nextBtn) {
      const SCROLL_AMOUNT = 320;

      nextBtn.addEventListener('click', function() {
        slider.scrollLeft += SCROLL_AMOUNT;
      });

      prevBtn.addEventListener('click', function() {
        slider.scrollLeft -= SCROLL_AMOUNT;
      });
    }
  });
</script>

<!-- Styles -->
<style>
  /* ============================================ */
  /* RELATED PRODUCTS SECTION                     */
  /* ============================================ */

  .related-section {
    background: #fdfdfd;
    padding: 60px 0;
    border-top: 1px solid #eee;
  }

  /* Header */
  .related-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 2rem;
    gap: 2rem;
  }

  .related-title-group h2 {
    font-weight: 800;
    font-size: 24px;
    text-transform: uppercase;
    margin: 0 0 0.5rem 0;
  }

  .related-title-group p {
    font-size: 14px;
    color: #777;
    margin: 0;
  }

  /* Navigation Buttons */
  .related-nav-btns {
    display: flex;
    gap: 10px;
  }

  .nav-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    font-size: 16px;
  }

  .nav-btn:hover {
    background-color: var(--primary-color, #f03c02);
    color: #fff;
    border-color: var(--primary-color, #f03c02);
  }

  .nav-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(240, 60, 2, 0.2);
  }

  /* Slider */
  .related-slider {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    scroll-behavior: smooth;
    gap: 1.5rem;
    padding: 0.5rem 0;
    scrollbar-width: thin;
    scrollbar-color: #e0e0e0 transparent;
  }

  .related-slider::-webkit-scrollbar {
    height: 6px;
  }

  .related-slider::-webkit-scrollbar-track {
    background: transparent;
  }

  .related-slider::-webkit-scrollbar-thumb {
    background-color: #e0e0e0;
    border-radius: 10px;
  }

  .related-slider::-webkit-scrollbar-thumb:hover {
    background-color: #999;
  }

  /* Product Wrapper */
  .related-product-wrapper {
    flex: 0 0 auto;
    width: 280px;
  }

  /* Product Card */
  .related-card {
    background: #fff;
    border: 1px solid #eee;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .related-card:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    transform: translateY(-5px);
  }

  /* Card Image */
  .related-img {
    height: 180px;
    background: #f4f4f4;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .related-img img {
    max-height: 100%;
    width: auto;
    object-fit: contain;
  }

  /* Card Content */
  .related-info {
    padding: 20px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  .related-product-title {
    font-size: 16px;
    font-weight: 700;
    margin: 0 0 10px 0;
    color: #333;
    line-height: 1.4;
  }

  .related-description {
    font-size: 12px;
    line-height: 1.4;
    margin: 0 0 10px 0;
    color: #777;
    flex-grow: 1;
  }

  /* Link */
  .related-link {
    color: var(--primary-color, #f03c02);
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: color 0.3s ease;
  }

  .related-link:hover {
    color: #d63001;
  }

  .related-link i {
    font-size: 10px;
    transition: transform 0.2s ease;
  }

  .related-card:hover .related-link i {
    transform: translateX(3px);
  }

  /* Responsive */
  @media (max-width: 768px) {
    .related-header {
      flex-direction: column;
      align-items: flex-start;
    }

    .related-title-group h2 {
      font-size: 20px;
    }

    .related-nav-btns {
      width: 100%;
      justify-content: flex-end;
    }
  }
</style>