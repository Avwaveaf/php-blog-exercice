<?php

declare(strict_types=1);

use App\Controllers\About;
use App\Controllers\Home;
use App\Controllers\Posts;
use App\Router;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

//load the env 

$env = Dotenv::createImmutable(dirname(__DIR__));
$env->load();


$root = __DIR__ . DIRECTORY_SEPARATOR;

define("VIEWS_PATH", $root .'../views' . DIRECTORY_SEPARATOR);
define("CONTROLLERS_PATH", $root . '../app/controllers' . DIRECTORY_SEPARATOR);
define("UTILS_PATH", $root . '../app/utils' . DIRECTORY_SEPARATOR);
define("APP_PATH", $root . '../app' . DIRECTORY_SEPARATOR);
define("JS_PATH", $root . 'js'. DIRECTORY_SEPARATOR);


// require all utils
require_once UTILS_PATH . 'dev_dump.php';



$router = new Router();

$router
    ->get('/', [Home::class, 'index'])
    ->get('/about', [About::class, 'index'])
    ->get('/posts/{slug}', [Posts::class, 'post'])
    ;


(new App\App($router, [
    'uri'=>$_SERVER['REQUEST_URI'],
     'method'=>$_SERVER['REQUEST_METHOD']
     ]))->run();
