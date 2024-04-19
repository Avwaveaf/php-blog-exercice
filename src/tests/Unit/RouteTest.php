<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Router;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
 
    public function testThatRoutesCanBeRegistered(): void
    {
        // given that we have a router object
        $router = new Router();

        // when we call register method
        $router->register('get', '/testing', ["classRelated", 'classFunction']);

        $expectedArr = [
            'get' => [
                '/testing' => ['classRelated' , 'classFunction'],
            ]
        ];

        // then we assert that route is registered
        $this->assertEquals($expectedArr, $router->getRoutes());
    }

    public function testItRegisteredGetRoute()
    {
        // given that we have a router object
        $router = new Router();

        // when we call get method
        $router->get( '/testing', ["classRelated", 'classFunction']);

        $expectedArr = [
            'get' => [
                '/testing' => ['classRelated' , 'classFunction'],
            ]
        ];

        // then we assert that route is registered as 'get method'
        $this->assertEquals($expectedArr, $router->getRoutes());
    }
}