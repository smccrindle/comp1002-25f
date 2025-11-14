<?php
// Start output buffering (Recommended safety net)
ob_start();

// 1. Get and clean the requested path
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$relative_path = trim($uri_path, '/');
$document_root = $_SERVER['DOCUMENT_ROOT'];
$target_file = null;

// Determine if the path has a file extension
$extension = strtolower(pathinfo($relative_path, PATHINFO_EXTENSION));

// --- 2. SWITCH ON FILE TYPE ---
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

        // ONLY check for index.php (Dynamic content)
        $check_index_php = $base_dir . '/index.php';
        if (file_exists($check_index_php)) {
            $target_file = $check_index_php;
        } 
        // If index.php is not found, the script falls through to the final 404.
        
        break;

    default:
        // Case C: Any other file extension (static asset, e.g., .css, .jpg)
        // These should have been caught by Vercel's routing. If they hit here, 
        // they are treated as a 404 because they couldn't be resolved statically.
        $target_file = null;
        break;
}

// --- 3. EXECUTE OR 404 ---
if ($target_file) {
    require $target_file; 
} else {
    // Handle 404
    http_response_code(404);
    echo "404 Page Not Found: File or directory index not resolved.";
}

ob_end_flush();
?>