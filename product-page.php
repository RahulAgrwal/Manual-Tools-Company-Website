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
// Lead with the clean transparent cutout (the same one the product cards use),
// not the scanned catalogue plate in $p['main_image']: the plate has a
// "MANUAL TOOLS CO." header, a halftone background and a caption baked into
// its pixels. The plate is still the og:image, so social previews and the
// Product JSON-LD are unchanged.
require_once __DIR__ . '/global-products.php';
$cutout = null;
foreach ($GLOBAL_PRODUCT_CARDS as $card) {
    if ($card['link'] === $slug) { $cutout = $card['image_path']; break; }
}
$lead = $cutout ?: ($p['main_image'] ?? null);

$media = [];
if ($lead) {
    $media[] = ['type' => 'image', 'src' => mtc_img($lead), 'thumb' => mtc_thumb($lead)];
}
$labels = $p['gallery_labels'] ?? [];
foreach (glob($p['gallery_dir'] . '*.{jpg,jpeg,png,gif}', GLOB_BRACE) ?: [] as $img) {
    // The lead can be one of the gallery photos; don't list it twice.
    if ($lead && basename($img) === basename($lead) && dirname($img) . '/' === $p['gallery_dir']) continue;
    $media[] = ['type' => 'image', 'src' => mtc_img($img), 'thumb' => mtc_thumb($img),
                'label' => $labels[basename($img)] ?? ''];
}
if (!empty($p['has_video'])) {
    $poster = $lead ? mtc_thumb($lead) : '';
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

  <?php $mtc_page_css = ['assets/css/product.css']; ?>
  <?php include('common-head.php'); ?>
  <?php mtc_breadcrumb_schema(['Products' => 'products', $p['crumb_last'] => $slug]); ?>
</head>

<body>

  <?php include('header.php'); ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <!-- The page heading (h1) is in the hero below, so this one is an h2. -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="wrap">
        <div>
          <h2><?php echo htmlspecialchars($p['crumb_heading']); ?></h2>
          <ol>
            <li><a href="/">Home</a></li>
            <li><a href="products">Products</a></li>
            <li><?php echo htmlspecialchars($p['crumb_last']); ?></li>
          </ol>
        </div>
      </div>
    </section>

    <!-- ======= Hero: the machine, then the facts a buyer screens on ======= -->
    <section class="pd-hero">
      <div class="wrap pd-hero__grid">

        <div class="pd-gallery">
          <div class="pd-well" id="mtc-main-display">
            <?php if ($first['type'] === 'video') : ?>
              <video src="<?php echo htmlspecialchars($first['src']); ?>" controls playsinline
                preload="none" poster="<?php echo htmlspecialchars($first['thumb']); ?>"></video>
            <?php else : ?>
              <img id="mainImage" src="<?php echo htmlspecialchars($first['src']); ?>"
                <?php echo mtc_img_size($first['src']); ?> fetchpriority="high"
                alt="<?php echo htmlspecialchars($p['hero_alt']); ?>">
            <?php endif; ?>
          </div>
          <!-- Names the selected image when it has a label (a spare part, say),
               so it is not mistaken for the whole machine. product-gallery.js. -->
          <p class="pd-well__caption" id="mtc-main-caption" aria-live="polite"<?php echo ($first['label'] ?? '') === '' ? ' hidden' : ''; ?>><?php echo htmlspecialchars($first['label'] ?? ''); ?></p>

          <?php if (count($media) > 1) : ?>
            <div class="pd-thumbs mtc-product-thumb-grid">
              <?php foreach ($media as $i => $m) :
                // The alt text is the button's accessible name, and Google Images
                // indexes it -- so keep it descriptive, as the old pages had it.
                $label = $m['label'] ?? '';
                $thumbAlt = $label !== ''
                    ? $label . ' - ' . $p['schema_name']
                    : $p['thumb_alt'] . ($m['type'] === 'video' ? ' video ' : ' photo ') . ($i + 1);
              ?>
                <button type="button"
                  class="pd-thumb mtc-product-thumb-item<?php echo $i === 0 ? ' active' : ''; ?>"
                  data-type="<?php echo $m['type']; ?>"
                  data-full="<?php echo htmlspecialchars($m['src']); ?>"
                  data-poster="<?php echo htmlspecialchars($m['thumb']); ?>"
                  data-label="<?php echo htmlspecialchars($label); ?>"
                  aria-pressed="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                  <img src="<?php echo htmlspecialchars($m['thumb']); ?>"
                    <?php echo $m['thumb'] ? mtc_img_size($m['thumb']) : ''; ?> loading="lazy"
                    alt="<?php echo htmlspecialchars($thumbAlt); ?>">
                  <?php if ($m['type'] === 'video') : ?>
                    <span class="pd-thumb__play" aria-hidden="true"><i class="fas fa-play"></i></span>
                  <?php endif; ?>
                </button>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <div class="pd-summary">
          <p class="pd-series"><?php echo htmlspecialchars($p['eyebrow']); ?></p>
          <h1 class="pd-title"><?php echo htmlspecialchars($p['h1_lead']); ?><?php if ($p['h1_accent']) : ?> <br><span><?php echo htmlspecialchars($p['h1_accent']); ?></span><?php endif; ?></h1>

          <p class="pd-meta">
            <?php if ($p['model']) : ?>
              <span><?php echo htmlspecialchars($p['model_label']); ?> <span class="tnum"><?php echo htmlspecialchars($p['model']); ?></span></span>
            <?php endif; ?>
            <span class="pd-stock"><?php echo htmlspecialchars($p['stock']); ?></span>
          </p>

          <?php if ($p['intro_html']) : ?>
            <p class="pd-intro"><?php echo $p['intro_html']; ?></p>
          <?php endif; ?>

          <!-- Specs are data, so they are a description list read as a table:
               label on the left, value on the right, no icons. -->
          <dl class="pd-specs">
            <?php foreach ($p['specs'] as [$icon, $label, $value]) : ?>
              <div>
                <dt><?php echo htmlspecialchars($label); ?></dt>
                <dd><?php echo htmlspecialchars($value); ?></dd>
              </div>
            <?php endforeach; ?>
          </dl>

          <div class="pd-actions">
            <a href="#quote-form" class="btn btn--primary">Request a quote</a>
            <?php if ($p['brochure']) : ?>
              <a href="<?php echo $p['brochure']; ?>" class="btn btn--quiet" download>
                <i class="fas fa-download" aria-hidden="true"></i> Brochure (PDF)
              </a>
            <?php endif; ?>
          </div>
          <p class="pd-call">
            Or call <a href="tel:+919430707348">+91 94307 07348</a>
          </p>

          <ul class="pd-trust">
            <?php foreach ($p['trust'] as [$icon, $text]) : ?>
              <li><i class="fas <?php echo $icon; ?>" aria-hidden="true"></i><?php echo htmlspecialchars($text); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>

      </div>
    </section>

    <!-- ======= Overview & buying information ======= -->
    <section class="section section--sunk pd-overview">
      <div class="wrap pd-overview__grid">
        <div class="pd-prose">
          <h2><?php echo htmlspecialchars($p['overview_heading']); ?></h2>
          <?php foreach ($p['overview_paras'] as $para) : ?>
            <p><?php echo $para; ?></p>
          <?php endforeach; ?>
          <?php if ($p['overview_related_html']) : ?>
            <p class="pd-related-link"><?php echo $p['overview_related_html']; ?></p>
          <?php endif; ?>
        </div>

        <aside class="pd-buy" aria-labelledby="buy-title">
          <h3 id="buy-title">Buying information</h3>
          <ul>
            <?php foreach ($p['buyer_items'] as $item) : ?>
              <li><?php echo $item; ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="#quote-form" class="btn btn--primary pd-buy__cta">Request a quote</a>
        </aside>
      </div>
    </section>

    <!-- ======= Detail tabs + quote form ======= -->
    <section class="section pd-details">
      <div class="wrap pd-details__grid">

        <div class="pd-detail-body">
          <!-- WAI-ARIA tabs, driven by assets/js/product-tabs.js (Bootstrap's tab
               plugin until phase 8). Inactive panels carry `hidden`, so without
               JavaScript only the first shows, and the tab buttons do nothing. -->
          <div class="pd-tabs-scroll">
            <div class="pd-tabs" role="tablist" aria-label="Product details">
              <?php foreach ($p['tabs'] as $i => $tab) : ?>
                <button class="nav-link<?php echo $i === 0 ? ' active' : ''; ?>"
                  id="<?php echo $tab['id']; ?>-tab" type="button" role="tab"
                  aria-controls="<?php echo $tab['id']; ?>"
                  aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                  tabindex="<?php echo $i === 0 ? '0' : '-1'; ?>"><?php echo htmlspecialchars($tab['label']); ?></button>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="pd-panes">
            <?php foreach ($p['tabs'] as $i => $tab) :
              $id = $tab['id'];
            ?>
              <div class="pd-pane" id="<?php echo $id; ?>" role="tabpanel" tabindex="0"
                aria-labelledby="<?php echo $id; ?>-tab"<?php echo $i === 0 ? '' : ' hidden'; ?>>

                <?php if ($id === 'desc') : ?>
                  <div class="pd-prose">
                    <?php if ($p['tech_heading']) : ?>
                      <h3><?php echo htmlspecialchars($p['tech_heading']); ?></h3>
                    <?php endif; ?>
                    <?php foreach ($p['tech_paras'] as $para) : ?>
                      <p><?php echo $para; ?></p>
                    <?php endforeach; ?>
                  </div>

                  <?php if ($p['tech_rows']) : ?>
                    <h3 class="pd-h3"><?php echo htmlspecialchars($p['tech_table_heading'] ?: 'Technical Parameters'); ?></h3>
                    <div class="spec-table-wrap">
                      <table class="spec-table">
                        <thead>
                          <tr><th scope="col">Parameter</th><th scope="col">Specification Value</th></tr>
                        </thead>
                        <tbody>
                          <?php foreach ($p['tech_rows'] as [$k, $v]) : ?>
                            <tr><th scope="row"><?php echo htmlspecialchars($k); ?></th><td><?php echo htmlspecialchars($v); ?></td></tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  <?php endif; ?>

                <?php elseif (in_array($id, $flow_ids, true)) : ?>
                  <div class="pd-flow<?php echo $p['process_diagram'] ? ' pd-flow--with-figure' : ''; ?>">
                    <?php if ($p['process_diagram']) : ?>
                      <figure class="pd-figure">
                        <img src="<?php echo mtc_img($p['process_diagram']); ?>"
                          <?php echo mtc_img_size(mtc_img($p['process_diagram'])); ?> loading="lazy"
                          alt="<?php echo htmlspecialchars($p['process_diagram_alt'] ?: $p['schema_name'] . ' process flow diagram'); ?>">
                        <?php if ($p['process_diagram_caption']) : ?>
                          <figcaption><?php echo htmlspecialchars($p['process_diagram_caption']); ?></figcaption>
                        <?php endif; ?>
                      </figure>
                    <?php endif; ?>

                    <div>
                      <?php if ($p['flow_heading_accent']) : ?>
                        <h3 class="pd-h3"><?php echo htmlspecialchars($p['flow_heading_accent']); ?> <?php echo htmlspecialchars($p['flow_heading_rest']); ?></h3>
                      <?php endif; ?>
                      <!-- A real sequence, so numbering carries information here. -->
                      <ol class="pd-steps">
                        <?php foreach ($p['flow_steps'] as $n => [$icon, $title, $desc]) : ?>
                          <li>
                            <span class="pd-steps__num"><?php echo htmlspecialchars($p['flow_step_word']); ?> <?php echo str_pad($n + 1, 2, '0', STR_PAD_LEFT); ?></span>
                            <h4><?php echo htmlspecialchars($title); ?></h4>
                            <p><?php echo $desc; ?></p>
                          </li>
                        <?php endforeach; ?>
                      </ol>
                    </div>
                  </div>

                <?php elseif ($id === 'apps') : ?>
                  <div class="grid grid--3 pd-apps">
                    <?php foreach ($p['apps'] as [$icon, $title, $desc]) : ?>
                      <div class="pd-app">
                        <i class="fas <?php echo $icon; ?>" aria-hidden="true"></i>
                        <h4><?php echo htmlspecialchars($title); ?></h4>
                        <p><?php echo $desc; ?></p>
                      </div>
                    <?php endforeach; ?>
                  </div>

                <?php elseif ($id === 'maint') : ?>
                  <?php if ($p['maint_alert']) : ?>
                    <div class="pd-note" role="note">
                      <i class="fas <?php echo $p['maint_alert'][0] ?: 'fa-exclamation-circle'; ?>" aria-hidden="true"></i>
                      <p><strong><?php echo htmlspecialchars($p['maint_alert'][1]); ?></strong> <?php echo $p['maint_alert'][2]; ?></p>
                    </div>
                  <?php endif; ?>
                  <div class="grid grid--2 pd-maint">
                    <?php foreach ($p['maint_cols'] as $col) : ?>
                      <div>
                        <h4><?php echo htmlspecialchars($col['title']); ?></h4>
                        <ul class="pd-list">
                          <?php foreach ($col['items'] as $item) : ?>
                            <li><?php echo $item; ?></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    <?php endforeach; ?>
                  </div>

                <?php elseif ($id === 'faq') : ?>
                  <div class="pd-faq">
                    <?php foreach ($p['faqs'] as $n => [$q, $a]) : ?>
                      <!-- Native <details>; the shared name opens one at a time,
                           as the Bootstrap accordion did. -->
                      <details class="pd-faq__item" name="product-faq"<?php echo $n === 0 ? ' open' : ''; ?>>
                        <summary class="pd-faq__q">
                          <span><?php echo htmlspecialchars($q); ?></span>
                          <span class="pd-faq__icon" aria-hidden="true"></span>
                        </summary>
                        <p class="pd-faq__a"><?php echo htmlspecialchars($a); ?></p>
                      </details>
                    <?php endforeach; ?>
                  </div>

                <?php elseif (isset($p['custom_tabs'][$id])) : ?>
                  <?php echo $p['custom_tabs'][$id]; ?>
                <?php endif; ?>

              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <aside id="quote-form" class="pd-quote">
          <?php
          // sidebar-quote-form.php reads these, and footer.php switches the
          // mobile CTA target on isset($_GET['page_url']). Keep both.
          $_GET['page_url'] = $slug;
          $_GET['page_title'] = $p['quote_title'] ?: $p['schema_name'];
          include('sidebar-quote-form.php');
          ?>
        </aside>

      </div>
    </section>

    <?php
    $current_page_slug = $p['related_slug'];
    include('related-products.php');
    ?>

  </main>

  <?php include("footer.php"); ?>

  <a href="#" class="back-to-top" aria-label="Back to top"><i class="fas fa-arrow-up"></i></a>

  <!-- No Bootstrap bundle (79 KB): product-tabs.js replaces its tab plugin,
       and the FAQ is native <details>. -->
  <script src="<?php echo mtc_asset('assets/js/product-tabs.js'); ?>"></script>
  <script src="<?php echo mtc_asset('assets/js/product-gallery.js'); ?>"></script>
  <script src="<?php echo mtc_asset('assets/js/main.js'); ?>"></script>

</body>

</html>
