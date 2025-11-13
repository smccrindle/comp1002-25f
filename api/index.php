<?php
    // 1. Get the requested path from the URI
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // 2. Remove leading/trailing slashes to clean the path (e.g., /users/profile -> users/profile)
    $relative_path = trim($uri_path, '/');
    
    // 3. Construct the absolute path to the target PHP file
    // Example: If the request is for /users/profile, we want [DOCUMENT_ROOT]/users/profile.php
    $target_file = $_SERVER['DOCUMENT_ROOT'] . '/' . $relative_path . '.php';

    // 4. Optionally: If all your routing files live in a specific 'pages/' folder at the root
    // $target_file = $_SERVER['DOCUMENT_ROOT'] . '/pages/' . $relative_path . '.php';


    echo('<h1>Target File: '.$target_file.'</h1>');
    
    if (file_exists($target_file)) {
        // This executes the code using the absolute path
        require $target_file; 
    } else {
        // Handle 404
        http_response_code(404);
        echo "404 Page Not Found";
    }
?>