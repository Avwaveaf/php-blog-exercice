<?php

declare(strict_types=1);

namespace Tests\DataProviders;

class RouterDataProvider
{
        public function routeNotFoundCases():array
    {
        return [
            // route found but method not found
            ['/posts', 'post'],
            // route found but method not found
            ['/posts/create', 'get'],
            // route found but method not found
            ['/posts/create', 'put'],
            //method found but the route not found
            ['/posts/update', 'post'],
            // method exist and route exist but class not exist
            ['/posts/create', 'post'],
            // method exist and route exist but class not exist
            ['/posts', 'get']
        ];
    }
}