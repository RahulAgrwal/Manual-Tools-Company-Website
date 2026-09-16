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

// Only count real top-level pages (a .php file in this folder that renders the footer)
$page = basename((string)($_POST['page'] ?? ''));
$file = __DIR__ . '/' . $page;
$isPage = preg_match('/^[A-Za-z0-9-]+\.php$/', $page)
    && is_file($file)
    && preg_match('/include(_once)?\s*\(?\s*["\']footer\.php["\']/', file_get_contents($file));

if (!$isPage) {
    http_response_code(400);
    echo json_encode(['count' => null]);
    exit;
}

require_once __DIR__ . '/webcounter.php';

echo json_encode(['count' => visitor($page)]);
