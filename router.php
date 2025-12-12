<?php

$path = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Don't let the router handle the root path if you have an index.php
if ($path === '/') {
    require_once 'index.php';
    exit();
}

// Check if the requested resource exists as a file or directory
$publicPath = __DIR__ . $path;
if (file_exists($publicPath) && !is_dir($publicPath)) {
    // It's a file (like an image, css, js), let the built-in server handle it.
    return false;
}

// Check if a corresponding .php file exists
$phpFile = __DIR__ . $path . '.php';
if (file_exists($phpFile)) {
    require_once $phpFile;
    exit();
}

// If nothing matches, return a 404
http_response_code(404);
require_once __DIR__ . '/404.php';
exit();