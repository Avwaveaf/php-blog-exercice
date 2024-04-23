<?php

declare(strict_types=1);
namespace App;

use App\Database;
use App\Router;
use App\Services\EmailService;
use App\Services\PostService;
use App\View;


class App
{
    protected Router $router;
    protected array $requestInfo;

    private static Database $db;



    public function __construct(Router $router, array $requestInfo )
    {  
        $this->router = $router;
        $this->requestInfo = $requestInfo;

        $config = require APP_PATH . "config.php";
        static::$db = new Database($config['database'], $_ENV['user'], $_ENV['password']);

  
    }

    public static function getDbInstace()
    {
        return static::$db;   
    }

    public function run()
    {
        try {
            echo $this->router->resolve(
                $this->requestInfo['uri'],
                 strtolower($this->requestInfo['method']
                ));
        } catch (\App\Exception\RouteNotFoundException $th) {
            http_response_code(404);
            echo View::make('404page');
        }

    }
}