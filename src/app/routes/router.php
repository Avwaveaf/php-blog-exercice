<?php
declare(strict_types=1);


// parse the request url to an array of path and query
$request_uri = parse_url($_SERVER['REQUEST_URI']);
$path = $request_uri['path'];

// defining all the routes available
$routes = [
    '/' => CONTROLLERS_PATH . 'home.php',
    '/contact' => CONTROLLERS_PATH . 'contact.php',
    '/about' => CONTROLLERS_PATH . 'about.php',
];

// Check if the path exists in the routes array
if (array_key_exists($path, $routes)) {
    require_once $routes[$path];
} 
else {
    // defining a status cde
    http_response_code(404);
    // Route not found, include 404 page
    require_once VIEWS_PATH . '404page.php';
    die();
}