<?php

declare(strict_types=1);

$root = __DIR__ . DIRECTORY_SEPARATOR;


define("VIEWS_PATH", $root .'../views' .DIRECTORY_SEPARATOR);
define("CONTROLLERS_PATH", $root . '../app/controllers' . DIRECTORY_SEPARATOR);
define("UTILS_PATH", $root . '../app/utils' . DIRECTORY_SEPARATOR);

// require all utils
require_once UTILS_PATH . 'dev_dump.php';


// views path

// parse the request url to an array of path and query
$request_uri = parse_url($_SERVER['REQUEST_URI']);
$path = $request_uri['path'];

$routes = [
    '/' => CONTROLLERS_PATH . 'home.php',
    '/contact' => CONTROLLERS_PATH . 'contact.php',
    '/about' => CONTROLLERS_PATH . 'about.php',
];

// Check if the path exists in the routes array
if (array_key_exists($path, $routes)) {
    require_once $routes[$path];
} else {
    // Route not found, include 404 page
    require_once VIEWS_PATH . '404page.php';
}