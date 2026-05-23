<?php

/**
 * Laravel's built-in PHP development server router.
 *
 * This script is used by `php -S ... -t public server.php` to serve static files
 * from /public and route all other requests to /public/index.php.
 */

$publicPath = __DIR__ . DIRECTORY_SEPARATOR . 'public';

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/'
);

if ($uri !== '/' && file_exists($publicPath . $uri)) {
    return false;
}

require_once $publicPath . DIRECTORY_SEPARATOR . 'index.php';
