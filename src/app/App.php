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

    public static Container $container;

    public function __construct(Router $router, array $requestInfo )
    {  
        $this->router = $router;
        $this->requestInfo = $requestInfo;

        $config = require APP_PATH . "config.php";
        static::$db = new Database($config['database'], $_ENV['user'], $_ENV['password']);

        static::$container = new Container();

        // Set the Email Service in the container.
        static::$container->set(EmailService::class, fn()=> new EmailService());

        // Set the Post Service in the container with dependency resolution.
        static::$container->set(PostService::class, function (Container $c) {
            return new PostService($c->get(EmailService::class));
        });
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