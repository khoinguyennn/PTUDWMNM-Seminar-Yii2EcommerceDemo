<?php
/**
 * Router script for PHP built-in server
 * Usage: php -S localhost:8081 -t backend/web backend/web/router.php
 */

// Serve static files directly
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

// Serve static files (including uploads via symlink)
if (is_file($file)) {
    return false;
}

// Otherwise, run index.php
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';

require __DIR__ . '/index.php';
