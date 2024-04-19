<?php

declare(strict_types=1);

namespace App\Exception;

class ViewNotFoundException extends \Exception
{
    //override message
    protected $message = "View Not Found!";
}