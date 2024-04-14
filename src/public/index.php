<?php

declare(strict_types=1);

$root = __DIR__ . DIRECTORY_SEPARATOR;


define("VIEWS_PATH", $root .'../views' .DIRECTORY_SEPARATOR);
define("CONTROLLERS_PATH", $root . '../app/controllers' . DIRECTORY_SEPARATOR);


// view path

$request_uri = $_SERVER['REQUEST_URI'];


switch ($request_uri) {
    case '/about':
        include_once CONTROLLERS_PATH . 'about.php';
        break;
    case '/contact':
         include_once CONTROLLERS_PATH . 'contact.php';
        break;
    default:
        include_once CONTROLLERS_PATH . 'home.php';
}
