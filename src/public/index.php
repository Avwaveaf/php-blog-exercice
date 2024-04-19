<?php

declare(strict_types=1);

use App\Controllers\About;
use App\Controllers\Home;
use App\Database;
use App\Router;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

//load the env 

$env = Dotenv::createImmutable(dirname(__DIR__));
$env->load();


$root = __DIR__ . DIRECTORY_SEPARATOR;

define("VIEWS_PATH", $root .'../views' . DIRECTORY_SEPARATOR);
define("CONTROLLERS_PATH", $root . '../app/controllers' . DIRECTORY_SEPARATOR);
define("ROUTES_PATH", $root . '../app/routes' . DIRECTORY_SEPARATOR);
define("UTILS_PATH", $root . '../app/utils' . DIRECTORY_SEPARATOR);
define("APP_PATH", $root . '../app' . DIRECTORY_SEPARATOR);

// require all utils
require_once UTILS_PATH . 'dev_dump.php';

$config = require APP_PATH . "config.php";

$db = new Database($config['database'], $_ENV['user'], $_ENV['password']);

$router = new Router();

$router
    ->get('/', [Home::class, 'index'])
    ->get('/about', [About::class, 'index']);



echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
