<?php

declare(strict_types=1);

$root = __DIR__ . DIRECTORY_SEPARATOR;


define("VIEWS_PATH", $root .'../views' .DIRECTORY_SEPARATOR);
define("CONTROLLERS_PATH", $root . '../app/controllers' . DIRECTORY_SEPARATOR);
define("ROUTES_PATH", $root . '../app/routes' . DIRECTORY_SEPARATOR);
define("UTILS_PATH", $root . '../app/utils' . DIRECTORY_SEPARATOR);

// require all utils
require_once UTILS_PATH . 'dev_dump.php';


//require the router 
require_once ROUTES_PATH . 'router.php';



