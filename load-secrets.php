<?php
/**
 * Loads credentials from a PHP file that is NOT committed to git.
 *
 * Lookup order (first file found wins):
 *   1. Path in the MTC_SECRETS_FILE environment variable (optional override)
 *   2. ../config/secrets.php  - production: outside public_html on Hostinger
 *   3. ./config/secrets.php   - local development (git-ignored)
 *   4. ./secrets.local.php    - local development alternative (git-ignored)
 *
 * Copy secrets.example.php to one of these locations and fill in the values.
 */
function mtc_secrets()
{
    static $secrets = null;
    if ($secrets !== null) {
        return $secrets;
    }

    $candidates = array_filter([
        getenv('MTC_SECRETS_FILE') ?: null,
        dirname(__DIR__) . '/config/secrets.php',
        __DIR__ . '/config/secrets.php',
        __DIR__ . '/secrets.local.php',
    ]);

    foreach ($candidates as $file) {
        if (is_file($file)) {
            $loaded = require $file;
            if (is_array($loaded)) {
                return $secrets = $loaded;
            }
        }
    }

    return $secrets = [];
}
