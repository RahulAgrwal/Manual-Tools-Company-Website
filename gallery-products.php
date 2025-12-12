<?php
// Define gallery items using an array of objects
$gallery_items = [
  [
    "image_path" => "assets/img/product-images/coal-crusher-single-disc/coal-crusher-1.png",
    "category" => "coal-crusher",
    "image_name" => "Coal Crusher 1",
    "category_name" => "Coal Crusher Single Disc",
  ],
  [
    "image_path" => "assets/img/product-images/coal-crusher-single-disc/coal-crusher-2.png",
    "category" => "coal-crusher",
    "image_name" => "Coal Crusher 2",
    "category_name" => "Coal Crusher Single Disc",
  ],
  [
    "image_path" => "assets/img/product-images/coal-crusher-double-disc/Coal Crusher Double Disc 1.jpeg",
    "category" => "coal-crusher",
    "image_name" => "Coal Crusher Double Disc",
    "category_name" => "Coal Crusher Double Disc",
  ],
  [
    "image_path" => "assets/img/product-images/coke-cutter/1.png",
    "category" => "coke-cutter",
    "image_name" => "Coke Cutter 1",
    "category_name" => "Coke Cutter",
  ],
  [
    "image_path" => "assets/img/product-images/conveyor-materials/Conveyor-1.png",
    "category" => "conveyor-materials",
    "image_name" => "Conveyor Material 1",
    "category_name" => "Conveyor Materials",
  ],
  [
    "image_path" => "assets/img/product-images/conveyor-materials/Conveyor-2.png",
    "category" => "conveyor-materials",
    "image_name" => "Conveyor Material",
    "category_name" => "Conveyor Materials",
  ],
  [
    "image_path" => "assets/img/product-images/haulage/haulage-1.png",
    "category" => "haulage",
    "image_name" => "Haulage 1",
    "category_name" => "Haulage",
  ],
  [
    "image_path" => "assets/img/product-images/haulage/haulage-2.png",
    "category" => "haulage",
    "image_name" => "Haulage 2",
    "category_name" => "Haulage",
  ],
  [
    "image_path" => "assets/img/product-images/haulage/haulage-3.png",
    "category" => "haulage",
    "image_name" => "Haulage 3",
    "category_name" => "Haulage",
  ],
  [
    "image_path" => "assets/img/product-images/power-winch/power-winch-1.png",
    "category" => "power-winch",
    "image_name" => "Power Winch 1",
    "category_name" => "Power Winch",
  ],
  [
    "image_path" => "assets/img/product-images/power-winch/power-winch-2.png",
    "category" => "power-winch",
    "image_name" => "Power Winch 2",
    "category_name" => "Power Winch",
  ],
  [
    "image_path" => "assets/img/product-images/vibrator-screen/Vibrator-Screen.png",
    "category" => "vibrator-screen",
    "image_name" => "Vibrator Screen 1",
    "category_name" => "Vibrator Screen",
  ],  
  [
    "image_path" => "assets/img/product-images/pusher-machine-with-stamping-arrangement/IMG20250815080442.jpg",
    "category" => "pusher-machine",
    "image_name" => "Pusher Machine 1",
    "category_name" => "Pusher Machine",
  ],  
  [
    "image_path" => "assets/img/product-images/coal-charging-car/coal-charging-car-1.jpg",
    "category" => "coal-charging-car",
    "image_name" => "Coal Charging Car 1",
    "category_name" => "Coal Charging Car",
  ],
  [
    "image_path" => "assets/img/product-images/coal-charging-car/coal-charging-car-2.jpg",
    "category" => "coal-charging-car",
    "image_name" => "Coal Charging Car 1",
    "category_name" => "Coal Charging Car",
  ],
];

// Get unique categories for filters
$categories = [];
foreach ($gallery_items as $item) {
  if (!in_array($item['category'], $categories)) {
    $categories[] = $item['category'];
  }
}
?>
<section id="portfolio" class="portfolio">
  <div class="container">
    <div class="section-title">
      <h2>Some of our <strong>Photo Gallery</strong></h2>
    </div>

    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          <?php foreach ($categories as $category) : ?>
            <li data-filter=".<?php echo $category; ?>" class="filter-<?php echo $category; ?>"><?php echo ucwords(str_replace("-", " ", $category)); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="row portfolio-container">
      <?php foreach ($gallery_items as $item) : ?>
        <div class="col-lg-4 col-md-6 portfolio-item <?php echo $item['category']; ?>">
          <img src="<?php echo $item['image_path']; ?>" class="img-fluid" alt="<?php echo $item['image_name']; ?>" loading="lazy" decoding="async">
          <div class="portfolio-info">
            <h4><?php echo $item['category_name']; ?></h4>
            <a href="<?php echo $item['image_path']; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"><i class="fas fa-eye"></i></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section><!-- End Products Gallery Section -->