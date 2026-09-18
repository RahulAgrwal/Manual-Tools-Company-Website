<?php
// Other machines, as a horizontally scrolling row of the shared .product-card.
// Set $current_page_slug before including it so the current product is left out.
//
// This used to carry its own 200-line <style> and a script that scrolled by a
// hardcoded 320px while each card was 280px plus a 24px gap. Styling now lives
// in assets/css/product.css; the arrows are wired in product-gallery.js and
// scroll by one measured card, so they cannot drift from the layout again.
if (!isset($GLOBAL_PRODUCT_CARDS)) {
    include_once 'global-products.php';
}
$exclude_slug = $current_page_slug ?? '';
$related = array_slice(
    array_values(array_filter($GLOBAL_PRODUCT_CARDS, fn($c) => $c['link'] !== $exclude_slug)),
    0,
    8
);
?>
<section class="section section--sunk related" aria-labelledby="related-title">
  <div class="wrap">
    <div class="related__head">
      <div>
        <h2 id="related-title">Other machinery we build</h2>
        <p>Made in Dhanbad for coke oven plants, coal washeries and steel plants.</p>
      </div>
      <div class="related__nav">
        <button type="button" class="icon-btn" data-related="prev" aria-controls="related-track" aria-label="Scroll to previous machines">
          <i class="fas fa-chevron-left" aria-hidden="true"></i>
        </button>
        <button type="button" class="icon-btn" data-related="next" aria-controls="related-track" aria-label="Scroll to next machines">
          <i class="fas fa-chevron-right" aria-hidden="true"></i>
        </button>
      </div>
    </div>

    <div class="related__track" id="related-track" tabindex="0" aria-label="Other machinery">
      <?php foreach ($related as $card) : ?>
        <article class="product-card">
          <div class="product-card__well">
            <img src="<?php echo mtc_thumb($card['image_path']); ?>"
                 <?php echo mtc_img_size(mtc_thumb($card['image_path'])); ?>
                 alt="<?php echo htmlspecialchars($card['title'] . ' - ' . $card['subtitle']); ?>"
                 loading="lazy" decoding="async">
          </div>
          <div class="product-card__body">
            <p class="product-card__variant"><?php echo htmlspecialchars($card['subtitle']); ?></p>
            <h3 class="product-card__title">
              <a href="<?php echo htmlspecialchars($card['link']); ?>"><?php echo htmlspecialchars($card['title']); ?></a>
            </h3>
            <p class="product-card__desc"><?php echo htmlspecialchars($card['short_description']); ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
