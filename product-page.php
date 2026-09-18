<?php
/**
 * The one template behind every product detail page.
 *
 * Each <slug>.php at the repo root is a three-line stub that sets
 * $mtc_product_slug and requires this file. The slugs must stay as real files
 * at the root: .htaccess maps /haulage to haulage.php, asset paths are
 * relative, and header.php and footer.php derive the active nav link and the
 * visitor-counter page key from PHP_SELF.
 *
 * Content comes from $MTC_PRODUCTS in product-data.php.
 */

// The gallery is built before <head> is written, so the image helpers have to
// be loaded here rather than waiting for common-head.php to pull them in.
require_once __DIR__ . '/page-helpers.php';
require_once __DIR__ . '/product-data.php';

$slug = $mtc_product_slug ?? null;
if (!$slug || !isset($MTC_PRODUCTS[$slug])) {
    // A typo in a stub or a rewrite rule should 404, not render a broken page.
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$p = $MTC_PRODUCTS[$slug];
$url = 'https://www.manualtoolsco.com/' . $slug;

/* ---------------------------------------------------------------- gallery
 * One list of typed media for every page. The two pages that have footage
 * used to carry a separate 27-line swapMedia(); the other eight carried
 * eight byte-identical copies of swapImage(). Now there is one shape and
 * one handler in assets/js/product-gallery.js.
 */
$media = [];
if (!empty($p['main_image'])) {
    $media[] = ['type' => 'image', 'src' => mtc_img($p['main_image']), 'thumb' => mtc_thumb($p['main_image'])];
}
foreach (glob($p['gallery_dir'] . '*.{jpg,jpeg,png,gif}', GLOB_BRACE) ?: [] as $img) {
    $media[] = ['type' => 'image', 'src' => mtc_img($img), 'thumb' => mtc_thumb($img)];
}
if (!empty($p['has_video'])) {
    $poster = !empty($p['main_image']) ? mtc_thumb($p['main_image']) : '';
    foreach (glob($p['gallery_dir'] . '*.{mp4,webm}', GLOB_BRACE) ?: [] as $vid) {
        $media[] = ['type' => 'video', 'src' => $vid, 'thumb' => $poster];
    }
}
if (!$media) {
    $media[] = ['type' => 'image', 'src' => '', 'thumb' => ''];
}
$first = $media[0];

/** Tab ids the template knows how to render; anything else falls back to custom_tabs. */
$flow_ids = ['operationalflow', 'process', 'flow'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?php echo htmlspecialchars($p['description']); ?>">
  <meta name="robots" content="index, follow">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="canonical" href="<?php echo $url; ?>">

  <title><?php echo htmlspecialchars($p['title']); ?></title>

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="product">
  <meta property="og:url" content="<?php echo $url; ?>">
  <meta property="og:title" content="<?php echo htmlspecialchars($p['title']); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($p['description']); ?>">
  <meta property="og:image" content="https://www.manualtoolsco.com/<?php echo $p['og_image']; ?>">
  <meta property="og:site_name" content="Manual Tools Company">

  <!-- JSON-LD Structured Data. additionalProperty is generated from the same
       specs the page displays, so the two can no longer drift apart. -->
  <script type="application/ld+json">
<?php
echo json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $p['schema_name'],
    'image' => 'https://www.manualtoolsco.com/' . $p['og_image'],
    'description' => $p['schema_description'],
    'sku' => $p['sku'],
    'brand' => ['@type' => 'Brand', 'name' => 'Manual Tools Company'],
    'manufacturer' => ['@type' => 'Organization', 'name' => 'Manual Tools Company', 'url' => 'https://www.manualtoolsco.com/'],
    'url' => $url,
    'additionalProperty' => array_map(
        fn($kv) => ['@type' => 'PropertyValue', 'name' => $kv[0], 'value' => $kv[1]],
        $p['schema_props']
    ),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>
  </script>

  <?php $mtc_page_css = ['assets/css/legacy-product.css']; ?>
  <?php include('common-head.php'); ?>
  <?php mtc_breadcrumb_schema(['Products' => 'products', $p['crumb_last'] => $slug]); ?>
</head>

<body>

  <?php include('header.php'); ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2><?php echo htmlspecialchars($p['crumb_heading']); ?></h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li><a href="products">Products</a></li>
            <li><?php echo htmlspecialchars($p['crumb_last']); ?></li>
          </ol>
        </div>
      </div>
    </section>

    <!-- ======= Hero: gallery + key facts ======= -->
    <section class="mtc-product-hero">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="mtc-product-main-frame text-center" id="mtc-main-display">
              <?php if ($first['type'] === 'video') : ?>
                <video src="<?php echo htmlspecialchars($first['src']); ?>" controls playsinline
                  preload="none" poster="<?php echo htmlspecialchars($first['thumb']); ?>"
                  class="img-fluid"></video>
              <?php else : ?>
                <img id="mainImage" src="<?php echo htmlspecialchars($first['src']); ?>"
                  <?php echo mtc_img_size($first['src']); ?> fetchpriority="high"
                  alt="<?php echo htmlspecialchars($p['hero_alt']); ?>" class="img-fluid">
              <?php endif; ?>
            </div>

            <div class="mtc-product-thumb-grid">
              <?php foreach ($media as $i => $m) : ?>
                <button type="button"
                  class="mtc-product-thumb-item<?php echo $i === 0 ? ' active' : ''; ?>"
                  data-type="<?php echo $m['type']; ?>"
                  data-full="<?php echo htmlspecialchars($m['src']); ?>"
                  data-poster="<?php echo htmlspecialchars($m['thumb']); ?>"
                  aria-label="<?php echo htmlspecialchars(($m['type'] === 'video' ? 'Play video ' : 'View photo ') . ($i + 1)); ?>">
                  <img src="<?php echo htmlspecialchars($m['thumb']); ?>" loading="lazy" alt=""
                    aria-hidden="true">
                  <?php if ($m['type'] === 'video') : ?>
                    <span class="mtc-video-thumb-overlay"><i class="fas fa-play"></i></span>
                  <?php endif; ?>
                </button>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="col-lg-6 ps-lg-5">
            <div class="mtc-product-eyebrow"><?php echo htmlspecialchars($p['eyebrow']); ?></div>
            <h1 class="mtc-product-title"><?php echo htmlspecialchars($p['h1_lead']); ?>
              <?php if ($p['h1_accent']) : ?><br><span class="mtc-highlight"><?php echo htmlspecialchars($p['h1_accent']); ?></span><?php endif; ?>
            </h1>

            <div class="mtc-product-review-row">
              <?php if ($p['model']) : ?><span><?php echo htmlspecialchars($p['model_label']); ?>: <?php echo htmlspecialchars($p['model']); ?></span><?php endif; ?>
              <span class="mtc-product-stock-badge"><?php echo htmlspecialchars($p['stock']); ?></span>
            </div>

            <?php if ($p['intro_html']) : ?>
              <p class="mtc-product-intro"><?php echo $p['intro_html']; ?></p>
            <?php endif; ?>

            <div class="mtc-product-specs-grid">
              <?php foreach ($p['specs'] as [$icon, $label, $value]) : ?>
                <div class="mtc-product-spec-item">
                  <i class="fas <?php echo $icon; ?> mtc-product-spec-icon" aria-hidden="true"></i>
                  <div class="mtc-product-spec-text">
                    <span><?php echo htmlspecialchars($label); ?></span>
                    <strong><?php echo htmlspecialchars($value); ?></strong>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>

            <div class="mtc-product-action-row">
              <?php if ($p['brochure']) : ?>
                <a href="<?php echo $p['brochure']; ?>" class="mtc-btn-dark" download>
                  <i class="fas fa-download"></i> Brochure
                </a>
              <?php endif; ?>
              <a href="#quote-form" class="mtc-btn-orange">
                <i class="fas fa-file-signature"></i> Request Quote
              </a>
              <a href="tel:+919430707348" class="mtc-btn-call-us">
                <i class="fas fa-phone"></i> Call Us
              </a>
            </div>

            <div class="mtc-product-trust-badges">
              <?php foreach ($p['trust'] as [$icon, $text]) : ?>
                <span><i class="fas <?php echo $icon; ?>"></i> <?php echo htmlspecialchars($text); ?></span>
              <?php endforeach; ?>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- ======= Overview & buying information ======= -->
    <section class="mtc-product-overview">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-8">
            <h2 class="mtc-overview-title"><?php echo htmlspecialchars($p['overview_heading']); ?></h2>
            <?php foreach ($p['overview_paras'] as $para) : ?>
              <p><?php echo $para; ?></p>
            <?php endforeach; ?>
            <?php if ($p['overview_related_html']) : ?>
              <p class="mtc-overview-related"><?php echo $p['overview_related_html']; ?></p>
            <?php endif; ?>
          </div>
          <div class="col-lg-4">
            <div class="mtc-buyer-box">
              <h3>Buying information</h3>
              <ul>
                <?php foreach ($p['buyer_items'] as $item) : ?>
                  <li><?php echo $item; ?></li>
                <?php endforeach; ?>
              </ul>
              <a href="#quote-form" class="mtc-btn-orange"><i class="fas fa-file-signature"></i> Request a Quotation</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Detail tabs + quote form ======= -->
    <section class="section-bg" style="padding: 60px 0;">
      <div class="container">
        <div class="row">

          <div class="col-lg-8">

            <ul class="nav nav-tabs mtc-content-tabs" id="myTab" role="tablist">
              <?php foreach ($p['tabs'] as $i => $tab) : ?>
                <li class="nav-item" role="presentation">
                  <button class="nav-link<?php echo $i === 0 ? ' active' : ''; ?>"
                    id="<?php echo $tab['id']; ?>-tab" data-bs-toggle="tab"
                    data-bs-target="#<?php echo $tab['id']; ?>" type="button"
                    role="tab"><?php echo htmlspecialchars($tab['label']); ?></button>
                </li>
              <?php endforeach; ?>
            </ul>

            <div class="tab-content" id="myTabContent">
              <?php foreach ($p['tabs'] as $i => $tab) :
                $id = $tab['id'];
                $paneClass = 'tab-pane fade' . ($i === 0 ? ' show active' : '');
              ?>
                <div class="<?php echo $paneClass; ?>" id="<?php echo $id; ?>" role="tabpanel">

                  <?php if ($id === 'desc') : ?>
                    <div class="mtc-tech-wrapper">
                      <?php if ($p['tech_heading']) : ?>
                        <h3 class="mtc-tech-heading"><?php echo htmlspecialchars($p['tech_heading']); ?></h3>
                      <?php endif; ?>
                      <?php foreach ($p['tech_paras'] as $para) : ?>
                        <p class="mtc-tech-paragraph"><?php echo $para; ?></p>
                      <?php endforeach; ?>

                      <?php if ($p['tech_rows']) : ?>
                        <h3 class="mtc-tech-heading" style="font-size: 20px; margin-top: 40px;">
                          <?php echo htmlspecialchars($p['tech_table_heading'] ?: 'Technical Parameters'); ?>
                        </h3>
                        <div class="mtc-tech-table-container">
                          <table class="mtc-modern-tech-table">
                            <thead>
                              <tr>
                                <th width="40%">Parameter</th>
                                <th>Specification Value</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($p['tech_rows'] as [$k, $v]) : ?>
                                <tr>
                                  <td><strong><?php echo htmlspecialchars($k); ?></strong></td>
                                  <td><?php echo htmlspecialchars($v); ?></td>
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        </div>
                      <?php endif; ?>
                    </div>

                  <?php elseif (in_array($id, $flow_ids, true)) : ?>
                    <div class="mtc-timeline-wrapper">
                      <div class="row">
                        <?php if ($p['process_diagram']) : ?>
                          <!-- Three pages show a process diagram beside the timeline. -->
                          <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="mtc-flow-image-box">
                              <img src="<?php echo mtc_img($p['process_diagram']); ?>"
                                <?php echo mtc_img_size(mtc_img($p['process_diagram'])); ?>
                                loading="lazy"
                                alt="<?php echo htmlspecialchars($p['process_diagram_alt'] ?: $p['schema_name'] . ' process flow diagram'); ?>"
                                class="img-fluid w-100">
                              <?php if ($p['process_diagram_caption']) : ?>
                                <div class="mtc-flow-image-overlay">
                                  <i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($p['process_diagram_caption']); ?>
                                </div>
                              <?php endif; ?>
                            </div>
                          </div>
                        <?php endif; ?>
                        <div class="col-lg-6">
                          <div class="ps-lg-4">
                            <?php if ($p['flow_heading_accent']) : ?>
                              <h3 class="mtc-flow-heading">
                                <span><?php echo htmlspecialchars($p['flow_heading_accent']); ?></span>
                                <?php echo htmlspecialchars($p['flow_heading_rest']); ?>
                              </h3>
                            <?php endif; ?>
                            <div class="mtc-process-timeline">
                              <?php foreach ($p['flow_steps'] as $n => [$icon, $title, $desc]) : ?>
                                <div class="mtc-timeline-item">
                                  <div class="mtc-timeline-marker"></div>
                                  <div class="mtc-timeline-content">
                                    <span class="mtc-timeline-number"><?php echo htmlspecialchars($p['flow_step_word']); ?> <?php echo str_pad($n + 1, 2, '0', STR_PAD_LEFT); ?></span>
                                    <h4 class="mtc-timeline-title"><i class="fas <?php echo $icon; ?>"></i> <?php echo htmlspecialchars($title); ?></h4>
                                    <p class="mtc-timeline-desc"><?php echo $desc; ?></p>
                                  </div>
                                </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php elseif ($id === 'apps') : ?>
                    <div class="row mtc-app-grid-container g-4">
                      <?php foreach ($p['apps'] as [$icon, $title, $desc]) : ?>
                        <div class="col-md-4">
                          <div class="mtc-app-card">
                            <div class="mtc-app-icon-wrapper"><i class="fas <?php echo $icon; ?>"></i></div>
                            <h4 class="mtc-app-title"><?php echo htmlspecialchars($title); ?></h4>
                            <p class="mtc-app-description"><?php echo $desc; ?></p>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>

                  <?php elseif ($id === 'maint') : ?>
                    <?php if ($p['maint_alert']) : ?>
                      <div class="mtc-maintenance-alert">
                        <i class="fas <?php echo $p['maint_alert'][0] ?: 'fa-exclamation-circle'; ?>"></i>
                        <div>
                          <strong><?php echo htmlspecialchars($p['maint_alert'][1]); ?></strong>
                          <?php echo $p['maint_alert'][2]; ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="row">
                      <?php foreach ($p['maint_cols'] as $col) : ?>
                        <div class="col-md-6">
                          <h5 class="mtc-maintenance-col-title"><?php echo htmlspecialchars($col['title']); ?></h5>
                          <ul class="mtc-maintenance-list">
                            <?php foreach ($col['items'] as $item) : ?>
                              <li><?php echo $item; ?></li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      <?php endforeach; ?>
                    </div>

                  <?php elseif ($id === 'faq') : ?>
                    <div class="row">
                      <div class="col-lg-10 mx-auto">
                        <div class="mtc-faq-container">
                          <?php foreach ($p['faqs'] as $n => [$q, $a]) :
                            $open = $n === 0;
                            $cid = 'localFaq' . $n;
                          ?>
                            <div class="mtc-faq-item">
                              <button class="mtc-faq-button<?php echo $open ? '' : ' collapsed'; ?>" type="button"
                                data-bs-toggle="collapse" data-bs-target="#<?php echo $cid; ?>"
                                aria-expanded="<?php echo $open ? 'true' : 'false'; ?>">
                                <?php echo htmlspecialchars($q); ?>
                                <span class="mtc-faq-icon"><i class="fas fa-chevron-down"></i></span>
                              </button>
                              <div id="<?php echo $cid; ?>" class="collapse<?php echo $open ? ' show' : ''; ?>"
                                data-bs-parent="#faq">
                                <div class="mtc-faq-body"><?php echo htmlspecialchars($a); ?></div>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                      </div>
                    </div>

                  <?php elseif (isset($p['custom_tabs'][$id])) : ?>
                    <?php echo $p['custom_tabs'][$id]; ?>
                  <?php endif; ?>

                </div>
              <?php endforeach; ?>
            </div>

          </div>

          <div class="col-lg-4 mt-5 mt-lg-0" id="quote-form">
            <?php
            // sidebar-quote-form.php reads these, and footer.php switches the
            // mobile CTA target on isset($_GET['page_url']). Keep both.
            $_GET['page_url'] = $slug;
            $_GET['page_title'] = $p['quote_title'] ?: $p['schema_name'];
            include('sidebar-quote-form.php');
            ?>
          </div>
        </div>
      </div>
    </section>

    <?php
    $current_page_slug = $p['related_slug'];
    include('related-products.php');
    ?>

  </main>

  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" aria-label="Back to top"><i class="fas fa-arrow-up"></i></a>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo mtc_asset('assets/js/product-gallery.js'); ?>"></script>
  <script src="<?php echo mtc_asset('assets/js/main.js'); ?>"></script>

</body>

</html>
