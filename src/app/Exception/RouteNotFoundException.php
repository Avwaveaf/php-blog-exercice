<?php

declare(strict_types=1);

namespace App\Exception;

class RouteNotFoundException extends \Exception
{
    //override message
    protected $message = "404 Not Found!";
}