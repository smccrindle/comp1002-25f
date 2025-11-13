<?php
// Simple dispatcher for Vercel PHP runtime
// Maps incoming request path to files in the repo and includes them safely.

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH);
// Normalize and trim leading slash
$path = ltrim($path, '/');
if ($path === '') {
    $path = 'index.php';
}

// If the path looks like a directory, map to index.php
if (substr($path, -1) === '/') {
    $path = rtrim($path, '/') . '/index.php';
}

// If the path has no dot (no extension), treat as directory and map to index.php
if (strpos(basename($path), '.') === false) {
    $path = rtrim($path, '/') . '/index.php';
}

// Prevent accessing sensitive folders
$sensitive_patterns = [
    '/(^|\\/)includes(\\/|$)/',
    '/(^|\\/)\.git(\\/|$)/',
    '/\\.env$/i'
];
foreach ($sensitive_patterns as $p) {
    if (preg_match($p, '/' . $path)) {
        http_response_code(404);
        echo "Not Found";
        exit;
    }
}

// Prevent directory traversal
$realBase = realpath(__DIR__ . '/../');
$requested = realpath(__DIR__ . '/../' . '/' . $path);
if ($requested === false || strpos($requested, $realBase) !== 0) {
    http_response_code(404);
    echo "Not Found";
    exit;
}

// Only allow .php files to be executed
if (pathinfo($requested, PATHINFO_EXTENSION) !== 'php') {
    http_response_code(404);
    echo "Not Found";
    exit;
}

// Include the requested PHP file
chdir(dirname($requested));
// Use output buffering to capture output and send it
ob_start();
include $requested;
$out = ob_get_clean();
// Basic content-type detection: assume HTML
header('Content-Type: text/html; charset=utf-8');
echo $out;
