<?php
    // Get the requested path from the URI
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Remove leading/trailing slashes to clean the path (e.g., /users/profile -> users/profile)
    $relative_path = trim($uri_path, '/');
    
    // Construct the absolute path to the target PHP file
    // Example: If the request is for /users/profile, we want [DOCUMENT_ROOT]/users/profile.php
    $target_file = $_SERVER['DOCUMENT_ROOT'] . '/' . $relative_path;

    if (file_exists($target_file)) {
        // This executes the code using the absolute path
        require $target_file; 
    } else {
        // Handle 404
        http_response_code(404);
        echo ('<h1>404 Page not found</h1>');
    }
?>