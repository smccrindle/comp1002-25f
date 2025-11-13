<?php
    $uri = $_SERVER['REQUEST_URI'];
    // You'd typically strip the query string and base directory here
    $path = trim(parse_url($uri, PHP_URL_PATH), '/');

    // Example: Map 'users/profile' to 'pages/users/profile.php'
    $target_file = 'pages/' . $path . '.php';

    echo('<h1>$path: '.$path.'</h1>');
    echo('<h1>$target_file: '.$target_file.'</h1>');

    /*
    if (file_exists($target_file)) {
        // This executes the code in pages/users/profile.php
        require $target_file;
    } else {
        // Handle 404
        http_response_code(404);
        echo "404 Page Not Found";
    }
    */
?>