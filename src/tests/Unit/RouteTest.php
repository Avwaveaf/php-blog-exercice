<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exception\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    protected Router $router;

    protected function setUp():void
    {
        parent::setUp();

        $this->router = new Router();
    }
 
    public function testThatRoutesCanBeRegistered(): void
    {
        // given that we have a router object
        // when we call register method
        $this->router->register('get', '/testing', ["classRelated", 'classFunction']);

        $expectedArr = [
            'get' => [
                '/testing' => ['classRelated' , 'classFunction'],
            ]
        ];

        // then we assert that route is registered
        $this->assertEquals($expectedArr, $this->router->getRoutes());
    }

    public function testItRegisteredGetRoute():void
    {
        // given that we have a router object
        // when we call get method
        $this->router->get( '/testing', ["classRelated", 'classFunction']);

        $expectedArr = [
            'get' => [
                '/testing' => ['classRelated' , 'classFunction'],
            ]
        ];

        // then we assert that route is registered as 'get method'
        $this->assertEquals($expectedArr, $this->router->getRoutes());
    }

    public function testItShouldRegisterPostRoute(){
        // given that we have a router object
        // when we call get method
        $this->router->post( '/testing', ["classRelated", 'classFunction']);

        $expectedArr = [
            'post' => [
                '/testing' => ['classRelated' , 'classFunction'],
            ]
        ];

        // then we assert that route is registered as 'get method'
        $this->assertEquals($expectedArr, $this->router->getRoutes());
    }

    public function testThereAreNoRoutesWhenRouterCreated()
    {
        // given that we have a router object
        // in this test we testing that there are no routes when the
        // routes object instantiaited so we need a neew object./
        $router = new Router();
        // when we call get method
        // we assert that no routes registered 
        $this->assertEmpty($router->getRoutes());

    }

    /**
     * This testing the ROuter->resolve method
     * and this test method expect this two:
     * @param string $requestUri
     * @param string $requestMethod
     * @return void

     * @dataProvider \Tests\DataProviders\RouterDataProvider::routeNotFoundCases 
     */
    public function testItThrownRoutesNotFoundException(
        string $requestUri, 
        string $requestMethod
    )
    {
        //simulating the controller
        $posts = new class(){
            public function delete(){
                return true;
            }
        };

        $this->router->post('/posts/create', [$posts::class, 'create']);
        $this->router->get('/posts', ['Posts', 'index']);

        // we can expect before resolve that RouteNotFoundException are called
        // due to resolve method can produce the exception and it will stop 
        // the execution.
        $this->expectException(RouteNotFoundException::class);
        $this->router->resolve($requestUri, $requestMethod);
    }




}