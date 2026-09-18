<?php
/**
 * Records a page visit and returns that page's visitor count as JSON.
 *
 * Called by footer.php after the page has loaded (POST /track-visit, field "page"),
 * so the IP lookup and database work in webcounter.php never delay page rendering.
 */
header('Content-Type: application/json');
header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['count' => null]);
    exit;
}

// Only count real top-level pages: a .php file in this folder that renders the
// footer, either directly or by delegating to product-page.php (the ten product
// detail pages are three-line stubs that do exactly that). Without the second
// name here those ten pages stop being counted, silently.
$page = basename((string)($_POST['page'] ?? ''));
$file = __DIR__ . '/' . $page;
// The stubs write `require __DIR__ . '/product-page.php';`, so allow anything
// up to the file name within the same statement. product-page.php itself is
// the template, not a page: it is on the include-only 404 list, and counting it
// would let a POST inflate a counter for a URL that does not exist.
$isPage = preg_match('/^[A-Za-z0-9-]+\.php$/', $page)
    && $page !== 'product-page.php'
    && is_file($file)
    && preg_match('/\b(include|require)(_once)?\b[^;]*["\'\/](footer|product-page)\.php["\']/', file_get_contents($file));

if (!$isPage) {
    http_response_code(400);
    echo json_encode(['count' => null]);
    exit;
}

require_once __DIR__ . '/webcounter.php';

echo json_encode(['count' => visitor($page)]);
