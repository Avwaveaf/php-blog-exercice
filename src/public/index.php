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


// switch logic to get the path only 
switch ($request_uri['path']) {
    case '/about':
        include_once CONTROLLERS_PATH . 'about.php';
        break;
    case '/contact':
         include_once CONTROLLERS_PATH . 'contact.php';
        break;
    default:
        include_once CONTROLLERS_PATH . 'home.php';
}
