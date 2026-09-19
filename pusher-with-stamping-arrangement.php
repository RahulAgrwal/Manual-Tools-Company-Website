<?php
// Product detail page. Content lives in product-data.php; the markup is
// rendered by product-page.php. This file must stay at the repo root: .htaccess
// maps /pusher-with-stamping-arrangement to it, asset paths are relative, and header.php and
// footer.php read PHP_SELF for the active nav link and the visitor-counter key.
$mtc_product_slug = 'pusher-with-stamping-arrangement';
require __DIR__ . '/product-page.php';
