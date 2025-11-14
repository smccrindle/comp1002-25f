<?php
// Start output buffering (recommended safety net)
ob_start();

// Get and clean the requested path
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$relative_path = trim($uri_path, '/');
$document_root = $_SERVER['DOCUMENT_ROOT'];
$target_file = null;

// Determine if the path has a file extension
$extension = strtolower(pathinfo($relative_path, PATHINFO_EXTENSION));

// Switch based on file extension
switch ($extension) {
    case 'php':
        // Case A: Direct PHP file access (e.g., /file.php)
        // Vercel should handle this, but if it falls through, we execute it.
        $target_file = $document_root . '/' . $relative_path;
        
        // Ensure the file exists before executing
        if (!file_exists($target_file)) {
             $target_file = null; // Forces 404 below
        }
        break;

    case '':
        // Case B: Directory access (e.g., /lesson-6/ or the root /)
        
        // Determine the base directory to check.
        $base_dir = $document_root;
        if (!empty($relative_path)) {
            $base_dir .= '/' . $relative_path;
        }

        $found_target = false; // Flag to track if a file has been found

        // Check for index.php (dynamic priority)
        $check_index_php = $base_dir . '/index.php';
        if (file_exists($check_index_php)) {
            $target_file = $check_index_php;
            $found_target = true;
        } 
        
        // Check for index.html (static fallback) only if PHP wasn't found
        if (!$found_target) {
            $check_index_html = $base_dir . '/index.html';
            if (file_exists($check_index_html)) {
                $target_file = $check_index_html;
            } 
        }
        
        // If neither index.php nor index.html is found, $target_file remains null, 
        // and the script falls through to the final 404.
        
        break;

    default:
        // Case C: Any other file extension (static asset, e.g., .css, .jpg)
        // These should have been caught by Vercel's routing. If they hit here, 
        // they are treated as a 404 because they couldn't be resolved statically.
        $target_file = null;
        break;
}

// Either pass the .php file to the runtime or throw a 404
if ($target_file) {
    require $target_file; 
} else {
    http_response_code(404);
    echo "404 Page Not Found: File or directory index not resolved.";
}

ob_end_flush();
?>