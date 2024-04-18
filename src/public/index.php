<?php

declare(strict_types=1);

use App\Database;
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






// $res = $db->execute("insert into posts (title, slug, content) values ('new post', 'new-post', 'this is just basic new post')");
// if ($res) {
//     echo "data successfuully added!";
// }else{
//     echo "data failure to insert";
// }

// $res = $db->execute("delete from posts where id in (4,5)");
// if ($res) {
//     echo "successfuully deleted";
// }


//require the router 
require_once ROUTES_PATH . 'router.php';
