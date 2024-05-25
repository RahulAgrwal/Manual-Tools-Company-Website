<?php
// Define the path to the product-images directory
$productImagesPath = "assets/img/product-images/";

// Function to get all folders from a directory
function getAllFolders($path)
{
  $folders = array();
  // Get all files and directories from the specified path
  $items = scandir($path);
  // Filter out only the directories
  foreach ($items as $item) {
    if (is_dir($path . $item) && $item != '.' && $item != '..') {
      $folders[] = $item;
    }
  }
  return $folders;
}

// Get all folders from the product-images directory
$productFolders = getAllFolders($productImagesPath);
?>
<section id="portfolio" class="portfolio">
  <div class="container">
    <div class="section-title" data-aos="fade-up">
      <h2>Some of our <strong>Photo Gallery</strong></h2>
    </div>

    <div class="row" data-aos="fade-up">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          <?php
          // Generate filter list
          foreach ($productFolders as $category) {
            echo '<li data-filter=".' . $category . '" class="filter-' . $category . '">' . ucwords(str_replace("-", " ", $category)) . '</li>';
          }
          ?>
        </ul>
      </div>
    </div>

    <div class="row portfolio-container" data-aos="fade-up">
      <?php
      // Generate portfolio items for each category
      foreach ($productFolders as $category) {
        $folderPath = $productImagesPath . $category . '/';
        $images = scandir($folderPath);
        foreach ($images as $image) {
          if (!in_array($image, array('.', '..'))) {
            echo '<div class="col-lg-4 col-md-6 portfolio-item ' . $category . '">';
            echo '<img src="' . $folderPath . $image . '" class="img-fluid" alt="">';
            echo '<div class="portfolio-info">';
            echo '<h4>' . $category . '</h4>';
            echo '<a href="' . $folderPath . $image . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" ><i class="fas fa-eye"></i></a>';
            echo '</div></div>';
          }
        }
      }
      ?>
    </div>
  </div>
</section><!-- End Products Gallery Section -->