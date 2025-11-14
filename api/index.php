<?php
// Start output buffering (recommended as a safety net)
ob_start();

// 1. Get and clean the requested path
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$relative_path = trim($uri_path, '/');

$document_root = $_SERVER['DOCUMENT_ROOT'];
$target_file = null;

// Determine the base directory to check. 
// If relative_path is empty (root '/'), base_dir is DOCUMENT_ROOT.
// If relative_path is 'lesson-6', base_dir is DOCUMENT_ROOT/lesson-6.
$base_dir = $document_root;
if (!empty($relative_path)) {
    $base_dir .= '/' . $relative_path;
}

// --- 2. TRY TO RESOLVE DIRECTORY INDEX ---

// A. Check for index.html (Static priority)
$check_index_html = $base_dir . '/index.html';
if (file_exists($check_index_html)) {
    $target_file = $check_index_html;
} 
// B. Check for index.php (Dynamic fallback)
else {
    $check_index_php = $base_dir . '/index.php';
    if (file_exists($check_index_php)) {
        $target_file = $check_index_php;
    }
}

// --- 3. EXECUTE OR 404 ---
if ($target_file) {
    // require() outputs the file content (HTML) or executes the script (PHP)
    require $target_file; 
} else {
    // Handle 404
    http_response_code(404);
    echo "404 Page Not Found: Directory index not found.";
}

ob_end_flush();
?>