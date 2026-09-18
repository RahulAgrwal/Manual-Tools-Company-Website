<!-- ============================================ -->
<!-- MTC PRODUCT CATALOG                          -->
<!-- ============================================ -->
<?php
include_once 'global-products.php';
$product_cards = $GLOBAL_PRODUCT_CARDS;
?>
<section id="our-products" class="section section--sunk">
  <div class="wrap">

    <div class="section-head section-head--center">
      <h2>Machinery we build</h2>
      <p>Ten machines for coke oven plants, coal washeries and steel plants, made to your plant's drawings.</p>
    </div>

    <div class="grid grid--4">
      <?php foreach ($product_cards as $card) : ?>
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
              <a href="<?php echo $card['link']; ?>"><?php echo htmlspecialchars($card['title']); ?></a>
            </h3>
            <p class="product-card__desc"><?php echo htmlspecialchars($card['short_description']); ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
      <a href="products" class="btn btn--quiet">See all specifications</a>
    </div>

  </div>
</section>
