<?php
declare(strict_types=1);

namespace App;

use App\Exception\RouteNotFoundException;

class Router
{
    /**
     * Array of routes containning all registered routes
     * @var array
     */
    private array $routes = [];

    public function __construct(private Container $container){
    }

    /**
     * registering the routes and stored it in routes array
     * with given key from route and actionable
     * @param string $route
     * @param callable $action
     * @return \App\Router -- return self class for chaining. 
     */
public function register(string $method, string $route, callable|array $action):self
    {
        // setting the each route the $route as a key and callable as value
        $this ->routes[$method][$route] = $action;
        return $this;
    }
    /**
     * regustering get method routes
     * @param string $route
     * @param callable|array $action
     * @return \App\Router
     */
    public function get(string $route, callable|array $action): self
    {
        return $this->register('get', $route, $action);
    }

       /**
        * Registering post method routes
        * @param string $route
        * @param callable|array $action
        * @return \App\Router
        */
       public function post(string $route, callable|array $action): self
    {
        return $this->register('post', $route, $action);
    }

    /**
     * Getting all available routes
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

public function resolve(string $requestUri, string $method)
{
    // Extract path from request URI
    $route = parse_url($requestUri)['path'];

    // Get routes for the specified HTTP method
    $routes = $this->routes[$method] ?? [];

    // Iterate over registered routes
    foreach ($routes as $registeredRoute => $action) {
        // Convert route pattern to regex
        $pattern = str_replace('/', '\/', $registeredRoute);
        $pattern = preg_replace('/{([^\/]+)}/', '(?P<$1>[^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';


        // Check if request URI matches the route pattern
        if (preg_match($pattern, $route, $matches)) {
            // Extract route parameters
            $params = [];
            foreach ($matches as $key => $value) {
                if (!is_numeric($key)) {
                    $params[$key] = $value;
                }
            }

            // If action is callable, execute it
            if (is_callable($action)) {
                return call_user_func_array($action, $params);
            }

            // If action is an array, create instance and call method
            if (is_array($action)) {
                [$qualifiedClass, $method] = $action;

                if (class_exists($qualifiedClass)) {
                    $class = $this->container->get($qualifiedClass);
                    if (method_exists($class, $method)) {
                        return call_user_func_array([$class, $method], $params);
                    }
                }
            }
        }
    }

    // No matching route found
    throw new RouteNotFoundException();
}

}